<?php

namespace Models;

class FollowModel extends Model {

    public function getHostFollowers($id_host){

        $pdo = $this->getPDO();
        
        
       //recupere la liste des followers 
        $stmt = $pdo->prepare("SELECT id_follower FROM users WHERE id = :id_user");
        $stmt->bindParam(":id_user", $id_host);
       
        $stmt->execute();
        $result = $stmt ->fetchAll();

        return $result;
    
    }

    public function getUserFollowings($id_user){

        $pdo = $this->getPDO();
        
        // recupere la liste des followings
        $stmt = $pdo->prepare("SELECT id_following FROM users WHERE id = :id_user");
        $stmt->bindParam(":id_user", $id_user);
       
        $stmt->execute();
        $result = $stmt ->fetchAll();

        return $result;
    
    }

    public function updateHostFollowers($id_host, $liste_followers){

        $pdo = $this->getPDO();
        
        //update la liste des followers
        $stmt = $pdo->prepare("UPDATE users SET id_follower = :liste_followers WHERE id = :id_user");
        $stmt->bindParam(":id_user", $id_host);
        $stmt->bindParam(":liste_followers", $liste_followers);
       
        $stmt->execute();
        $result = $stmt ->fetchAll();

        return $result;
    
    }

    public function updataUserFollowings($id_user, $liste_following){

        $pdo = $this->getPDO();
        
        //update la liste des followings
        $stmt = $pdo->prepare("UPDATE users SET id_following = :liste_following WHERE id = :id_user");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->bindParam(":liste_following", $liste_following);
       
        $stmt->execute();
        $result = $stmt ->fetchAll();

        return $result;
    
    }
    
}