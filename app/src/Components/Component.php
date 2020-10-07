<?php


namespace BS\Components;


abstract class Component
{
    public $viewTemplate;
    public $arResult = [];
    public $arParams = [];

    public function __construct($view, $arParams = [])
    {
        $this->viewTemplate = PATH_APP_VIEWS . "/{$view}.php";
        $this->arParams = $arParams;

        $this->execute();
        $this->render();
    }

    protected function render()
    {
        $arParams = $this->arParams;
        $arResult = $this->arResult;
        include $this->viewTemplate;
    }

    abstract public function execute();
}
