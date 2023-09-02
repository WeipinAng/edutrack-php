<?php ob_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800;900&display=swap"
            rel="stylesheet"
        />

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        
        <link rel="stylesheet" href="css/login.css" />

        <title>Login | EduTrack</title>
    </head>
    <body>
        <div class="login-form-box">
            <div class="title-box center">
                <img
                    class="logo"
                    src="about-asset/img/logo.png"
                    alt="EduTrack logo"
                />
                <h1 class="heading-primary">Login to EduTrack</h1>
            </div>
            
            <hr class="divider" />

            <form
                action="login-process.php"
                method="post"
                class="loginform"
                autocomplete="off"
            >
                <div class="forminput">
                    <input
                        type="text"
                        class="username"
                        name="username"
                        placeholder="NRIC"
                        autofocus
                        required
                        minlength="12"
                        maxlength="12"
                    />
                    <i class="fa-solid fa-address-card"></i>
                </div>

                <div class="forminput">
                    <input
                        type="password"
                        class="password"
                        name="password"
                        placeholder="Password"
                        required
                    />
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div class="button">
                    <button class="submit" name="login" type="submit">Login</button>
                    <button class="reset" type="reset">Reset</button>
                </div>
            </form>

            <p class="signup-text">
                Don't have an account? &nbsp;
                <a href="signup.php" class="signup-link"> Sign Up &rarr;</a>
            </p>
        </div>
    </body>
</html>
