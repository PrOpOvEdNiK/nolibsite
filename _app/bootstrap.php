<?php

use BS\Auth\AuthManager;
use BS\Facades\Config;

session_start();

spl_autoload_register(
    function ($class) {
        // project-specific namespace prefix
        $prefix = 'BS\\';

        // base directory for the namespace prefix
        $base_dir = __DIR__ . '/src/';

        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }

        // get the relative class name
        $relative_class = substr($class, $len);

        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
);

require_once __DIR__ . "/include/functions.php";
require_once __DIR__ . "/include/constants.php";

if (Config::getMode() == 'dev') {
    ini_set('display_errors', 'stderr');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
} else {
    ini_set('display_errors', 'off');
    error_reporting(0);
}

new AuthManager();
