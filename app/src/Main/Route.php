<?php


namespace BS\Main;


class Route
{
    /**
     * @var string
     */
    public $controller;

    /**
     * @var string
     */
    public $view;

    /**
     * @var bool
     */
    public $isSecure;

    public function __construct(string $controller, string $view, bool $isSecure = false)
    {
        $this->controller = $controller;
        $this->view = $view;
        $this->isSecure = $isSecure;
    }
}
