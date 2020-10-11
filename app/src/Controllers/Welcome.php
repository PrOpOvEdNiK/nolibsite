<?php


namespace BS\Controllers;


use BS\Facades\Auth;

class Welcome extends Controller
{
    public function execute()
    {
        $this->setMeta('Главная');
    }
}
