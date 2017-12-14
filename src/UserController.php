<?php
namespace Itb;


class UserController
{
    private $sessionManager;
    private $adminController;
    private $twig;

    public function __construct($twig, $sessionManager)
    {
        $this->twig = $twig;
        $this->sessionManager = $sessionManager;
        $this->adminController = new AdminController($twig, $sessionManager);
    }

    public function loginFormAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $template = 'login.html.twig';
        $args = [
            'pageTitle' => 'images',
            'isLoggedIn' => $isLoggedIn,
            'username' => $username,

        ];

        $html = $this->twig->render($template, $args);
        print $html;
    }

    public function processLoginAction($username, $password)
    {
        if($this->validCredentials($username, $password)){
            $_SESSION['username'] = $username;
            $this->adminController->adminPageAction();
        } else {
            $this->loginErrorAction();
        }
    }


    public function loginErrorAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $template = 'loginError.html.twig';
        $args = [
            'isLoggedIn' => $isLoggedIn,
            'username' => $username,

        ];

        $html = $this->twig->render($template, $args);
        print $html;
    }

    private function validCredentials($u, $p)
    {
        if('admin' == $u && 'admin' == $p){
            return true;
        } else {
            return false;
        }
    }


}