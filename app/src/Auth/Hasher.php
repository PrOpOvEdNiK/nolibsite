<?php


namespace BS\Auth;


use BS\Main\Application;

class Hasher
{
    private const SALT_REGISTER = "awesomeregistersalt";

    public static function register($password)
    {
        return md5(md5($password . self::SALT_REGISTER) . self::SALT_REGISTER);
    }

    public static function client()
    {
        $request = Application::getInstance()->getRequest();
        $userAgent = $request->filter('HTTP_USER_AGENT', 'server', FILTER_SANITIZE_STRING);
        $userIp = $request->filter('REMOTE_ADDR', 'server', FILTER_SANITIZE_STRING);
        $tokenEntropy = md5($userAgent) . md5($userIp);

        return md5($tokenEntropy);
    }
}
