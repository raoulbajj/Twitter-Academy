<?php

namespace Models;


class TrendsModel extends Model {

    public function getTrends()
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT t1.id as Numero, t1.id_user as ID, t1.message as MSG, DATE_FORMAT(t1.date_send, '%H' ':' '%i ' '%p' ' - ' '%d ' '%M ' '%Y') as 'date_send', t1.id_retweet,t1.id_reply_tweet , t2.id_user, t2.message, DATE_FORMAT(t2.date_send, '%H' ':' '%i ' '%p' ' - ' '%d ' '%M ' '%Y') as dateTweet, F.username as F,F.name as FName, F.avatar as FAvatar,U.username as U, U.name as UName, U.avatar as UAvatar,count(likes.id_user) as likes 
        FROM tweet as t1 
        LEFT OUTER JOIN tweet as t2 ON t1.id_retweet = t2.id 
        JOIN users as F on t1.id_user = F.id 
        LEFT JOIN users as U on t2.id_user = U.id 
        LEFT JOIN likes on t1.id = likes.id_tweet 
        WHERE t1.id_reply_tweet is NULL GROUP BY t1.id ORDER BY COUNT(likes.id_user) DESC;");
        $stmt->execute();
        $trends = $stmt->fetchAll();
        return $trends;
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
        $stmt = $pdo->prepare("Select id_reply_tweet, id_user from tweet where id_reply_tweet IS NOT NULL;");
        $stmt ->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}