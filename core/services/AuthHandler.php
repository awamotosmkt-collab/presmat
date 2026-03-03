<?php

namespace Pandao\Core\Services;

class AuthHandler
{
    public static function login($user)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['login'] = $user['login'];
        $_SESSION['user']['type'] = $user['type'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['login_time'] = time();
    }

    public static function isAuthenticated()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return isset($_SESSION['user']['id']);
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
    }
}
