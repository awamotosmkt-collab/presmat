<?php

namespace Pandao\Common\Core;

use \PDO;
use \PDOException;

class Database extends PDO
{
    public $isConnected = false;

    public function __construct($host, $dbname, $port, $username, $password, $options = [])
    {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
        $defaultOptions = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $options = array_replace($defaultOptions, $options);

        try {
            parent::__construct($dsn, $username, $password, $options);
            $this->isConnected = true;
        } catch (PDOException $e) {
            $this->isConnected = false;
        }
    }

    public function last_row_count()
    {
        return $this->query('SELECT FOUND_ROWS()')->fetchColumn();
    }
}
