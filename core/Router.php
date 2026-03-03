<?php

namespace Pandao\Core;

use Pandao\Services\SiteContext;
use Pandao\Models\Page;
use Pandao\Common\Utils\UrlUtils;

class Router
{
    protected $pms_db;
    private $routes = [];
    private $bootstrap;

    public function __construct($db, $bootstrap)
    {
        $this->pms_db = $db;
        $allRoutes = json_decode(file_get_contents(__DIR__ . '/../config/routes.json'), true);
        $this->routes = $allRoutes['front'];
        $this->bootstrap = $bootstrap;
    }

    public function route()
    {
        $this->handleUri();
        $route = $this->setLanguageSettings();

        SiteContext::get($this->pms_db);

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
            $this->handleXhr();
        else
            $this->handleHttp($route);
    }

    private function handleXhr()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', $url);
        $ajaxAction = end($segments) ?? null;
        $actionScript = (strpos($url, 'xhr/views/')) ? UrlUtils::getFromTemplate("views/partials/{$ajaxAction}.php", false) : __DIR__ . "/../handlers/{$ajaxAction}.php";

        if (file_exists($actionScript)) {
            $siteContext = SiteContext::get();
            require_once $actionScript;
        } else {
            echo json_encode(['error' => 'Unknown action']);
        }
    }

    public function handleHttp($route)
    {
        $this->routeLanguage($route);

        $siteContext = SiteContext::get();

        $request_uri = $_SERVER['REQUEST_URI'];
        if (defined('DOCBASE') && DOCBASE != '/') {
            $request_uri = substr($request_uri, strlen(DOCBASE));
        }
        $request_uri = trim($request_uri, '/');

        $pos = strpos($request_uri, '?');
        if ($pos !== false) {
            $request_uri = substr($request_uri, 0, $pos);
        }

        $uri_parts = preg_split('#[\\\\/]#', $request_uri);
        $count_uri = count($uri_parts);

        $page_alias = '';
        $article_alias = '';
        $ishome = false;

        if ((PMS_LANG_ENABLED && $count_uri == 1) || (!PMS_LANG_ENABLED && empty($uri_parts[0]))) {
            $page_alias = 'home';
            $ishome = true;

            if (PMS_LANG_ENABLED && !array_key_exists($uri_parts[0], $this->bootstrap->languages)) {
                UrlUtils::err404('');
            }
        } else {
            $i = (PMS_LANG_ENABLED) ? 1 : 0;

            if ($count_uri > $i + 2) {
                UrlUtils::err404();
            }

            $page_alias = trim($uri_parts[$i], '/\\');
            if (isset($uri_parts[$i + 1])) {
                $article_alias = trim($uri_parts[$i + 1], '/\\');
            }
        }

        $myPage = new Page($this->pms_db, $siteContext);
        $myPage->loadPage($page_alias, $ishome);

        if ($myPage === null) {
            UrlUtils::err404("Page not found for alias: $page_alias");
        }

        $siteContext->currentPage = $myPage;

        $methodType = $_SERVER['REQUEST_METHOD'];

        if (!empty($article_alias)) {
            if (!$myArticle = $siteContext->getArticleByAlias($article_alias)) {
                UrlUtils::err404("Article not found for alias: $article_alias");
            }
            $this->callController($myPage, $myArticle, $methodType);
        } else {
            $this->callController($myPage, null, $methodType);
        }
    }

    private function callController($myPage, $myArticle = null, $methodType = 'GET')
    {
        $controller = $myArticle ? $myPage->article_model : $myPage->page_model ?? 'page';

        if (!isset($this->routes[$controller]))
            $controller = $myArticle ? 'article' : 'page';

        if ($methodType === 'HEAD') $methodType = 'GET';

        if (!isset($this->routes[$controller][$methodType])) {
            $methodType = 'GET';
        }

        $route = $this->routes[$controller][$methodType];
        $controllerClass = $route[0];
        $method = $route[1];

        if (class_exists($controllerClass)) {
            $ctrl = new $controllerClass($this->pms_db);
            if (method_exists($ctrl, $method)) {
                if ($myArticle) {
                    call_user_func_array([$ctrl, $method], [$myPage, $myArticle]);
                } else {
                    call_user_func_array([$ctrl, $method], [$myPage]);
                }
            } else {
                UrlUtils::err404("Method $method not found in $controllerClass");
            }
        } else {
            UrlUtils::err404("Controller $controllerClass not found");
        }
    }

    public function handleUri()
    {
        $request_uri = (DOCBASE != '/') ? substr($_SERVER['REQUEST_URI'], strlen(DOCBASE)) : $_SERVER['REQUEST_URI'];
        $request_uri = trim($request_uri, '/');
        $pos = strpos($request_uri, '?');
        if ($pos !== false) $request_uri = substr($request_uri, 0, $pos);
        define('REQUEST_URI', $request_uri);
    }

    public function routeLanguage($route)
    {
        if (!empty($route)) UrlUtils::err404($route['error'], $route['url']);
    }

    public function setLanguageSettings()
    {
        $route = null;
        if (PMS_MAINTENANCE_MODE == 0 || (isset($_SESSION['user']) && ($_SESSION['user']['type'] == 'administrator' || $_SESSION['user']['type'] == 'manager'))) {
            if (PMS_LANG_ENABLED == 1) {
                $uri = explode('/', REQUEST_URI);
                $this->bootstrap->env_variables['lang_tag'] = $uri[0];
                if (!isset($this->bootstrap->languages[$this->bootstrap->env_variables['lang_tag']])) {
                    $route = ['error' => '', 'url' => ''];
                    if (preg_match('/$(index.php)?^/', str_replace(DOCBASE, '', $_SERVER['REQUEST_URI']))) {
                        if ($this->bootstrap->env_variables['lang_tag'] == '') {
                            if (isset($_COOKIE['PMS_LANG_TAG']) && isset($this->bootstrap->languages[$_COOKIE['PMS_LANG_TAG']])) {
                                $route['error'] = 'Access without lang tag - Cookie redirection';
                                $route['url'] = $_COOKIE['PMS_LANG_TAG'];
                            } else {
                                $route['error'] = 'Access without lang tag - Default lang redirection';
                                $route['url'] = $this->bootstrap->default_env_variables['lang_tag'];
                            }
                        } else {
                            $route['error'] = 'Access with wrong lang tag - Default lang redirection';
                            $route['url'] = $this->bootstrap->default_env_variables['lang_tag'];
                        }
                    } elseif (isset($_SESSION['PMS_LANG_TAG'])) {
                        $this->bootstrap->env_variables['lang_tag'] = $_SESSION['PMS_LANG_TAG'];
                    } else {
                        $this->bootstrap->env_variables['lang_tag'] = $this->bootstrap->default_env_variables['lang_tag'];
                    }
                } else {
                    setcookie('PMS_LANG_TAG', $this->bootstrap->env_variables['lang_tag'], time() + 25200);
                    $_SESSION['PMS_LANG_TAG'] = $this->bootstrap->env_variables['lang_tag'];
                }

                if (isset($this->bootstrap->languages[$this->bootstrap->env_variables['lang_tag']])) {
                    $this->bootstrap->env_variables['lang_id'] = $this->bootstrap->languages[$this->bootstrap->env_variables['lang_tag']]['lang_id'];
                    $this->bootstrap->env_variables['locale'] = $this->bootstrap->languages[$this->bootstrap->env_variables['lang_tag']]['locale'];
                    $this->bootstrap->env_variables['rtl_dir'] = $this->bootstrap->languages[$this->bootstrap->env_variables['lang_tag']]['rtl'];
                }

                $sublocale = substr($this->bootstrap->default_env_variables['locale'], 0, 2);
                if ($sublocale == 'tr' || $sublocale == 'az') $this->bootstrap->env_variables['locale'] = 'en_GB';
            }
        }
        $this->bootstrap->defineLocaleConstants();
        return $route;
    }
}
