<?php

namespace Controllers;
session_start();
use src\Render;
use Models\HomeModel;
use Models\LoginModel;

class HomeController
{
    public function index(): Render
   
    {   
        return Render::make('loginregister');
    }
}