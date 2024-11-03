<?php

namespace Models;

class HashtagModel extends Model
{

    public function getTweets()
    {

        $pdo = $this->getPDO();

        $stmt = $pdo->prepare("SELECT t1.id as Numero, t1.id_user as ID, t1.message as MSG, t1.id_retweet,t1.id_reply_tweet , t2.id_user, t2.message FROM tweet as t1 LEFT OUTER JOIN tweet as t2 ON t1.id_retweet = t2.id JOIN users as F on t1.id_user = F.id WHERE t1.id_reply_tweet is NULL GROUP BY t1.id ORDER BY `Numero` ASC");

        $stmt->execute();
        $tweets = $stmt->fetchAll();

        return $tweets;
    }
}
