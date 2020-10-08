<?php


namespace BS\Main;


use BS\Auth\AuthManager;

class Application
{
    /**
     * @var Application
     */
    private static $instance;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Request
     */
    private $request;

    private function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Application
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }
}
