<?php

namespace Models;


class FollowingModel extends Model {
    
    public function getUserFollowing($arrayFollowing) {
        $following = [];
        foreach ($arrayFollowing as $id) {
            $pdo = $this->getPDO();
            $stmt = $pdo->prepare("SELECT id, avatar, name, username FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $following[] =  $stmt->fetchAll();
        }
        return $following;
    }
}