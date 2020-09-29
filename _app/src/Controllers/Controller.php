<?php


namespace BS\Controllers;


abstract class Controller
{
    public const PATH_VIEW = "/_app/public/view/";

    public $viewTemplate;
    public $arResult = [];

    final public function __construct($viewTemplate)
    {
        $this->viewTemplate = $_SERVER['DOCUMENT_ROOT'] . self::PATH_VIEW . "{$viewTemplate}.php";

        $this->execute();
        $this->includeTemplate();
    }

    protected function includeTemplate()
    {
        $arResult = $this->arResult;
        include $this->viewTemplate;
    }

    abstract public function execute();
}
