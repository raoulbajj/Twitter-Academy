<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mimirfw.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.3.0/css/all.css">
    <script defer src="./js/likesAjax.js"></script>
    <script defer src="./js/replyAjax.js"></script>
    <script defer src="./js/loader.js"></script>
    <script defer src="./js/retweetAjax.js"></script>
    <script defer src="./js/followsTab.js"></script>
    <script defer src="./js/atAjax.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body class="body-profile flex">

    <div class="loader">
        <div class="spin"></div>
    </div>

    <div class="nav-bar">
        <div class="nav-link">
            <a href="/profile"><i class="fa-duotone fa-user"></i>Profile</a>
            <a href="/home"><i class="fa-duotone fa-house"></i>Home</a>
            <a href="/trends"><i class="fa-duotone fa-arrow-trend-up"></i>Trends</a>
        </div>

        <form action="/logout" method="post">
            <button type="submit" name="logout" value="logout"><i class="fa-duotone fa-right-from-bracket"></i>Logout</button>
        </form>
    </div>

    <div class="container-fluid main">

        <?php
        if (isset($_SESSION["hote"])) {
            //echo "pas normal";
            $getUser = $_SESSION['user'];
            $getHost = $_SESSION["hote"];
            $host = $getHost[0];
        } else {
            $getUser = $_SESSION['user'];
        }

        $user = $getUser[0];

        $user_followers = $_SESSION["user_followers"];
        $user_following = $_SESSION["user_followings"];

        $getUser = $_SESSION['user'];
        $user_followers = $_SESSION["user_followers"];
        $user_following = $_SESSION["user_followings"];
        $user = $getUser[0];

        $likes = $_SESSION["likesTable"];
        $retweets =  $_SESSION["retweetTable"];
        $comments =  $_SESSION["commentTable"];
        ?>

        <div class="row">
            <div class="col-12 content">
                <div class="profile">
                    <div class="banner">
                        <?php if (isset($host)) : ?>
                            <img class="banner-img" src="<?= $host->banner ?>" alt="Les Muskets.Inc">
                        <?php else : ?>
                            <img class="banner-img" src="<?= $user->banner ?>" alt="Les Muskets.Inc">
                        <?php endif ?>
                    </div>
                    <div class="avatar img-circle">
                        <?php if (isset($host)) : ?>
                            <img class="avatar-img" src="<?= $host->avatar ?>" alt="Les Muskets.Inc">
                        <?php else : ?>
                            <img class="avatar-img" src="<?= $user->avatar ?>" alt="Les Muskets.Inc">
                        <?php endif ?>

                    </div>
                    <div class="edit-profile-container">
                        <?php if (isset($host)) : ?>
                            <?php if (in_array($user->id, $user_followers)) : ?>
                                <button id="edit-profile"><i class="fa-duotone fa-user-minus"></i><span class="btn-ajax-follow">Unfollow</span></button>
                            <?php else : ?>
                                <button id="edit-profile"><i class="fa-duotone fa-user-plus"></i><span class="btn-ajax-follow">Follow</span></button>
                            <?php endif ?>
                        <?php else : ?>
                            <form action="/editprofile" method="get">
                                <button type="submit" id="edit-profile"><i class="fa-duotone fa-pen-to-square"></i> Edit Profile</button>
                            </form>
                        <?php endif ?>
                    </div>
                    <div class="account-info">
                        <?php if (isset($host)) : ?>
                            <div class="profile-name"><?= $host->name; ?></div>
                            <div class="username">@<?= $host->username; ?></div>
                            <?php if ($host->bio != NULL) : ?>
                                <div class="bio flex">
                                    <div class='bio-text'><?= $host->bio; ?></div>
                                </div>
                            <?php endif ?>
                            <?php if ($host->gender != NULL) : ?>
                                <div class="gender flex">
                                    <i class="fa-solid fa-venus-mars"></i>
                                    <div class="gender-text"><?= $host->gender; ?></div>
                                </div>
                            <?php endif ?>
                            <?php if ($host->city != NULL) : ?>
                                <div class="city flex">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <div class="city-text"><?= $host->city ?></div>
                                </div>
                            <?php endif ?>
                            <div class="creation-date flex">
                                <i class="fa-duotone fa-calendar-days"></i>
                                <div class="creation-date-text">Joined TwitterAcademy in <?= $host->register_date; ?></div>
                            </div>
                        <?php else : ?>
                            <div class="profile-name"><?= $user->name; ?></div>
                            <div class="username">@<?= $user->username; ?></div>
                            <?php if ($user->bio != NULL) : ?>
                                <div class="bio flex">
                                    <div class='bio-text'><?= $user->bio; ?></div>
                                </div>
                            <?php endif ?>
                            <?php if ($user->gender != NULL) : ?>
                                <div class="gender flex">
                                    <i class="fa-solid fa-venus-mars"></i>
                                    <div class="gender-text"><?= $user->gender; ?></div>
                                </div>
                            <?php endif ?>
                            <?php if ($user->city != NULL) : ?>
                                <div class="city flex">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <div class="city-text"><?= $user->city ?></div>
                                </div>
                            <?php endif ?>
                            <div class="creation-date flex">
                                <i class="fa-duotone fa-calendar-days"></i>
                                <div class="creation-date-text">Joined TwitterAcademy in <?= $user->register_date; ?></div>
                            </div>
                        <?php endif ?>

                        <div class="ff-container flex">
                            <div class="f following following-tab" data-f="following"><span><?= count($user_following) ?></span> Followings</div>
                            <div class="f followers followers-tab" data-f="followers"><span><?= count($user_followers) ?></span> Followers</div>
                        </div>
                    </div>
                </div>

                <?php if ($_SESSION["data"] == "following"): ?>
                    <div class="followers-content hidden">
                <?php else: ?> 
                    <div class="followers-content">
                <?php endif ?>
                    <div class="tweets">
                        <?php if(empty($followers)): ?>
                            <p>You have no followers</p>
                        <?php else: ?>
                            <?php foreach($followers as $follower_user): ?>
                                <div class='tweet_container'>
                                    <div class='info_container follows_container'>
                                        <div class="flex">
                                            <div class='img-circle avatar'>
                                                <img class='tweets-pp' src=<?=$follower_user[0]->avatar; ?> alt='Les Muskets.Inc'>
                                            </div>
                                            <div class="name-username-container">
                                                <p class="tweet-name"><?= $follower_user[0]->name ?></p>
                                                <p class="at">@<?= $follower_user[0]->username ?></p> 
                                                <input class="tweets_id" type="hidden" value=<?= $follower_user[0]->id; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($_SESSION["data"] == "following"): ?>
                    <div class="following-content">
                <?php else: ?> 
                    <div class="following-content hidden">
                <?php endif ?>
                    <div class="tweets">  
                        <?php if(empty($following)): ?>
                            <p>You are not following anyone</p>
                        <?php else: ?>
                            <?php foreach($following as $following_user): ?>
                                <div class='tweet_container'>
                                    <div class='info_container follows_container'>
                                        <div class="flex">
                                            <div class='img-circle avatar'>
                                                <img class='tweets-pp' src=<?=$following_user[0]->avatar; ?> alt='Les Muskets.Inc'>
                                            </div>
                                            <div class="name-username-container">
                                                <p class="tweet-name"><?= $following_user[0]->name ?></p>
                                                <p class="at">@<?= $following_user[0]->username ?></p> 
                                                <input class="tweets_id" type="hidden" value=<?= $following_user[0]->id; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <input id="id_user" type="hidden" value=<?php $id = isset($_SESSION["user"]) ? $user->id : "oui ready to lunch"; echo $id; ?>>
                <?php if (isset($host)) : ?>
                    <input id="id_host" type="hidden" value=<?= $host->id; ?>>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="trends">
        <div class="row">
            <div class="col-12 header">
                <div class="searchbar">
                    <form action="/search" method="get">
                        <input type="text" name="search" id="search" placeholder="Search...">
                        <button type="submit"><i class="fa-duotone fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>