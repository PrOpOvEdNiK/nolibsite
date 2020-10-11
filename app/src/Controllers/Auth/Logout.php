<?php


namespace BS\Controllers\Auth;


use BS\Facades\Auth;

class Logout extends \BS\Controllers\Controller
{

    public function execute()
    {
        Auth::logout(ROUTE_HOMEPAGE);
    }
}
