<?php
namespace Itb;

class MainController
{
    private $twig;
    private $userController;
    private $sessionManager;

    public function __construct($twig, $sessionManager)
    {
        $this->twig = $twig;
        $this->sessionManager = $sessionManager;
        $this->userController = new UserController($twig, $sessionManager);
    }

    public function indexAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $template = 'index.html.twig';
        $argsArray = [
            'pageTitle' => 'index',
            'isLoggedIn' => $isLoggedIn,
            'username' => $username
        ];
        $html =  $this->twig->render($template, $argsArray);
        print $html;
    }

    public function gamesAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $template = 'games.html.twig';
        $argsArray = [
            'pageTitle' => 'games',
            'isLoggedIn' => $isLoggedIn,
            'username' => $username
        ];
        $html =  $this->twig->render($template, $argsArray);
        print $html;
    }

    public function adminAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $template = 'admin.html.twig';
        $argsArray = [
            'pageTitle' => 'admin',
            'isLoggedIn' => $isLoggedIn,
            'username' => $username
        ];
        $html =  $this->twig->render($template, $argsArray);
        print $html;
    }



    public function developersAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $template = 'developers.html.twig';
        $argsArray = [
            'pageTitle' => 'developers',
            'isLoggedIn' => $isLoggedIn,
            'username' => $username
        ];
        $html =  $this->twig->render($template, $argsArray);
        print $html;
    }

    public function loginAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $template = 'login.html.twig';
        $argsArray = [
            'pageTitle' => 'UsersRepository',
            'isLoggedIn' => $isLoggedIn,
            'username' => $username
        ];
        $html =  $this->twig->render($template, $argsArray);
        print $html;
    }

    public function storeAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $storeRepository = new StoreRepository();
        $names = $storeRepository->getAll();


        $template = 'store.html.twig';
        $argsArray = [
            'pageTitle' => 'store',
            'names' => $names,
            'isLoggedIn' => $isLoggedIn,
            'username' => $username
        ];
        $html =  $this->twig->render($template, $argsArray);
        print $html;

    }


    public function logoutAction()
    {
        $this->sessionManager->killSession();
        $this->indexAction();
    }
    public function setupAction(){
        include_once __DIR__.'/../setup/setup_database.php';
    }

}
