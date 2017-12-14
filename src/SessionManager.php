<?php


namespace Itb;


class SessionManager
{

    public function killSession()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(	session_name(),
                '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
    }

    public function usernameFromSession()
    {
        if(isset($_SESSION['username'])){
            return $_SESSION['username'];
        } else {
            return '';
        }
    }


    public function isLoggedIn()
    {
        if(isset($_SESSION['username'])){
            return true;
        } else {
            return false;
        }
    }


}