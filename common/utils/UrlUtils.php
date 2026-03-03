<?php

namespace Pandao\Common\Utils;

use Pandao\Common\Core\Database;

class UrlUtils
{
    /**
     * Redirects to a 404 error page.
     *
     * @param string|null $msg Optional message to display on 404.
     */
    public static function err404($msg = null)
    {
        header("HTTP/1.0 404 Not Found");
        $errPage = SYSBASE . 'public/404.php';
        if (is_file($errPage)) {
            require $errPage;
        } else {
            echo '404 Not Found';
            if ($msg) echo ': ' . $msg;
        }
        exit();
    }

    /**
     * Returns the full base URL (http/https + host + port).
     *
     * @param bool $noSlash If true, removes trailing slash.
     * @return string The base URL.
     */
    public static function getUrl($noSlash = false)
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $url = $protocol . '://' . $host;

        return $noSlash ? rtrim($url, '/') : $url . '/';
    }

    /**
     * Returns the absolute filesystem path to a template file.
     *
     * @param string $path Relative path within the template directory.
     * @param bool $addDocbase Whether to prepend DOCBASE.
     * @return string The full filesystem path.
     */
    public static function getFromTemplate($path, $addDocbase = true)
    {
        $base = SYSBASE . 'templates/' . PMS_TEMPLATE . '/';
        if ($addDocbase) {
            return DOCBASE . 'templates/' . PMS_TEMPLATE . '/' . $path;
        }
        return $base . $path;
    }

    /**
     * Builds hreflang alternate link tags HTML string.
     *
     * @param array $alternates Array of [lang_tag => url] pairs.
     * @return string HTML string of <link> tags.
     */
    public static function buildHreflangTags(array $alternates): string
    {
        $html = '';
        foreach ($alternates as $lang => $url) {
            $html .= '<link rel="alternate" hreflang="' . htmlspecialchars($lang) . '" href="' . htmlspecialchars($url) . '" />' . "\n";
        }
        return $html;
    }
}
