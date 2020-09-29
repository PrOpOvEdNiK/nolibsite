<?php


namespace BS\App;


use BS\Facades\Config;

class Assets
{
    public static function getVersion()
    {
        $isDev = Config::getMode() == 'dev';
        $version = $isDev ? time() : Config::getValue('app')['assetsVersion'];

        return "?v={$version}";
    }
}
