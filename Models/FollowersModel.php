<?php

namespace Models;


class FollowersModel extends Model {
    
    public function getUserFollowers($arrayFollowers) {
        $followers = [];
        foreach ($arrayFollowers as $id) {
            $pdo = $this->getPDO();
            $stmt = $pdo->prepare("SELECT id, avatar, name, username FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $followers[] =  $stmt->fetchAll();
        }
       
        return $followers;
    }
}