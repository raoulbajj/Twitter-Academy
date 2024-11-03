<?php

namespace Controllers;
session_start();
use src\Render;
use Models\MainModel;
use Models\HashtagModel;


class MainController
{
    
    public function getTweets(): Render
    {
        $mainModel = new MainModel();

        //get likes
        $best_likes = [];

        $likes = $mainModel->getLikesTable();
        foreach($likes as $like){
            //  var_dump($like);
                $best_likes["$like->id_tweet"][] = $like->id_user;
        }

        $_SESSION["likesTable"] = $best_likes;

        //get retweets ---->ionut

        $best_retweets = [];

        $retweets = $mainModel->getRetweetTable();
        foreach($retweets as $retweet){
            //  var_dump($like);
                $best_retweet["$retweet->id_retweet"][] = $retweet->id_user;
        }
        $_SESSION["retweetTable"] = $best_retweet;

        //get comments ---> ionut
        $best_comments = [];
        $comments = $mainModel->getCommentTable();
        foreach($comments as $comment){
            //  var_dump($like);
                $best_comments["$comment->id_reply_tweet"][] = $comment->id_user;
        }
        $_SESSION["commentTable"] = $best_comments;


        $user = $_SESSION["user"];

        $tweets = $mainModel->getTweets();



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
                // // Convertir le hashtag en minuscules pour éviter la duplication (insensible à la casse)
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

        return Render::make('home', compact('tweets', 'hashtags_count'));
    }
}