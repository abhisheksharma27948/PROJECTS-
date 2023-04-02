<?php

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
    include 'Connection/connect_LoginIn.php';
    // create SQL insert statement
    $sql = "SELECT * FROM user_login WHERE email = :email";

    // create prepare statement template
    $res = $pdo->prepare($sql);

    // bind parameter to statement
    $res->bindParam(':email', $_REQUEST['email']);

    // execute prepare statement
    $res->execute();

    if($res->rowCount() > 0) {
        // user already exists
        die("User already exists");
    } else {
        // validate form data
        if ($_POST['password'] != $_POST['repeat_password']) {
            die("Password fields do not match!");
        }
        
        // create SQL insert statement
        $sql = "INSERT INTO user_login (email,username, password) VALUES (:email, :username,:password)";
    
        // create prepare statement template
        $res = $pdo->prepare($sql);
    
        // bind parameter to statement
        $res->bindParam(':email', $_REQUEST['email']);
        $res->bindParam(':username', $_REQUEST['username']);
        $res->bindParam(':password', $_REQUEST['password']);

        // execute prepare statement
        if ($res->execute()) {
            header("location: login.php?msg=Signup Successfuly");
            exit();
        } else {
            echo "Error: " . $res->errorCode();
        }
    }
    // close connection
    unset($pdo);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/reg_css.css">
    <title>Register</title>
</head>

<body>

    <div class="login">
        <img src="Images/01.jpg" alt="login_image" class="login__img">
        <form action="register.php" class="login__form" method="POST">
            <h1 class="login__title">Sign up</h1>
            <div class="login__content">
                
                <div class="login__box">
                    <i class="ri-mail-line"></i>
                    <div class="login__box-input">
                        <input type="email" required class="login__input" placeholder=" " name = "email">
                        <label for="" class=" login__label">Email</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-user-3-line log "></i>
                    <div class="login__box-input">
                        <input type="username" required class="login__input" placeholder=" " name = "username">
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

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>
                    <div class="login__box-input">
                        <input type="password" required class="login__input" id="login-rep_pass" placeholder=" " name="repeat_password">
                        <label for="" class="login__label">Repeat Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-rep_eye"></i>
                    </div>
                </div>

            </div>

            <button type="submit" id="signupbtn" class="login__button" name = "signupbtn">Sign Up
            </button>

        </form>
    </div>
    <script src="Script/main.js"></script>
</body>

</html>