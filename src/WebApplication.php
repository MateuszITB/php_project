<?php
namespace Itb;

class WebApplication
{
    const PATH_TO_TEMPLATES = __DIR__ . '/../views';

    private $mainController;
    private $userController;
    private $adminController;

    public function __construct()
    {
        $twig = new \Twig\Environment(new \Twig_Loader_Filesystem(self::PATH_TO_TEMPLATES));
        $sessionManager = new SessionManager();
        $this->mainController = new MainController($twig, $sessionManager);
        $this->userController = new UserController($twig, $sessionManager);
        $this->adminController = new AdminController($twig, $sessionManager);
    }

    public function run()
    {
        $action = filter_input(INPUT_GET, 'action');
        if(empty($action)){
            $action = filter_input(INPUT_POST, 'action');
        }

        switch($action){
            case 'games':
                $this->mainController->gamesAction();
                break;

            case 'adminDeleteAll':
                $this->adminController->adminDeleteAllAction();
                break;

            case 'item':
                $this->adminController->itemAction();
                break;

            case 'add':
                $this->adminController->addAction();
                break;

            case 'delete':
                $this->adminController->deleteAction();
                break;

            case 'admin':
                $this->mainController->adminAction();
                break;

            case 'login':
                $this->mainController->loginAction();
                break;

            case 'logout':
                $this->mainController->logoutAction();
                break;

            case 'clearSession':
                $this->mainController->endSessionAction();
                break;

            case 'processLogin':
                $username = filter_input(INPUT_POST, 'username');
                $password = filter_input(INPUT_POST, 'password');
                $this->userController->processLoginAction($username, $password);
                break;


            case 'developers':
                $this->mainController->developersAction();
                break;

            case 'store':
                $this->mainController->storeAction();
                break;

            case 'index':
            default:
                $this->mainController->indexAction();
        }
    }
}
