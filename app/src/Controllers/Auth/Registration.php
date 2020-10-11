<?php


namespace BS\Controllers\Auth;


use BS\Controllers\Controller;
use BS\Facades\Auth;

class Registration extends Controller
{

    public function execute()
    {
        if (Auth::check()) {
            $this->response->redirect(ROUTE_ACCOUNT, 307);
        }

        $this->setMeta('Регистрация');

        $this->arResult['POST'] = $this->request->getPost();

        if ($this->request->has('action', 'post')) {
            $this->action(
                $this->request->filter('action', 'post', FILTER_SANITIZE_STRING)
            );
        }
    }

    private function action($action)
    {
        switch ($action) {
            case 'register':
                $this->arResult['SAVE'] = Auth::register($this->arResult['POST']);

                if ($this->arResult['SAVE']['SUCCESS']) {
                    $this->response->redirect(
                        $this->request->filter('backurl', 'post', FILTER_SANITIZE_STRING)
                    );
                }
                break;
        }
    }
}
