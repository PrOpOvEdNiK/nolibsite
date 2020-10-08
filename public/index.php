<?php

use BS\Main\Application;
use BS\Main\Route;

require_once __DIR__ . "/../app/bootstrap.php";

$obApplication = Application::getInstance();

$obRouter = $obApplication->getRouter();
$obRouter->addRoute(ROUTE_HOMEPAGE, new Route(BS\Controllers\Welcome::class, 'welcome'));
$obRouter->addRoute(ROUTE_LOGIN, new Route(BS\Controllers\Auth\Registration::class, 'auth/authorization'));
$obRouter->addRoute(ROUTE_REGISTER, new Route(BS\Controllers\Auth\Registration::class, 'auth/registration'));

$obRouter->run();
