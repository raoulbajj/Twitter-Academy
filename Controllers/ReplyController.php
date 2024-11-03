<?php

namespace Controllers;


use Models\ReplyModel;


class ReplyController
{
    
    function displayComments(){
        //recuperer l'id du tweet 
        $id_tweet = isset($_POST["id_tweet"])?$_POST["id_tweet"]:"";
        
        $replyModel = new ReplyModel();

        //verifier si c'est une insertion 
        if(isset($_POST["message"])){
            $message = $_POST["message"];
            $id_user = $_POST["id_user"];
            $replyModel->insertReply($id_user,$message,$id_tweet);
        }
        

        //verifier si  empty 
       
        if($id_tweet != ""){
            $replies = $replyModel->getReply($id_tweet);
            $replies_encoded = json_encode($replies);
            
            echo "$replies_encoded";
        }
           
       
    }
   
}