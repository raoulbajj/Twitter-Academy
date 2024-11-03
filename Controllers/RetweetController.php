<?php

namespace Controllers;


use Models\RetweetModel;


class RetweetController
{
    
    function retweet(){
        //recuperer l'id du tweet 
        $id_tweet = isset($_POST["id_tweet"])?$_POST["id_tweet"]:"";
        $id_user = isset($_POST["id_user"])?$_POST["id_user"]:"";
        
        $retweetModel = new RetweetModel();

        //verifier si c'est une insertion 
        if(isset($_POST["id_user"])){
            
            $id_user = $_POST["id_user"];
            $retweetModel->insertRetweet($id_user,$id_tweet);

        }       
    }
   
}