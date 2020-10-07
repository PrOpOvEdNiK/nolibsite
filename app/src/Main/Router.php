<?php


namespace BS\Main;


use BS\Controllers\Controller;
use BS\Facades\Auth;

class Router
{
    /**
     * @var Route[]
     */
    private $arRoutes;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->response = new Response();
    }

    public function addRoute(string $url, Route $route): void
    {
        $this->arRoutes[$url] = $route;
    }

    private function getRoute(): Route
    {
        $url = $this->request->filter('REQUEST_URI', 'server', FILTER_SANITIZE_URL);
        $routeUrl = parse_url(urldecode($url), PHP_URL_PATH);

        return $this->checkRoute($routeUrl);
    }

    private function checkRoute($routeUrl): Route
    {
        if (!array_key_exists($routeUrl, $this->arRoutes)) {
            $this->response->sendNotFound("Route not found");
        }

        $route = $this->arRoutes[$routeUrl];

        if (!class_exists($route->controller)) {
            $this->response->sendNotFound("Class {$route->controller} not found");
        }

        return $route;
    }

    public function run()
    {
        $this->runRoute($this->getRoute());
    }

    private function runRoute(Route $route)
    {
        if ($route->isSecure && !Auth::check()) {
            $this->response->redirect(PATH_PUBLIC_LOGIN, 307);
        }

        /**
         * @var Controller $obController
         */
        $obController = new $route->controller($route->view, $this->request, $this->response);

        ob_start();
        $obController->render();
        $content = ob_get_clean();

        $this->response->setContent($content)->send();
    }
}
