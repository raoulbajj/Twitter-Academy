<?php

namespace Controllers;
session_start();

use src\Render;


class LogoutController
{
    public function logout()
    {
        $logout = isset($_POST['logout']) ? $_POST['logout'] : "";

        if ($logout != "") {
            session_destroy();
            header('Location: /');
            exit;
        }
    }
}