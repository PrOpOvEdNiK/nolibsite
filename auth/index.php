<?php

global $pageTitle;
$pageTitle = "Авторизация";

require_once $_SERVER['DOCUMENT_ROOT'] . "/_app/header.php";

callComponent('Auth\\Authorization', 'auth/authorization');

require_once $_SERVER['DOCUMENT_ROOT'] . "/_app/footer.php";
