<?php

namespace Models;

class SearchModel extends Model {

    public function getHashtagTweets($hashtag){

        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT t1.id AS Numero, t1.id_user AS ID, t1.message AS MSG, DATE_FORMAT(t1.date_send, '%H' ':' '%i ' '%p' ' - ' '%d ' '%M ' '%Y') AS 'date_send', t1.id_retweet,t1.id_reply_tweet , t2.id_user, t2.message, DATE_FORMAT(t2.date_send, '%H' ':' '%i ' '%p' ' - ' '%d ' '%M ' '%Y') AS dateTweet, F.username AS F,F.name AS FName, F.avatar AS FAvatar,U.username AS U, U.name AS UName, U.avatar AS UAvatar,count(likes.id_user) AS likes 
        FROM tweet AS t1 
        LEFT OUTER JOIN tweet as t2 ON t1.id_retweet = t2.id 
        JOIN users AS F ON t1.id_user = F.id 
        LEFT JOIN users AS U on t2.id_user = U.id 
        LEFT JOIN likes ON t1.id = likes.id_tweet 
        WHERE t1.id_reply_tweet is NULL AND (t1.message LIKE concat('%',:hashtag,'%') OR t2.message LIKE concat('%',:hashtag,'%')) 
        GROUP BY t1.id 
        ORDER BY count(likes.id_user) DESC");
        $stmt->bindParam(":hashtag", $hashtag);
        $stmt->execute();

        $tweets = $stmt->fetchAll();

        return $tweets;
    }

    public function getLikesTable(){
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM likes");
        $stmt ->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getRetweetTable(){
        
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT id_retweet, id_user from tweet where id_retweet IS NOT NULL;");
        $stmt ->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCommentTable(){
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT id_reply_tweet, id_user from tweet where id_reply_tweet IS NOT NULL;");
        $stmt ->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}