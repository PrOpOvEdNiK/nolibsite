<?php


namespace BS\Settings;


final class Config
{
    private $arConfig = [];
    private $isLoaded = false;

    private function get($name)
    {
        if (!$this->isLoaded) {
            $this->loadConfiguration();
        }

        if (isset($this->arConfig[$name])) {
            return $this->arConfig[$name];
        }

        return null;
    }

    private function loadConfiguration()
    {
        $this->isLoaded = false;

        $path = static::getPath();
        if (file_exists($path)) {
            $dataTmp = include($path);
            if (is_array($dataTmp)) {
                $this->arConfig = $dataTmp;
                $this->isLoaded = true;
            }
        }
    }

    private static function getPath()
    {
        $path = PATH_APP_CONFIG;
        return preg_replace("'[\\\\/]+'", "/", $path);
    }

    public function getValue($name)
    {
        return $this->get($name);
    }

    public function getDsn()
    {
        return $this->getValue('connection');
    }

    public function getAppName()
    {
        return $this->getValue('app')['name'];
    }

    public function getMode()
    {
        return $this->getValue('app')['mode'];
    }
}
