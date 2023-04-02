<?php

    $login = 0;
    $invalid = 0;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        require_once 'Connection/connect_LoginIn.php';
        // require_once "C:\xampp\htdocs\Login Form\Connection\connect_LoginUp.php"
        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember_me = isset($_POST["remember_me"]) ? 1 : 0;

        $sql = "SELECT * FROM `user_login` WHERE username = :username AND password = :password";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $login = 1;
            session_start();
            $_SESSION['username'] = $username;
            if ($remember_me) {
                // update remember_me value in database
                $sql = "UPDATE `user_login` SET `remember_me` = 1 WHERE `username` = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
            }
            header('location:index.php');
        } else {
            $invalid = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/login_css.css">
    <title>Login Form</title>
</head>

<body>
    
    <?php

        if($login){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> You are Successfully Logged in.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }

        if($invalid){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> Invalid credentials.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }
    ?>
    <div class="login">
        <img src="images/01.jpg" alt="login_image" class="login__img">
        <form action="login.php" class="login__form" method = "post">
            <h1 class="login__title">Login</h1>
            <div class="login__content">
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="username" required class="login__input" placeholder=" " name="username">
                        <label for="" class=" login__label">User Name</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="password" required class="login__input" id="login-pass" placeholder=" " name="password">
                        <label for="" class="login__label">Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                    </div>
                </div>
            </div>

            <div class="login__check">
                <div class="login__check-group">
                    <input type="checkbox" class="login__check-input" name="remember_me">
                    <label for="" class="login__check-label">Remember me</label>
                </div>
                <a href="forgotPassword.php" class="login__forgot">Forgot Password?</a>
            </div>
            <button class="login__button">Login</button>

            <p class="login__register">
                Don't have an account ?
                <a href="register.php">Register</a>
            </p>
        </form>
    </div>
    <script src="Script/main.js"></script>
</body>

</html>
