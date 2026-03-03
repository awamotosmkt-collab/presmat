<?php

namespace Pandao\Common\Services;

class Csrf
{
    public static function generateToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function verifyToken($type)
    {
        $token = ($type == 'post') ? $_POST['csrf_token'] ?? false : ($type == 'get' ? $_GET['csrf_token'] ?? false : false);

        if ($token && isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            return true;
        }
        return false;
    }

    public static function invalidateToken()
    {
        unset($_SESSION['csrf_token']);
    }
}
