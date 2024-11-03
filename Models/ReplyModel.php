<?php

namespace Models;

class ReplyModel extends Model {

   

    public function insertReply($id_user,$message,$id_tweet){
        //Inserer un commentaire dans la db
        $pdo = $this->getPDO();
      
      
        // Première requête
        $stmt = $pdo->prepare("INSERT INTO tweet (id_user, message, id_reply_tweet) VALUES (:id_user,:message,:id_tweet)");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->bindParam(":id_tweet", $id_tweet);
        $stmt->bindParam(":message", $message);
        $stmt->execute();
       
  }

    public function getReply($tweet_id){
        //recupere les likes  pour ajax pour les afficher

        $pdo = $this->getPDO();

        $stmt = $pdo->prepare("SELECT t.id,t.id_user,t.message,DATE_FORMAT(t.date_send, '%H' ':' '%i ' '%p' ' - ' '%d ' '%M ' '%Y') as 'date_send',t.id_reply_tweet,u.username,u.name,u.avatar
         from tweet as t join users as u on t.id_user = u.id where id_reply_tweet = :id_tweet ORDER BY t.date_send DESC;");
        
          $stmt->bindParam(":id_tweet", $tweet_id);
          $stmt->execute();
          $result = $stmt->fetchAll();

          return $result;
    }

}