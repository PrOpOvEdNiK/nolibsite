<?php


namespace BS\Settings;


final class Config
{
    /**
     * @var Config;
     */
    private static $instance;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    private $arConfig = [];
    private $isLoaded = false;

    private const CONFIG_FILE_PATH = "/_app/_config.php";

    public static function getInstance(): Config
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function getValue($name)
    {
        $config = Config::getInstance();
        return $config->get($name);
    }

    public function get($name)
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
            }
        }
    }

    private static function getPath()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . self::CONFIG_FILE_PATH;
        return preg_replace("'[\\\\/]+'", "/", $path);
    }
}
