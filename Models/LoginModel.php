<?php

namespace Models;

class LoginModel extends Model {

    public function checkIfUserExist($username,$password) {

        $pdo = $this->getPDO();
        
        
        // Première requête
        $stmt = $pdo->prepare("SELECT * FROM users WHERE (username LIKE :username OR email LIKE :email) AND (password LIKE :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    
        // Vérifie le nombre de résultats retournés
        if ($stmt->rowCount() > 0) {
            // User existe
            return true;
        } else {
            // User n'existe pas
            return false;
        }
    }

    public function checkIfUserDisabled($username){

        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username LIKE :username OR email LIKE :email");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $username);

        $stmt->execute();

        $result =  $stmt->fetchAll();
        return $result[0]->disabled?true:false;
    }

    public function getUser($username) {
        $pdo = $this->getPDO();

        // Première requête
        $stmt = $pdo->prepare("SELECT users.id, users.banner, users.avatar, users.email, users.password, users.email_verify, users.name, users.username, users.birthdate, users.gender, users.city, users.bio, DATE_FORMAT(users.register_date, '%M' ' ' '%Y') AS 'register_date', users.id_follower, users.id_following, users.disabled from users WHERE username LIKE :username OR email LIKE :email");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $username);
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $stmt->execute();
        $user = $stmt->fetchAll();

        return $user;
    }

    
}