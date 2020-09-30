<?php


namespace BS\Controllers;


abstract class Controller
{
    public const PATH_VIEW = "/_app/public/view/";

    public $viewTemplate;
    public $arResult = [];
    public $arParams = [];

    final public function __construct($viewTemplate, $arParams)
    {
        $this->viewTemplate = $_SERVER['DOCUMENT_ROOT'] . self::PATH_VIEW . "{$viewTemplate}.php";
        $this->arParams = $arParams;

        $this->execute();
        $this->includeTemplate();
    }

    protected function includeTemplate()
    {
        $arResult = $this->arResult;
        $arParams = $this->arParams;
        include $this->viewTemplate;
    }

    abstract public function execute();
}
