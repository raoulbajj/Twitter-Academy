<?php

namespace Controllers;
session_start();
use src\Render;
use Models\HomeModel;
use Models\LoginModel;


class LoginController
{

    public function connect()
    {
        $salt =  "vive le projet tweet_academy";

        $passwordClear = isset($_POST['password_1']) ? $_POST['password_1'] : "";
        $password = isset($_POST['password_1']) ? hash('ripemd160', $salt . $_POST['password_1']) : "";
        $username = isset($_POST['username']) ? ($_POST['username']) : "";
       
        // on instancie l'oobject de la classe LoginModel 
        $loginModel = new LoginModel();

        // on verifie si l'utilisateur existe est en stock le boolean 
        $checkIfUserExist = $loginModel->checkIfUserExist($username,$password);
        
        if ($checkIfUserExist == true) {
            // $checkIfUserIsDisabled = $loginModel->UserIsDisabled();// on verifie si l'utilisateur a un compté desactivé est on stock
            $checkIfUserIsDisabled = $loginModel->checkIfUserDisabled($username);
            if ($checkIfUserIsDisabled == true) {
                $_SESSION['disabled_error'] = true;
                return Render::make('loginregister');
            }
            else {
                // si l'utilisateur existe alors on stock l'utilisateur dans la session
                $user = $loginModel->getUser($username); // on recupere les info de l'utilisateur
                $_SESSION["user"] = $user;
                $_SESSION["password"] = $passwordClear;
                header("Location: /profile");
                return Render::make('profile');
            }
        }

        else {
            $_SESSION['login_error'] = true;
            return Render::make('loginregister');
        }
    }
}