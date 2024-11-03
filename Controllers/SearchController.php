<?php
//  Need to get the # of tweets in the database and display them in the Search section.
namespace Controllers;
session_start();
use src\Render;
use Models\SearchModel;
use Models\HashtagModel;

class SearchController
{
    public function getSearch(): Render
    {
        $SearchModel = new SearchModel();

        //get likes
        $best_likes = [];

        $likes = $SearchModel->getLikesTable();
        foreach($likes as $like){
            $best_likes["$like->id_tweet"][] = $like->id_user;
        }
        
        $_SESSION["likesTable"] = $best_likes;

        $best_retweets = [];

        $retweets = $SearchModel->getRetweetTable();
        foreach($retweets as $retweet){
            $best_retweet["$retweet->id_retweet"][] = $retweet->id_user;
        }
        $_SESSION["retweetTable"] = $best_retweet;

        //get comments ---> ionut
        $best_comments = [];
        $comments = $SearchModel->getCommentTable();
        foreach($comments as $comment){
            $best_comments["$comment->id_reply_tweet"][] = $comment->id_user;
        }
        $_SESSION["commentTable"] = $best_comments;

        $user = $_SESSION["user"];
        $hashtag = isset($_GET["search"]) ? $_GET["search"] : "";
        $search = $SearchModel->getHashtagTweets($hashtag);


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
        
        return Render::make('search', compact('search'  , 'hashtags_count'));
    }
}