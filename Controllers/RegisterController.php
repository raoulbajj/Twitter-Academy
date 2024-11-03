<?php

namespace Controllers;

session_start();
use src\Render;


use Models\Model;
use Models\RegisterModel;


class RegisterController
{

    public function register(): Render
    {
        return Render::make('loginregister');
    }

    public function validate(): Render
    {

        function username_encode($str) {
            $table = array(
                'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'AE', 'Ç'=>'C',
                'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',
                'Ð'=>'D', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', '×'=>'x',
                'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'TH', 'ß'=>'ss',
                'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c',
                'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
                'ð'=>'d', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
                'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'þ'=>'th', 'ÿ'=>'y', 'Œ'=>'OE',
                'œ'=>'oe', 'Š'=>'S', 'š'=>'s', 'Ÿ'=>'Y', 'ƒ'=>'f'
            );
            $str = strtr($str, $table);
            $str = preg_replace('/[^a-zA-Z0-9]/', '', $str);
            $str = strtolower($str);
            $str .= rand(1,9999);
            return $str;
        }

        $salt = "vive le projet tweet_academy";
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $password = isset($_POST['password']) ? hash('ripemd160', $salt . $_POST['password']) : "";
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : "";
        $avatar = "https://tinyurl.com/y77pumfz";
        $banner = "https://tinyurl.com/2ue5mvb9";
        $username = username_encode($name);
        
        $register = new RegisterModel();
        
        // var_dump($register);
        $checkEmail = $register->checkIfEmailExist($email);
       
        $_SESSION['validate_success'] = false;

       if ($checkEmail == true) {
            $_SESSION['email_exist'] = true;
            return Render::make('loginregister');
       }
       else {
            $_SESSION['validate_success'] = true;
            $register->InsertUser($name, $email, $password, $birthdate, $avatar, $banner, $username);
            return Render::make('loginregister');
       }
    }
}
