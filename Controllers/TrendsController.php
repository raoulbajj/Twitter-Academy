<?php
//  Need to get the # of tweets in the database and display them in the trends section.
namespace Controllers;
session_start();
use src\Render;
use Models\TrendsModel;
use Models\HashtagModel;

class TrendsController
{
    public function getTrends(): Render
    {
        $trendsModel = new TrendsModel();

        //get likes
        $best_likes = [];

        $likes = $trendsModel->getLikesTable();
        foreach($likes as $like){
            $best_likes["$like->id_tweet"][] = $like->id_user;
        }
        
        $_SESSION["likesTable"] = $best_likes;

        //get retweets ---->ionut

        $best_retweets = [];

        $retweets = $trendsModel->getRetweetTable();
        foreach($retweets as $retweet){
            $best_retweet["$retweet->id_retweet"][] = $retweet->id_user;
        }
        $_SESSION["retweetTable"] = $best_retweet;

        //get comments ---> ionut
        $best_comments = [];
        $comments = $trendsModel->getCommentTable();
        foreach($comments as $comment){
            $best_comments["$comment->id_reply_tweet"][] = $comment->id_user;
        }
        $_SESSION["commentTable"] = $best_comments;

        $user = $_SESSION["user"];
        $trends = $trendsModel->getTrends();


        $hashtagModel = new HashtagModel();

        $tweets_for_hashtags = $hashtagModel->getTweets();

        // Créer un tableau associatif pour stocker les hashtags et leurs occurrences
        $hashtags_count = [];
        $matches = [];

        // Parcourir les tweets
        foreach ($tweets_for_hashtags as $tweet) {
            // Trouver tous les hashtags dans le tweet
            preg_match_all('/#(\w+)/', $tweet->MSG, $matches);

            // Parcourir les hashtags trouvés
            foreach ($matches[1] as $hashtag) {
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

        return Render::make('trends', compact('trends', 'hashtags_count'));
    }
}