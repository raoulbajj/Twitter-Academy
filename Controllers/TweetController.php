<?php

namespace Controllers;
session_start();
use src\Render;
use Models\Model;
use Models\TweetModel; 

class TweetController
{
    public function postTweets()
    {
        $user_id = $_SESSION["user"][0]->id;
        $message = isset($_POST["message"]) ? htmlspecialchars($_POST["message"]) : "";
        $tweetModel = new TweetModel();
        $tweetModel->postTweets($user_id, $message);
    }
}
