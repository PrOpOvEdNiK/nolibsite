<?php

global $pageTitle;
$pageTitle = "Главная";

require_once $_SERVER['DOCUMENT_ROOT'] . "/_app/header.php";

callComponent('Welcome', 'common/welcome');

require_once $_SERVER['DOCUMENT_ROOT'] . "/_app/footer.php";
