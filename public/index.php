<?php
/**
 * Entry point for the public folder.
 * Pandao CMS Bootstrap
 */

// Define SYSBASE early so config can use it.
define('SYSBASE', realpath(__DIR__ . '/..') . '/');

if (is_file(SYSBASE . 'config/config.php')) {
    require_once SYSBASE . 'config/config.php';
}

if (!defined('PMS_ADMIN_FOLDER')) {
    define('PMS_ADMIN_FOLDER', 'admin');
}

require_once SYSBASE . 'common/core/Autoloader.php';
require_once SYSBASE . 'core/Router.php';

$context = new \Pandao\Core\Router();
$context->dispatch();
