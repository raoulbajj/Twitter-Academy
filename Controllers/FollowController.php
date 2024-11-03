<?php

namespace Controllers;
session_start();

use Models\FollowModel;


class FollowController
{
    
    function updateFollowers(){
        //recuperer l'id du tweet et celui de l'utilisateur
        $id_host = isset($_POST["id_host"])?$_POST["id_host"]:"";
        $id_user = isset($_POST["id_user"])?$_POST["id_user"]:"";
        echo $id_host;
        echo $id_user;


        $followerModel = new FollowModel();

        //updata la liste des followers de l'hote
        $liste_followers = $followerModel->getHostFollowers($id_host);
        #concatener l'id de l'utilisateur a la liste des followers
        #recupere le contenue de la colonne id_follower
        $liste_followers = $liste_followers[0]->id_follower;
        //si la liste des followers est vide
        if($liste_followers == ""){
            //ajouter l'id de l'utilisateur a la liste des followers
            $liste_followers = $id_user;
        }else{
            //convertir la liste des followers en tableau
            $liste_followers = explode(",", $liste_followers);
            //verifier si l'utilisateur est deja dans la liste des followers
            if(in_array($id_user, $liste_followers)){
                //si oui, supprimer l'utilisateur de la liste des followers
                $liste_followers = array_diff($liste_followers, [$id_user]);
                //convertir le tableau en chaine de caractere
                $liste_followers = implode(",", $liste_followers);
            }else{
                //si non, ajouter l'utilisateur dans le tableau des followers
                $liste_followers[] = $id_user;
                //convertir le tableau en chaine de caractere
                $liste_followers = implode(",", $liste_followers);
            }
        }

        $followerModel->updateHostFollowers($id_host, $liste_followers);

        //updata la liste des followings de l'utilisateur
        $liste_following = $followerModel->getUserFollowings($id_user);
        #concatener l'id de l'hote a la liste des followings   
        #recupere le contenue de la colonne id_following
        $liste_following = $liste_following[0]->id_following;
        //si la liste des followings est vide
        if($liste_following == ""){
            //ajouter l'id de l'hote a la liste des followings
            $liste_following = $id_host;
        }else{
            //convertir la liste des followings en tableau
            $liste_following = explode(",", $liste_following);
            //verifier si l'hote est deja dans la liste des followings
            if(in_array($id_host, $liste_following)){
                //si oui, supprimer l'hote de la liste des followings
                $liste_following = array_diff($liste_following, [$id_host]);
                //convertir le tableau en chaine de caractere
                $liste_following = implode(",", $liste_following);
            }else{
                //si non, ajouter l'hote dans l'array
                $liste_following[] = $id_host;
                //convertir le tableau en chaine de caractere
                $liste_following = implode(",", $liste_following);
            }
        }

        $followerModel->updataUserFollowings($id_user, $liste_following);

    }
   
}