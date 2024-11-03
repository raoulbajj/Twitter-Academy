<?php

namespace Models;

class TweetModel extends Model {
    public function postTweets($id, $message) {
        $id = intval($id);
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("INSERT INTO tweet (id_user, message) 
        VALUES (:id, :message)");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":message", $message);
        $stmt->execute();
    }
}