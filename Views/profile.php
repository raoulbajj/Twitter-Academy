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
    <script defer src="./js/infinite_scroll.js"></script>
    <script defer src="./js/replyAjax.js"></script>
    <script defer src="./js/loader.js"></script>
    <script defer src="./js/retweetAjax.js"></script>
    <script defer src="./js/tweet_div.js"></script>
    <script defer src="./js/tweetAjax.js"></script>
    <script defer src="./js/followAjax.js"></script>
    <script defer src="./js/atAjax.js"></script>
    <script defer src="./js/followPath.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>

<body class="body-profile flex">

    <div class="loader">
        <div class="spin"></div>
    </div>

    <div class="nav-bar">
        <div class="nav-link">
            <a href="/profile"><i class="fa-duotone fa-user"></i>Profile</a>
            <a href="/home"><i class="fa-duotone fa-house"></i>Home</a>
            <a href="/message"><i class="fa-duotone fa-messages"></i>Message</a>
            <a href="/trends"><i class="fa-duotone fa-arrow-trend-up"></i>Trends</a>
            <a id="tweet-btn"><i class="fa-duotone fa-paper-plane"></i>Tweet</a>
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

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <input type="text" id="editInput" maxlength="140">
                <span id="counter">140 characters left</span>
                <input type="url" id = "url" placeholder="https://example.png"> 
                <button id="import">convert img</button>
                <button id="saveButton"><i class="fa-duotone fa-paper-plane"></i>Tweet</button>
            </div>
        </div>

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
                            <div class="f following" data-f="following"><span><?= count($user_following) ?></span> Followings</div>
                            <div class="f followers" data-f="followers"><span><?= count($user_followers) ?></span> Followers</div>
                        </div>
                    </div>
                </div>
                <div class="tweets">

                    <?php foreach ($tweets as $tweet) : ?>
                        <?php if ($tweet->id_retweet == NULL) : ?>

                            <div class='tweet_container'>
                                <div class='info_container'>
                                    <div class="flex">
                                        <div class='img-circle avatar'>
                                            <?php if (isset($host)) : ?>
                                                <img class='tweets-pp' src=<?= $host->avatar; ?> alt='Les Muskets.Inc'>
                                            <?php else : ?>
                                                <img class='tweets-pp' src=<?= $user->avatar; ?> alt='Les Muskets.Inc'>
                                            <?php endif ?>
                                        </div>
                                        <div class="name-username-container">
                                            <p class="tweet-name"><?= $tweet->FName ?></p>
                                            <p class="at">@<?= $tweet->F ?></p>
                                            <input type="hidden" value=<?= $tweet->ID; ?>>
                                        </div>
                                    </div>
                                    <p class="tweet-date"><?= $tweet->date_send; ?></p>
                                </div>
                                <div class='tweet-content'><?php 
                                    $content = htmlspecialchars($tweet->MSG);
                                    //transforme $content en tableau   
                                    $content = explode(" ", $content);
                                    //pour chaque mot du tableau $content on va vérifier si le mot commence par # et si oui on le remplace avec un lien
                                    foreach ($content as $key => $value) {
                                        if (substr($value, 0, 1) == "#") {
                                            $content[$key] = "<a class='tweet-hashtag' href='search?search=%23" . substr($value, 1) . "'>" . $value . "</a>";
                                        }
                                    }
                                    //pour chaque mot du tableau $content on va vérifier si le mot commence par @ et si oui on le remplace avec un lien
                                    foreach ($content as $key => $value) {
                                        if (substr($value, 0, 1) == "@") {
                                            $content[$key] = "<a class='tweet-at' href='profile?username=" . substr($value, 1) . "'>" . $value . "</a>";
                                        }
                                    }
                                    //pour chaque url du tableau $content on va vérifier si le mot commence par http et si il se termine par .png .jpg .jpeg .gif et si oui on le remplace avec un element img src
                                    foreach ($content as $key => $value) {
                                        if (substr($value, 0, 4) == "http" && (substr($value, -4) == ".png" || substr($value, -4) == ".jpg" || substr($value, -5) == ".jpeg" || substr($value, -4) == ".gif")) {
                                            $content[$key] = "<img class='tweet-img' src='" . $value . "' alt='image'>";
                                        }
                                    }
                                    //on transforme le tableau $content en string
                                    $content = implode(" ", $content);
                                    echo $content;    
                                    ?></div>


                                <div class="icon_container">
                                    <div class="comment-icon">
                                        <svg class="comment-svg" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                            <path d="M1.8,10.5c0-4.4,3.6-8,8-8h4.4c4.5,0,8.1,3.6,8.1,8.1c0,3-1.6,5.7-4.2,7.1L10,22.2v-3.7H9.9C5.4,18.6,1.8,15,1.8,10.5z
                                                M9.8,4.5c-3.3,0-6,2.7-6,6c0,3.4,2.8,6.1,6.1,6h0.4H12v2.3l5.1-2.8c2-1.1,3.2-3.1,3.2-5.4c0-3.4-2.7-6.1-6.1-6.1
                                                C14.1,4.5,9.8,4.5,9.8,4.5z" />
                                        </svg>
                                        <span><?= isset($comments[$tweet->Numero]) ? count($comments[$tweet->Numero]) : 0; ?></span>
                                    </div>
                                    <div class="retweet-icon">
                                        <svg class="retweet-svg" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                            <path d="M4.5,4l4.4,4.1L7.6,9.6L5.5,7.7v8.5c0,1.1,0.9,2,2,2H13v2H7.5c-2.2,0-4-1.8-4-4V7.7L1.4,9.6L0.1,8.2L4.5,4z M16.5,6.2H11v-2
                                                h5.5c2.2,0,4,1.8,4,4v8.5l2.1-1.9l1.4,1.5l-4.4,4.1l-4.4-4.1l1.4-1.5l2.1,1.9V8.2C18.5,7.1,17.6,6.2,16.5,6.2z" />
                                        </svg>
                                        <span><?= isset($retweets[$tweet->Numero]) ? count($retweets[$tweet->Numero]) : 0; ?></span>
                                    </div>
                                    <div class="like-icon">
                                        <?php if (array_key_exists($tweet->Numero, $likes) && in_array($user->id, $likes[$tweet->Numero])) : ?>
                                            <svg class="heart-svg heart-yes-svg" data-liked="yes" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                                <path d="M21.4,6.5c-0.9-1.8-2.6-2.9-4.6-3c-1.7-0.1-3.4,0.6-4.8,2c-1.4-1.4-3.1-2.1-4.8-2c-2,0.1-3.7,1.2-4.6,3
                                                    c-0.9,1.8-0.9,4.2,0.5,6.7c1.4,2.5,4,5.2,8.4,7.7l0.5,0.3l0.5-0.3c4.4-2.6,7-5.2,8.4-7.7C22.2,10.7,22.3,8.3,21.4,6.5z" />
                                            </svg>
                                            <span><?= $tweet->likes; ?></span>
                                        <?php else : ?>
                                            <svg class="heart-svg heart-no-svg" data-liked="no" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                                <path d="M16.7,5.5C15.5,5.4,14,6,12.8,7.7L12,8.8l-0.8-1.1C10,6,8.5,5.4,7.3,5.5S5,6.3,4.4,7.4s-0.6,2.8,0.5,4.8s3.3,4.3,7.1,6.6
                                                    c3.9-2.3,6.1-4.6,7.1-6.6c1.1-2,1-3.7,0.5-4.8C19,6.3,17.9,5.6,16.7,5.5z M20.9,13.2c-1.4,2.5-4,5.1-8.4,7.7L12,21.2l-0.5-0.3
                                                    c-4.4-2.5-7-5.2-8.4-7.7S1.7,8.3,2.6,6.5s2.6-2.9,4.6-3c1.7-0.1,3.4,0.6,4.8,2c1.4-1.4,3.1-2.1,4.8-2c2,0.1,3.7,1.2,4.6,3
                                                    C22.3,8.3,22.2,10.7,20.9,13.2z" />
                                            </svg>
                                            <span><?= $tweet->likes; ?></span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <input class="tweets_id" type="hidden" value=<?= $tweet->Numero; ?>>
                            </div>
                        <?php else : ?>
                            <div class='tweet_container'>
                                <div class="user-retweet">
                                    <svg class="retweet-icon" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                        <path d="M4.5,4l4.4,4.1L7.6,9.6L5.5,7.7v8.5c0,1.1,0.9,2,2,2H13v2H7.5c-2.2,0-4-1.8-4-4V7.7L1.4,9.6L0.1,8.2L4.5,4z M16.5,6.2H11v-2
                                        h5.5c2.2,0,4,1.8,4,4v8.5l2.1-1.9l1.4,1.5l-4.4,4.1l-4.4-4.1l1.4-1.5l2.1,1.9V8.2C18.5,7.1,17.6,6.2,16.5,6.2z" />
                                    </svg>
                                    <p class="to-retweet"><?= $tweet->FName; ?> to retweet </p>
                                </div>
                                <div class='info_container'>
                                    <div class="flex">
                                        <div class='img-circle avatar'>
                                            <img class='tweets-pp' src=<?= $tweet->UAvatar; ?> alt='Les Muskets.Inc'>
                                        </div>
                                        <div class="name-username-container">
                                            <p class="tweet-name"><?= $tweet->UName ?></p>
                                            <p class="at">@<?= $tweet->U ?></p>
                                            <input type="hidden" value=<?= $tweet->id_user; ?>>
                                        </div>
                                    </div>
                                    <p class="tweet-date"><?= $tweet->dateTweet; ?></p>
                                </div>
                                <div class='tweet-content'>
                                <?php 
                                    $content = htmlspecialchars($tweet->message);
                                    //transforme $content en tableau   
                                    $content = explode(" ", $content);
                                    //pour chaque mot du tableau $content on va vérifier si le mot commence par # et si oui on le remplace avec un lien
                                    foreach ($content as $key => $value) {
                                        if (substr($value, 0, 1) == "#") {
                                            $content[$key] = "<a class='tweet-hashtag' href='search?search=%23" . substr($value, 1) . "'>" . $value . "</a>";
                                        }
                                    }
                                    //pour chaque mot du tableau $content on va vérifier si le mot commence par @ et si oui on le remplace avec un lien
                                    foreach ($content as $key => $value) {
                                        if (substr($value, 0, 1) == "@") {
                                            $content[$key] = "<a class='tweet-at' href='profile?username=" . substr($value, 1) . "'>" . $value . "</a>";
                                        }
                                    }
                                    foreach ($content as $key => $value) {
                                        if (substr($value, 0, 4) == "http" && (substr($value, -4) == ".png" || substr($value, -4) == ".jpg" || substr($value, -5) == ".jpeg" || substr($value, -4) == ".gif")) {
                                            $content[$key] = "<img class='tweet-img' src='" . $value . "' alt='image'>";
                                        }
                                    }
                                    //on transforme le tableau $content en string
                                    $content = implode(" ", $content);
                                    echo $content;    
                                    ?>
                               </div>
                                <div class="icon_container">
                                    <div class="comment-icon">
                                        <svg class="comment-svg" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                            <path d="M1.8,10.5c0-4.4,3.6-8,8-8h4.4c4.5,0,8.1,3.6,8.1,8.1c0,3-1.6,5.7-4.2,7.1L10,22.2v-3.7H9.9C5.4,18.6,1.8,15,1.8,10.5z
                                                M9.8,4.5c-3.3,0-6,2.7-6,6c0,3.4,2.8,6.1,6.1,6h0.4H12v2.3l5.1-2.8c2-1.1,3.2-3.1,3.2-5.4c0-3.4-2.7-6.1-6.1-6.1
                                                C14.1,4.5,9.8,4.5,9.8,4.5z" />
                                        </svg>
                                        <span><?= isset($comments[$tweet->Numero]) ? count($comments[$tweet->Numero]) : 0; ?></span>
                                    </div>
                                    <div class="like-icon">
                                        <?php if (array_key_exists($tweet->Numero, $likes) && in_array($user->id, $likes[$tweet->Numero])) : ?>
                                            <svg class="heart-svg heart-yes-svg" data-liked="yes" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                                <path d="M21.4,6.5c-0.9-1.8-2.6-2.9-4.6-3c-1.7-0.1-3.4,0.6-4.8,2c-1.4-1.4-3.1-2.1-4.8-2c-2,0.1-3.7,1.2-4.6,3
                                                    c-0.9,1.8-0.9,4.2,0.5,6.7c1.4,2.5,4,5.2,8.4,7.7l0.5,0.3l0.5-0.3c4.4-2.6,7-5.2,8.4-7.7C22.2,10.7,22.3,8.3,21.4,6.5z" />
                                            </svg>
                                            <span><?= $tweet->likes; ?></span>
                                        <?php else : ?>
                                            <svg class="heart-svg heart-no-svg" data-liked="no" version="1.1" id="groupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                                <path d="M16.7,5.5C15.5,5.4,14,6,12.8,7.7L12,8.8l-0.8-1.1C10,6,8.5,5.4,7.3,5.5S5,6.3,4.4,7.4s-0.6,2.8,0.5,4.8s3.3,4.3,7.1,6.6
                                                    c3.9-2.3,6.1-4.6,7.1-6.6c1.1-2,1-3.7,0.5-4.8C19,6.3,17.9,5.6,16.7,5.5z M20.9,13.2c-1.4,2.5-4,5.1-8.4,7.7L12,21.2l-0.5-0.3
                                                    c-4.4-2.5-7-5.2-8.4-7.7S1.7,8.3,2.6,6.5s2.6-2.9,4.6-3c1.7-0.1,3.4,0.6,4.8,2c1.4-1.4,3.1-2.1,4.8-2c2,0.1,3.7,1.2,4.6,3
                                                    C22.3,8.3,22.2,10.7,20.9,13.2z" />
                                            </svg>
                                            <span><?= $tweet->likes; ?></span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <input class="tweets_id" type="hidden" value=<?= $tweet->Numero; ?>>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>

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
        <div class="trends-container">
            <div class="trends-content-container">
                <div class="flex trends-title">
                    <i class="fa-duotone fa-chart-simple"></i>
                    <h1>Trends</h1>
                </div>

                <?php foreach ($hashtags_count as $hashtag => $count) : ?>
                    <div class="trend">
                        <div class="trend-title">
                            <a href="/search?search=%23<?= $hashtag; ?>"><?= '#' . $hashtag; ?></a>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>

</html>