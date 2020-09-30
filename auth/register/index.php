<?php

global $pageTitle;
$pageTitle = "Регистрация";

require_once $_SERVER['DOCUMENT_ROOT'] . "/_app/header.php";

callComponent('Auth\\Registration', 'auth/registration');

require_once $_SERVER['DOCUMENT_ROOT'] . "/_app/footer.php";
