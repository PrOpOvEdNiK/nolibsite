<?php


namespace BS\Controllers;


class Welcome extends Controller
{
    public function execute()
    {
        $this->arResult['SEO'] = [
            'h1'          => 'Главная',
            'title'       => 'Главная',
            'description' => 'Главная',
        ];
    }
}
