<?php

use BS\Main\Application;
use BS\Main\Route;

require_once __DIR__ . "/../app/bootstrap.php";

$obApplication = Application::getInstance();

$obRouter = $obApplication->getRouter();
$obRouter->addRoute('/', new Route(BS\Controllers\Welcome::class, 'welcome'));
$obRouter->addRoute('/auth/register/', new Route(\BS\Controllers\Auth\Registration::class, 'auth/registration'));

$obRouter->run();
