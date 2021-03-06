<?php

define('PATH_APP_MAIN', __DIR__ . "/..");
define('PATH_APP_CONFIG', PATH_APP_MAIN . "/_config.php");
define('PATH_APP_VIEWS', PATH_APP_MAIN . '/../views');
define('PATH_APP_PAGES', PATH_APP_VIEWS . '/_pages');

define('PATH_PUBLIC_ASSETS', '/assets');
define('PATH_404', '/404');

define('ROUTE_HOMEPAGE', '/');
define('ROUTE_LOGIN', '/auth/');
define('ROUTE_LOGOUT', '/auth/logout/');
define('ROUTE_REGISTER', '/auth/register/');
define('ROUTE_ACCOUNT', '/account/');

define('DB_FALLBACK_LIMIT', 10);
