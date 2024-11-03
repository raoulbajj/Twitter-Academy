<?php

namespace Controllers;
session_start();

use Models\LikesModel;


class LikesController
{
    
    function updateLikes(){
        //recuperer l'id du tweet et celui de l'utilisateur
        $id_tweet = isset($_POST["id_tweet"])?$_POST["id_tweet"]:"";
        $id_user = $_SESSION["user"][0]->id;
        

        //verifier si les deux sont pas empty 
       
        if($id_tweet != "" && $id_user != ""){
          
            $likesModel = new LikesModel();
            
            $isLiked = $likesModel->checkIfUserLiked($id_user,$id_tweet);
            
            if($isLiked == false){
                $likesModel->insertLikes($id_user,$id_tweet);
               
            }else{
                $likesModel->deleteLikes($id_user,$id_tweet);
            }
            $likes = $likesModel->getLikes($id_tweet);
            $likes_encoded = json_encode($likes);
            echo "$likes_encoded";
        }
        
        // return Render::make('profile');
    }
   
}