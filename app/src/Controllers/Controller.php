<?php


namespace BS\Controllers;


use BS\Main\Request;
use BS\Main\Response;

abstract class Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public $viewTemplate;
    public $arResult = [];

    final public function __construct($view, Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->viewTemplate = PATH_APP_PAGES . "/{$view}.php";

        $this->execute();
    }

    public function render()
    {
        $arResult = $this->arResult;
        include PATH_APP_VIEWS . "/_layout/header.php";
        include $this->viewTemplate;
        include PATH_APP_VIEWS . "/_layout/footer.php";
    }

    abstract public function execute();
}
