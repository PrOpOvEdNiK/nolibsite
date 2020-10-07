<?php


namespace BS\Auth;


class Hasher
{
    private const SALT_REGISTER = "awesomeregistersalt";

    public static function register($password)
    {
        return md5(md5($password . self::SALT_REGISTER) . self::SALT_REGISTER);
    }

    public static function client()
    {
        $userAgent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING);
        $userIp = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
        $hashSalt = md5($userAgent) . md5($userIp);

        return md5($hashSalt);
    }
}
