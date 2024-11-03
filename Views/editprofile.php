<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mimirfw.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.3.0/css/all.css">
    <script defer src="./js/loader.js"></script>
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
        </div>

        <form action="/logout" method="post">
            <button type="submit" name="logout" value="logout"><i class="fa-duotone fa-right-from-bracket"></i>Logout</button>
        </form>
    </div>

    <div class="container-fluid main">

        <?php
            $getUser = $_SESSION['user'];

            $user = $getUser[0];
            $password = $_SESSION["password"];

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
            <div class="col-12 content edit-profile-page-container">
                <div class="profile edit-profile-page">

                    <div class="banner">
                        <img class="banner-img" src="<?= $user->banner; ?>" alt="Les Muskets.Inc">
                    </div>

                    <div class="avatar img-circle">
                        <img class="avatar-img" src="<?= $user->avatar; ?>" alt="Les Muskets.Inc">
                    </div>

                    <div class="account-info">
                        <form class="edit-profile-form" action="editprofile" method="post">

                            <div class="banner-container-edit flex">
                                <i class="fa-duotone fa-image-landscape"></i>
                                <input type="text" name="edit_banner" placeholder="Banner URL">
                            </div>

                            <div class="avatar-container-edit flex">
                                <i class="fa-duotone fa-image-polaroid-user"></i>
                                <input type="text" name="edit_avatar" placeholder="Avatar URL">
                            </div>
                            
                            <div class="profile-name-username">
                                <input class="profile-name" type="text" name="edit_name" placeholder="Name" value="<?= $user->name; ?>">
                                <input class="username" type="text" name="edit_username" placeholder="@Username" value="<?= $user->username; ?>">
                            </div>
                            
                            <div class="email flex">
                                <i class="fa-duotone fa-envelope"></i>
                                <input class="email-text" type="text" name="edit_mail" placeholder="Email" value="<?= $user->email; ?>">
                            </div>

                            <div class="password flex">
                                <i class="fa-duotone fa-lock"></i>
                                <input class="password-text" type="text" name="edit_password" placeholder="Password" value="<?= $password ?>">
                            </div>

                            <div class="birthdate flex">
                                <i class="fa-duotone fa-cake-candles"></i>
                                <input class="birthdate-text" type="date" name="edit_birthdate" value="<?= $user->birthdate; ?>">
                            </div>

                            <div class="bio flex">
                                <textarea class="bio-text" name="edit_bio" cols="30" rows="10" placeholder="Bio"><?= $user->bio; ?></textarea>
                            </div>

                            <div class="gender flex">
                                <i class="fa-solid fa-venus-mars"></i>
                                <input class="gender-text" type="text" name="edit_gender" placeholder="Gender" value="<?= $user->gender; ?>">
                            </div>

                            <div class="city flex">
                                <i class="fa-solid fa-location-dot"></i>
                                <div class="city-text"></div>
                                <input class="city-text" type="text" name="edit_city" placeholder="City" value="<?= $user->city; ?>">
                            </div>
                            <button type="submit">Save Changes</button>
                        </form>
                        
                    </div>
                </div>
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