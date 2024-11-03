<?php

namespace Models;

class LikesModel extends Model {

    public function checkIfUserLiked($username_id,$tweet_id) {

        //Verifier si l'utilisateur a liked le tweet
        $pdo = $this->getPDO();
        
        
        // Première requête
        $stmt = $pdo->prepare("SELECT * FROM likes WHERE id_user LIKE :id_user AND id_tweet LIKE :id_tweet");
        $stmt->bindParam(":id_user", $username_id);
        $stmt->bindParam(":id_tweet", $tweet_id);
        $stmt->execute();
    
        // Vérifie le nombre de résultats retournés
        if ($stmt->rowCount() > 0) {
            // User a liké
            return true;
        } else {
            // User n'a pas liké
            return false;
        }
    }

    public function insertLikes($username_id,$tweet_id){
          //Inserer un like 
          $pdo = $this->getPDO();
        
        
          // Première requête
          $stmt = $pdo->prepare("INSERT INTO likes (id_tweet,id_user) VALUES (:id_tweet, :id_user)");
          $stmt->bindParam(":id_user", $username_id);
          $stmt->bindParam(":id_tweet", $tweet_id);
          $stmt->execute();
         
    }

    public function deleteLikes($id_user,$id_tweet){
      
        $pdo = $this->getPDO();

        $stmt = $pdo->prepare("DELETE from likes where id_tweet = :id_tweet and id_user = :id_user;");
        
          $stmt->bindParam(":id_tweet", $id_tweet);
          $stmt->bindParam(":id_user", $id_user);

          $stmt->execute();
    }

    public function getLikes($tweet_id){
        //recupere les likes pour ajax pour les afficher

        $pdo = $this->getPDO();

        $stmt = $pdo->prepare("SELECT count(id_user) as likes from likes where id_tweet = :id_tweet group by id_tweet;");
        
          $stmt->bindParam(":id_tweet", $tweet_id);
          $stmt->execute();
          $result = $stmt->fetchAll();

          return $result;
    }



}