<?php

namespace Models;


class EditProfileModel extends Model {
    
    public function updateUser(string $editName, string $editUsername, string $editMail, string $editPassword, string $editBirthdate, string $editBio, string $editGender, string $editCity, int $userid) {

        $pdo = $this->getPDO();

        $stmt = $pdo->prepare("UPDATE users SET email = :email, password = :password, name = :name, username = :username, birthdate = :birthdate, gender = :gender, city = :city, bio = :bio WHERE id = :user_id");
        $stmt->bindParam(":user_id", $userid);
        $stmt->bindParam(":email", $editMail);
        $stmt->bindParam(":password", $editPassword);
        $stmt->bindParam(":name", $editName);
        $stmt->bindParam(":username", $editUsername);
        $stmt->bindParam(":birthdate", $editBirthdate);
        $stmt->bindParam(":gender", $editGender);
        $stmt->bindParam(":city", $editCity);
        $stmt->bindParam(":bio", $editBio);
        $stmt->execute();
    }

    public function updateUserAvatar(string $editAvatar, int $userid) {

        $pdo = $this->getPDO();

        $stmt = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :user_id");
        $stmt->bindParam(":user_id", $userid);
        $stmt->bindParam(":avatar", $editAvatar);
        $stmt->execute();
    }
    public function updateUserBanner(string $editBanner, int $userid) {

        $pdo = $this->getPDO();

        $stmt = $pdo->prepare("UPDATE users SET banner = :banner WHERE id = :user_id");
        $stmt->bindParam(":user_id", $userid);
        $stmt->bindParam(":banner", $editBanner);
        $stmt->execute();
    }

    public function checkIfEmailSame($userid, $editMail) {

        $pdo = $this->getPDO();
    
        // Première requête
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email LIKE :email AND id = :id");
        $stmt->bindParam(":email", $editMail);
        $stmt->bindParam(":id", $userid);
        $stmt->execute();
    
        // Vérifie le nombre de résultats retournés
        if ($stmt->rowCount() > 0) {
            // Adresse email existe déjà pour cet ID
            return true;
        } else {
            // Adresse email n'existe pas ou n'est pas associée à cet ID
            return false;
        }
    }

    public function checkIfEmailExist($editMail) {

        $pdo = $this->getPDO();

        // Première requête
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email LIKE :email");
        $stmt->bindParam(":email", $editMail);
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

    public function getUser($userid) {
        $pdo = $this->getPDO();

        // Première requête
        $stmt = $pdo->prepare("SELECT users.id, users.banner, users.avatar, users.email, users.password, users.email_verify, users.name, users.username, users.birthdate, users.gender, users.city, users.bio, DATE_FORMAT(users.register_date, '%M' ' ' '%Y') AS 'register_date', users.id_follower, users.id_following, users.disabled from users WHERE users.id LIKE :userid");
        $stmt->bindParam(":userid", $userid);
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $stmt->execute();
        $user = $stmt->fetchAll();

        return $user;
    }
}