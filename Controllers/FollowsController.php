<?php

namespace Controllers;
session_start();
use src\Render;
use Models\Model;
use Models\FollowersModel;
use Models\FollowingModel;

class FollowsController
{
    public function getFollows() :Render
    {
        
       if(isset($_SESSION["hote"])) {
            $user = $_SESSION["hote"];
            
        } else {
            $user = $_SESSION["user"];
            
        }
        $data = isset($_GET['data']) ? $_GET['data'] : "";
        if ($data != "") {

            if ($user[0]->id_follower != null || $user[0]->id_follower != "") {
                $users_id_followers = $user[0]->id_follower;
                $arrayFollowers = explode(',', $users_id_followers); // Convert string to array

                $followersModel = new FollowersModel();
                $followers = $followersModel->getUserFollowers($arrayFollowers);
            }
            else {
                $followers = [];
            }

            if ($user[0]->id_following != null || $user[0]->id_following != "") {
                $users_id_following = $user[0]->id_following;
                $arrayFollowing = explode(',', $users_id_following); // Convert string to array

                $followingModel = new FollowingModel();
                $following = $followingModel->getUserFollowing($arrayFollowing);
            }
            else {
                $following = [];
            }

            $_SESSION["data"] = $data;
        }

        return Render::make("follows", compact('followers', 'following'));
    }
}