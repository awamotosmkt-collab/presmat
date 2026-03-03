<?php

namespace Pandao\Common\Utils;

class AuthUtils
{
    /**
     * Hashes a password using bcrypt.
     *
     * @param string $password Plain text password.
     * @return string Hashed password.
     */
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verifies a password against a hash.
     *
     * @param string $password Plain text password.
     * @param string $hash The hash to verify against.
     * @return bool True if valid.
     */
    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
