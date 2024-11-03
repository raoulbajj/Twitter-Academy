<?php

namespace Models;

// use DateTime;


class RegisterModel extends Model {

    public function InsertUser($name, $email, $password, $birthdate, $avatar, $banner, $username) {
        
        $pdo = $this->getPDO();

        try {
            $pdo->beginTransaction();
            // Première requête
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, birthdate,avatar,banner,username) VALUES (:name, :email, :password, :birthdate, :avatar , :banner, :username)");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":birthdate", $birthdate);
            $stmt->bindParam(":avatar", $avatar);
            $stmt->bindParam(":banner", $banner);
            $stmt->bindParam(":username", $username);

            $stmt->execute();   

            $pdo->commit();
        
        } catch (\PDOException $e) {
            $pdo->rollBack();
            echo "Transaction failed: " . $e->getMessage();
        }
        
    }

    public function checkIfEmailExist($email) {

        $pdo = $this->getPDO();

        // Première requête
        $stmt = $pdo->prepare("SELECT email FROM users WHERE email LIKE :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // Vérifie le nombre de résultats retournés
        if ($stmt->rowCount() > 0) {
            // Adresse email existe déjà
            return true;
        } else {
            // Adresse email n'existe pas
            return false;
        }
    }

}


