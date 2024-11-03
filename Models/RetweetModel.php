<?php

namespace Models;

class RetweetModel extends Model {

   

    public function insertRetweet($id_user,$id_tweet){
          //Inserer un commentaire dans la db
          $pdo = $this->getPDO();
        
        
          // Première requête
          $stmt = $pdo->prepare("INSERT INTO tweet (id_user, message, id_retweet) VALUES (:id_user,' ',:id_tweet)");
          $stmt->bindParam(":id_user", $id_user);
          $stmt->bindParam(":id_tweet", $id_tweet);
          
          $stmt->execute();
         
    }
}