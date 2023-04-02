<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    require_once 'Connection/connect_LoginIn.php';
    // require_once "C:\xampp\htdocs\Login Form\Connection\connect_LoginUp.php"
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the username exists in the database
    $sql = "SELECT * FROM `user_login` WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        if($new_password == $confirm_password){
            // Update the user's password in the database
            $sql = "UPDATE `user_login` SET `password` = :password WHERE `username` = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $new_password);
            $stmt->execute();

            // Send an email to the user with the new password
            $to = $result[0]['email'];
            $subject = 'New Password';
            $message = 'Your new password is: ' . $new_password;
            mail($to, $subject, $message);

            // Redirect the user back to the login page
            header('location:login.php');
        }
        else{
            $error = "Passwords do not match.";
        }
    } else {
        $error = "Invalid username.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Forgot Password</title>
</head>

<body>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> <?php echo $error; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="login">
        <form action="forgotPassword.php" class="login__form" method="post">
            <h1 class="login__title">Forgot Password</h1>
                <div class="login__content">
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
                            <input type="password" required class="login__input" id="login-pass" placeholder=" " name="new_password">
                            <label for="" class="login__label">New Password</label>
                            <!-- <i class="ri-eye-off-line login__eye" id="login-eye"></i> -->
                        </div>
                    </div>

                    <div class="login__box">
                        <i class="ri-lock-2-line login__icon"></i>
                        <div class="login__box-input">
                            <input type="password" required class="login__input" id="login-rep_pass" placeholder=" " name="confirm_password">
                            <label for="" class="login__label">Confirm Password</label>                            
                            <!-- <i class="ri-eye-off-line login__eye" id="login-rep_eye"></i> -->
                        </div>
                    </div>

                </div>
            <button><h4>Reset Password</h4></button>
        </form>
    </div>
</body>

</html>

