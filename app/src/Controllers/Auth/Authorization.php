<?php


namespace BS\Controllers\Auth;


use BS\Controllers\Controller;
use BS\Facades\Auth;

class Authorization extends Controller
{

    public function execute()
    {
        if (Auth::check()) {
            $this->response->redirect(ROUTE_ACCOUNT, 307);
        }

        $this->setMeta('Авторизация');

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
            case 'login':
                $login = $this->request->filter('EMAIL', 'post', FILTER_SANITIZE_EMAIL);
                $password = $this->request->filter('PASSWORD', 'post', FILTER_SANITIZE_STRING);

                $userId = Auth::login($login, $password);

                if ($userId > 0) {
                    $this->response->redirect(
                        $this->request->filter('backurl', 'post', FILTER_SANITIZE_STRING)
                    );
                } else {
                    $this->arResult['SAVE'] = [
                        'ERRORS' => [
                            ['Неверный логин или пароль']
                        ]
                    ];
                }
                break;
        }
    }
}
