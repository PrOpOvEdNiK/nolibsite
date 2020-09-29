<?php


namespace BS\Controllers;


abstract class Controller
{
    public const PATH_VIEW = "/_app/public/view/";

    public $viewTemplate;
    public $arResult = [];

    final public function __construct($viewTemplate = "_default")
    {
        $viewFolder = mb_strtolower((new \ReflectionClass($this))->getShortName());
        $this->viewTemplate = $_SERVER['DOCUMENT_ROOT'] . self::PATH_VIEW . "{$viewFolder}/{$viewTemplate}.php";

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
