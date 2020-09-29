<?php


namespace BS\Controllers;


use BS\Facades\Auth;

class Welcome extends Controller
{
    public function execute()
    {
        if (Auth::check()) {
            $userName = Auth::getUserFullName();
            $this->arResult['TEXT'] = "Привет, {$userName}!";
        } else {
            $this->arResult['TEXT'] = "Привет!";
        }
    }
}
