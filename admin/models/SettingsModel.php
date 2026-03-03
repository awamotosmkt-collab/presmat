<?php

namespace Pandao\Admin\Models;

class SettingsModel
{
    protected $pms_db;
    protected $configFile;
    protected $htaccessFile;

    public function __construct($db)
    {
        $this->pms_db = $db;
        $this->configFile = SYSBASE . 'config/config.php';
        $this->htaccessFile = SYSBASE . '.htaccess';
    }

    public function getConfig()
    {
        $config = [];
        $constants = get_defined_constants(true);
        if (isset($constants['user'])) {
            foreach ($constants['user'] as $key => $value) {
                if (strpos($key, 'PMS_') === 0) {
                    $config[mb_strtolower($key)] = $value;
                }
            }
        }
        return $config;
    }

    public function userExists($user, $currentUserId)
    {
        $stmt = $this->pms_db->prepare('SELECT * FROM pm_user WHERE login = :login AND id != :id');
        $stmt->execute(['login' => $user, 'id' => $currentUserId]);
        return $stmt->rowCount() > 0;
    }

    public function testDbConnection($config_tmp)
    {
        try {
            $db = new \PDO('mysql:host='.$config_tmp['pms_db_host'].';port='.$config_tmp['pms_db_port'].';dbname='.$config_tmp['pms_db_name'].';charset=utf8', $config_tmp['pms_db_user'], $config_tmp['pms_db_pass']);
            $db->exec('SET NAMES \'utf8\'');
            return $db;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function renameAdminFolder($config_tmp, $curr_dirname, $curr_folder)
    {
        $renamed = false;
        if ($config_tmp['pms_admin_folder'] != '') {
            $renamed = @rename($curr_dirname, SYSBASE . $config_tmp['pms_admin_folder']);
            if ($renamed && is_file($this->htaccessFile)) {
                $admin_rule = 'RewriteCond %{REQUEST_URI} /'.PMS_ADMIN_FOLDER.'/';
                $new_admin_rule = 'RewriteCond %{REQUEST_URI} /'.$config_tmp['pms_admin_folder'].'/';
                
                $ht_content = str_replace($admin_rule, $new_admin_rule, file_get_contents($this->htaccessFile));
                if (file_put_contents($this->htaccessFile, $ht_content) === false) {
                    return false;
                }
            }
        }
        return $renamed;
    }

    public function updateConfigFile($config_tmp, $renamed)
    {
        $config_str = file_get_contents($this->configFile);
        $count = substr_count($config_str, 'define(');

        foreach ($config_tmp as $key => $value) {
            if ($key != 'pms_admin_folder' || ($config_tmp['pms_admin_folder'] != '' && $renamed)) {
                $key_upper = mb_strtoupper($key, 'UTF-8');
                $value = strtr($value, array('\\\\' => '\\\\\\\\', '$' => '\\$'));
                $config_str = preg_replace('/define\(("|\')'.  $key_upper.'("|\'),(\s*)?("|\')?(.*?)("|\')?(\s*)?\);/i', 'define(\''. $key_upper.'\', \''. $value.'\');', $config_str);
            }
        }

        if ($config_str == '' || substr_count($config_str, 'define(') != $count || file_put_contents($this->configFile, $config_str) === false) {
            return false;
        }
        opcache_invalidate($this->configFile, true);
        
        return true;
    }

    public function updateUser($data)
    {
        $sql = 'UPDATE pm_user SET ';
        $fields = [];
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                $fields[] = "$key = :$key";
            }
        }
        $sql .= implode(', ', $fields);
        $sql .= ' WHERE id = :id';

        $stmt = $this->pms_db->prepare($sql);
        return $stmt->execute($data);
    }
}
