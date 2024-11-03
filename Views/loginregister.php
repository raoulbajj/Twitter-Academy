<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.3.0/css/all.css">
    <script defer src="./js/script_login_twitter.js"></script>
    <script defer src="./js/loader.js" ></script>
    <title>Twitter Academy</title>
</head>

<body class="body-login-register">
    <div class="loader">
        <div class="spin"></div>
    </div>
    <div class="form-container">
        <div class="colonne">

            <!-- FORM D'INSCRIPTION -->
            <form class="sign_up" action="/validate" method="POST">

                <div class="flex_block">
                    <label for="name" id="label_name">Name</label>
                    <div class="flex-input">
                        <i class="fa-duotone fa-signature"></i>
                        <input type="text" id="name" name="name" placeholder="Name" required>
                    </div>
                </div>

                <div class="flex_block">
                    <label for="password" id="label_password">Password</label>
                    <div class="flex-input">
                        <i class="fa-duotone fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="●●●●●●●●●●" required>
                    </div>
                </div>

                <div class="flex_block">
                    <label for="email" id="label_email">E-mail</label>
                    <div class="flex-input">
                        <i class="fa-duotone fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="mail@example.com" required>
                    </div>
                </div>

                <div class="flex_block">
                    <label for="birthdate" id="label_birthdate">Birthdate</label>
                    <div class="flex-input">
                        <i class="fa-duotone fa-cake-candles"></i>
                        <input type="date" id="birthdate" name="birthdate" required>
                    </div>
                </div>

                <div class="flex_block purple-btn">
                    <button type="submit">REGISTER</button>
                </div>


            </form>



            <!-- FORM DE CONNEXION -->
            <form class="max_height sign_in" action="/login" method="POST">

                <div class="flex_block">
                    <label for="username" id="label_username">Username / E-mail</label>
                    <div class="flex-input">
                        <i class="fa-duotone fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Username / E-mail" required>
                    </div>
                </div>

                <div class="flex_block">
                    <label for="password_1" id="label_password_1">Password</label>
                    <div class="flex-input">
                        <i class="fa-duotone fa-lock"></i>
                        <input type="password" id="password_1" name="password_1" placeholder="●●●●●●●●●●" required>
                    </div>
                </div>

                <div class="flex_block purple-btn">
                    <button type="submit">LOGIN</button>
                </div>

            </form>
            <div class="onglets-container-sign-in">
                <p>Already have an account?</p>
                <p class="sign_in_button">Login now</p>
            </div>
            <div class="onglets-container-sign-up">
                <p>Don't have an account?</p>
                <p class="sign_up_button">Signup now</p>
            </div>

            <div class='message-container email-already-use'>
                <div class='message error'>
                    <i class='fa-solid fa-circle-exclamation'></i>
                    <span>This Email is already used.</span>
                </div>
            </div>

            <div class='message-container account-created'>
                <div class='message success'>
                    <i class='fa-solid fa-circle-check'></i>
                    <span>You have successfully create a new account.</span>
                </div>
            </div>

            <div class='message-container account-disabled'>
                <div class='message error'>
                    <i class='fa-solid fa-circle-exclamation'></i>
                    <span>This account is disabled.</span>
                </div>
            </div>

            <div class='message-container account-login-error'>
                <div class='message error'>
                    <i class='fa-solid fa-circle-exclamation'></i>
                    <span>This account does not exist.</span>
                </div>
            </div>

            <script src="./js/error_message.js"></script>

            <?php
            if (isset($_SESSION['email_exist']) && $_SESSION['email_exist'] == true) {
                echo "<script>loadRegister();</script>";
                echo "<script>emailAlreadyUse();</script>";
                session_destroy();
            }
            if (isset($_SESSION['validate_success']) && $_SESSION['validate_success'] == true) {
                echo "<script>loadRegister();</script>";
                echo "<script>accountCreated();</script>";
                session_destroy();
            }
            if (isset($_SESSION['disabled_error']) && $_SESSION['disabled_error'] == true) {
                echo "<script>accountDisabled();</script>";
                session_destroy();
            }
            if (isset($_SESSION['login_error']) && $_SESSION['login_error'] == true) {
                echo "<script>accountLoginError();</script>";
                session_destroy();
            }
            ?>


        </div>
    </div>

</body>

</html>