<?php

namespace Controllers;
session_start();

use src\Render;
use Models\LoginModel;
use Models\EditProfileModel;


class EditProfileController
{
    
    function editProfile(){
        return Render::make("editprofile");
    }

    function editProfileValidate() {

        //NEW UPDATE
        $update = new EditProfileModel();
        //RECUP DES VARIABLES POST 
        $editBanner = isset($_POST["edit_banner"]) ? $_POST["edit_banner"] : "";
        $editAvatar = isset($_POST["edit_avatar"]) ? $_POST["edit_avatar"] : "";
        $editName = isset($_POST["edit_name"]) ? $_POST["edit_name"] : "";
        $editUsername = isset($_POST["edit_username"]) ? $_POST["edit_username"] : "";
        $editMail = isset($_POST["edit_mail"]) ? $_POST["edit_mail"] : "";
        $editPasswordClear = isset($_POST["edit_password"]) ? $_POST["edit_password"] : "";

        $salt =  "vive le projet tweet_academy";
        $editPassword = isset($_POST['edit_password']) ? hash('ripemd160', $salt . $_POST['edit_password']) : "";

        $editBirthdate = isset($_POST["edit_birthdate"]) ? $_POST["edit_birthdate"] : "";
        $editBio = isset($_POST["edit_bio"]) ? $_POST["edit_bio"] : "";
        $editGender = isset($_POST["edit_gender"]) ? $_POST["edit_gender"] : "";
        $editCity = isset($_POST["edit_city"]) ? $_POST["edit_city"] : "";
        
        //RECUP USER DANS LA SESSION
        $user = $_SESSION['user'];
        //RECUP ID USER DANS LA SESSION
        $userid = $user[0]->id;

        //CHECK
        $_SESSION['validate_error'] = false;
        $_SESSION['validate_success'] = false;
        $checkEmail = $update->checkIfEmailExist($editMail);
        $checkEmailSame = $update->checkIfEmailSame($userid, $editMail);
        

        if($editMail == "" || $editPasswordClear == "" || $editUsername == "" || $editName == "") {
            $_SESSION['validate_error'] = true;
        }
        else if ($checkEmail == true && $checkEmailSame == false) {
            $_SESSION['email_exist'] = true;
        }
        else if ($checkEmailSame == true) {
            $_SESSION['validate_success'] = true;
            //UPDATE USER
            $update->updateUser($editName, $editUsername, $editMail, $editPassword, $editBirthdate, $editBio, $editGender, $editCity, $userid);
            
            //RECUP DU USER DANS LA BDD
            $userUpdated = $update->getUser($userid);
            //MISE A JOUR DE LA SESSION
            $_SESSION['user'] = $userUpdated;
            $_SESSION['password'] = $editPasswordClear;
        }
        else {
            $_SESSION['validate_success'] = true;
            //UPDATE USER
            $update->updateUser($editName, $editUsername, $editMail, $editPassword, $editBirthdate, $editBio, $editGender, $editCity, $userid);
            
            //RECUP DU USER DANS LA BDD
            $userUpdated = $update->getUser($userid);
            //MISE A JOUR DE LA SESSION
            $_SESSION['user'] = $userUpdated;
            $_SESSION['password'] = $editPasswordClear;
        }

        if ($editBanner != "") {
            $update->updateUserBanner($editBanner, $userid);
            //RECUP DU USER DANS LA BDD
            $userUpdated = $update->getUser($userid);
            //MISE A JOUR DE LA SESSION
            $_SESSION['user'] = $userUpdated;
        }
        if ($editAvatar != "") {
            $update->updateUserAvatar($editAvatar, $userid);
            //RECUP DU USER DANS LA BDD
            $userUpdated = $update->getUser($userid);
            //MISE A JOUR DE LA SESSION
            $_SESSION['user'] = $userUpdated;
        }
        
        return Render::make("editprofile");
    }
   
}