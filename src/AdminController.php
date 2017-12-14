<?php
namespace Itb;


class AdminController
{
    private $sessionManager;
    private $twig;

    public function __construct($twig, $sessionManager)
    {
        $this->twig = $twig;
        $this->sessionManager = $sessionManager;
    }

    public function adminPageAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();


        $args = [

            'isLoggedIn' => $isLoggedIn,
            'username' => $username,

        ];

        // default - not authorised
        $template = 'errorNotLoggedIn.html.twig';

        // if is logged in - allow access to admin home page
        if($isLoggedIn){
            $template = 'adminPage.html.twig';
        }

        $html = $this->twig->render($template, $args);
        print $html;
    }


    public function adminDeleteAllAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();


        $args = [
            'isLoggedIn' => $isLoggedIn,
            'username' => $username,

        ];

        // default - not authorised
        $template = 'errorNotLoggedIn.html.twig';

        // if is logged in - allow access to admin home page
        if($isLoggedIn){
            $template = 'adminDeleteAll.html.twig';


        }

        $html = $this->twig->render($template, $args);
        print $html;
    }
    public function itemAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();

        $storeRepository = new StoreRepository();
        $names = $storeRepository->getAll();



        $args = [
            'isLoggedIn' => $isLoggedIn,
            'username' => $username,
            'names' => $names,

        ];

        // default - not authorised
        $template = 'errorNotLoggedIn.html.twig';

        // if is logged in - allow access to admin home page
        if($isLoggedIn){
            $template = 'items.html.twig';


        }

        $html = $this->twig->render($template, $args);
        print $html;
    }

    public function addAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();


        $args = [
            'isLoggedIn' => $isLoggedIn,
            'username' => $username,

        ];

        // default - not authorised
        $template = 'errorNotLoggedIn.html.twig';

        // if is logged in - allow access to admin home page
        if($isLoggedIn){
            $template = 'add.html.twig';


        }

        $html = $this->twig->render($template, $args);
        print $html;
    }
    public function deleteAction()
    {
        $isLoggedIn = $this->sessionManager->isLoggedIn();
        $username = $this->sessionManager->usernameFromSession();


        $args = [
            'isLoggedIn' => $isLoggedIn,
            'username' => $username,

        ];

        // default - not authorised
        $template = 'errorNotLoggedIn.html.twig';

        // if is logged in - allow access to admin home page
        if($isLoggedIn){
            $template = 'delete.html.twig';


        }

        $html = $this->twig->render($template, $args);
        print $html;
    }



}