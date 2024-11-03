<?php

namespace Controllers;

session_start();

use src\Render;
use Models\Model;
use Models\ProfilModel;
use Models\HashtagModel;


class ProfilController
{
    public function getUserPersonalInfoAndTwitter()
    {

        //fix a certain bug 
        unset($_SESSION['hote']);

        $profilModel = new ProfilModel();

        //get likes
        $best_likes = [];

        $likes = $profilModel->getLikesTable();
        foreach ($likes as $like) {
            //  var_dump($like);
            $best_likes["$like->id_tweet"][] = $like->id_user;
        }

        // print_r($best_likes);

        $_SESSION["likesTable"] = $best_likes;

        //get retweets ---->ionut

        $best_retweets = [];

        $retweets = $profilModel->getRetweetTable();
        foreach ($retweets as $retweet) {
            //  var_dump($like);
            $best_retweet["$retweet->id_retweet"][] = $retweet->id_user;
        }
        $_SESSION["retweetTable"] = $best_retweet;

        //get comments ---> ionut
        $best_comments = [];
        $comments = $profilModel->getCommentTable();
        foreach ($comments as $comment) {
            //  var_dump($like);
            $best_comments["$comment->id_reply_tweet"][] = $comment->id_user;
        }
        $_SESSION["commentTable"] = $best_comments;
        
        $user = $_SESSION["user"];

        if (!isset($_SESSION["user"])) {
            header("Location: /");
        }
        else {
            if(isset($_GET["id_user"]) && $_GET["id_user"] != $user[0]->id){
                $id= $_GET["id_user"];
               
                // user to whom you want to see the profile
                $user_profile =  $profilModel->getUser($id);
                $_SESSION["hote"] = $user_profile;
                $tweets = $profilModel->getUserTweets($user_profile[0]->id);
               
                $user_followers = $user_profile[0]->id_follower;
                $user_followings = $user_profile[0]->id_following;
               
            } else if(isset($_GET["username"])){
                $username = $_GET["username"];
                var_dump($username);
                $host = $profilModel->getUserByUsername($username);
                var_dump($host);
                if($host[0]->username == $user[0]->username){
                    header("Location: /profile");
                } else {
                    $_SESSION["hote"] = $host;
                    $tweets = $profilModel->getUserTweets($host[0]->id);
                    $user_followers = $host[0]->id_follower;
                    $user_followings = $host[0]->id_following;
                }
               
            }else{
                $user_followers = $user[0]->id_follower;
                $user_followings = $user[0]->id_following;
                $tweets = $profilModel->getUserTweets($user[0]->id);
            }


            // get followers
           
            if($user_followers == null ){
                $user_followers = [];
            } else {
                $array = explode(",",$user_followers);
                $user_followers = $array;
            }
            // get followings
           
            if($user_followings == null){
                $user_followings = [];
            } else {
                $array = explode(",",$user_followings);
                $user_followings = $array;
            }

            
            
            
            $_SESSION["user_followers"] = $user_followers;
            $_SESSION["user_followings"] = $user_followings;

            $hashtagModel = new HashtagModel();

            $tweets_for_hashtags = $hashtagModel->getTweets();

            // Créer un tableau associatif pour stocker les hashtags et leurs occurrences
            $hashtags_count = [];
            $matches = [];

            // Parcourir les tweets
            foreach ($tweets_for_hashtags as $tweet) {
                // var_dump($tweet);
                // Trouver tous les hashtags dans le tweet
                preg_match_all('/#(\w+)/', $tweet->MSG, $matches);

                // Parcourir les hashtags trouvés
                foreach ($matches[1] as $hashtag) {
                    // Convertir le hashtag en minuscules pour éviter la duplication (insensible à la casse)
                    // $hashtag = strtolower($hashtag);

                    // Vérifier si le hashtag existe déjà dans le tableau associatif
                    if (isset($hashtags_count[$hashtag])) {
                        // Si oui, incrémenter le compteur
                        $hashtags_count[$hashtag]++;
                    } else {
                        // Sinon, initialiser le compteur à 1
                        $hashtags_count[$hashtag] = 1;
                    }
                }
            }

            // Trier les hashtags par occurrences décroissantes
            arsort($hashtags_count);

            return Render::make('profile', compact("tweets", "hashtags_count"));
        }
    }
}
