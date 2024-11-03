<?php

use src\App;
use Router\Router;

require '../vendor/autoload.php';

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);

$router = new Router();

$router->get('/', ['Controllers\HomeController', 'index']);
$router->post('/validate', ["Controllers\RegisterController", 'validate']);
$router->post("/login",["Controllers\LoginController","connect"]);
$router->get("/profile",["Controllers\ProfilController","getUserPersonalInfoAndTwitter"]);
$router->get("/home",["Controllers\MainController","getTweets"]);
$router->get("/trends",["Controllers\TrendsController","getTrends"]);
$router->post("/likes",["Controllers\LikesController","updateLikes"]);
$router->post("/tweets",["Controllers\TweetController","postTweets"]);
$router->post("/logout",["Controllers\LogoutController","logout"]);
$router->post("/reply",["Controllers\ReplyController","displayComments"]);
$router->post("/retweet",["Controllers\RetweetController","retweet"]);
$router->get("/follows",["Controllers\FollowsController","getFollows"]);
$router->post("/toProfile",["Controllers\ProfilController","getUserPersonalInfoAndTwitter"]);
$router->post("/follow",["Controllers\FollowController","updateFollowers"]);
$router->get("/search",["Controllers\SearchController","getSearch"]);
$router->get("/editprofile",["Controllers\EditProfileController","editProfile"]);
$router->post("/editprofile",["Controllers\EditProfileController","editProfileValidate"]);

# $router->get / post('/action du formulaire', ['Controllers\FeatureController', 'nom de la fonction (methode de la classe du controller)']);

(new App($router, [
    'uri' => $_SERVER['REQUEST_URI'], 
    'method' => $_SERVER['REQUEST_METHOD']
    ]
))->run();