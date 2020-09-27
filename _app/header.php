<?php

session_start();

ini_set('display_errors', 'stderr');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once __DIR__ . "/bootstrap.php";

global $DB;
// get db connection instance

// do logic?

require_once __DIR__ . "/public/layout/header.php";
