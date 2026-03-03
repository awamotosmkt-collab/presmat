<?php

namespace Pandao\Admin\Models;

use Pandao\Admin\Core\Helpers;
use Pandao\Admin\Models\Module;
use \DOMDocument;

class AdminContext
{
    protected $pms_db;

    private static $instance = null;
    private $langManager;

    public $texts = [];
    public $modules = [];
    public $indexes = [];
    public $currModule;
    public $languages;
    public $permissions = [];
    public $addAllowed = false;
    public $editAllowed = false;
    public $deleteAllowed = false;
    public $publishAllowed = false;
    public $uploadAllowed = false;
    public $viewAllowed = false;
    public $noAccess = true;
    public $allAccess = false;
    public $allowableExts = [];

    /**
     * AdminContext constructor. Initializes the class and loads texts and modules.
     *
     * @param object $db Database connection object.
     *
     */
    private function __construct($db, $langManager, $installed = true)
    {
        $this->pms_db = $db;
        if(!defined('PMS_ADMIN_LANG_FILE')) define('PMS_ADMIN_LANG_FILE', 'en.ini');
        $this->loadTexts();

        if(!$installed) return;

        if(isset($_SESSION['user'])) $this->loadModules();
        $this->setAllowableExts();
        $this->langManager = $langManager;
        $this->languages = $this->langManager->getLanguagesWithImages();
    }

    /**
     * Get the singleton instance of AdminContext.
     *
     * @param object|null $db Database connection object (required for the first instance).
     *
     * @return self The singleton instance of AdminContext.
     * @throws \Exception If the database connection is not provided for the first instance.
     */
    public static function get($db = null, $langManager = null, $installed = true)
    {
        if (self::$instance === null) {
            if ($db === null) {
                throw new \Exception("Database connection is required for the first instance of AdminContext.");
            }
            if ($langManager === null) {
                throw new \Exception("langManager is required for the first instance of AdminContext.");
            }
            self::$instance = new self($db, $langManager, $installed);
        }
        return self::$instance;
    }

    /**
     * Load the texts for the admin interface.
     *
     */
    private function loadTexts()
    {
        $texts = array();
        $admin_lang_file = SYSBASE . PMS_ADMIN_FOLDER . '/includes/langs/' . PMS_ADMIN_LANG_FILE;
    
        if(ADMIN && is_file($admin_lang_file)){
            $texts = @parse_ini_file($admin_lang_file);
            if(is_null($texts))
                $texts = @parse_ini_string(file_get_contents($admin_lang_file));
        }

        $this->texts = $texts;
    }

    /**
     * Load the modules available for the current admin session.
     *
     */
    private function loadModules()
    {
        $modules = $this->getModules(PMS_ADMIN_FOLDER . '/modules');
        $this->modules = $modules;
        $moduleName = $_GET['module'] ?? null;
        if ($moduleName !== null) {
            $this->currModule = $modules[$moduleName] ?? null;
        }
        foreach ($this->modules as $module) {
            $module->permissions = $this->getPermissions($module);
            $this->indexes[$module->name] = $module;
        }
        if ($this->currModule !== null) {
            $this->setPermissions();
        }
    }

    /**
     * Get modules from the given folder path.
     *
     * @param string $path Path to the modules folder.
     *
     * @return array List of modules.
     */
    private function getModules(string $path): array
    {
        $modules = [];
        $xmlFiles = glob(SYSBASE . $path . '/*/*.xml');

        if (!is_array($xmlFiles)) return $modules;

        foreach ($xmlFiles as $file) {
            $module = new Module($file, $path);
            if (!empty($module->name)) {
                $modules[$module->name] = $module;
            }
        }

        usort($modules, fn($a, $b) => ($a->rank ?? 0) <=> ($b->rank ?? 0));

        return $modules;
    }

    /**
     * Get permissions for a module based on the session user.
     *
     * @param object $module Module object.
     *
     * @return array List of permissions.
     */
    private function getPermissions($module)
    {
        $permissions = [];
        $userType = $_SESSION['user']['type'] ?? '';
        $userId = $_SESSION['user']['id'] ?? 0;
        $modulePerms = $module->access ?? [];

        foreach ($modulePerms as $role => $perms) {
            if ($userType === $role) {
                $permissions = is_array($perms) ? $perms : explode(',', $perms);
                break;
            }
        }

        return $permissions;
    }

    /**
     * Set permissions flags based on current module.
     *
     */
    private function setPermissions()
    {
        $rights = $this->currModule->permissions;

        if (empty($rights) || in_array('no_access', $rights)) {
            $this->noAccess = true;
            return;
        }

        $this->noAccess = false;
        $this->allAccess = in_array('all', $rights);
        $this->addAllowed = $this->allAccess || in_array('add', $rights);
        $this->editAllowed = $this->allAccess || in_array('edit', $rights);
        $this->deleteAllowed = $this->allAccess || in_array('delete', $rights);
        $this->publishAllowed = $this->allAccess || in_array('publish', $rights);
        $this->uploadAllowed = $this->allAccess || in_array('upload', $rights);
        $this->viewAllowed = $this->allAccess || in_array('view', $rights);
    }

    /**
     * Set the allowable file extensions based on admin configuration.
     *
     */
    private function setAllowableExts()
    {
        if (!defined('PMS_ALLOWABLE_EXTS')) return;
        $exts = explode(',', PMS_ALLOWABLE_EXTS);
        $this->allowableExts = array_map('trim', $exts);
    }
}
