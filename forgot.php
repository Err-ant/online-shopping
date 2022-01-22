<?php
require_once './dbconn.php';
session_start();
$email=base64_decode($_GET['id']);
if (isset($_POST['sign_up'])) {
   
    $password = $_POST['password'];
    
    $c_password = $_POST['c_password'];
    if ($password == $c_password) {
    $password = md5($password);
    $rr = mysqli_query($link, "UPDATE `user_info` SET `password`='$password' WHERE `email`='$email';");
    header('location:index.php');
    }
    else {
        $password_not_match = "password doesn't matched";
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/loginFormSt.css">
</head>

<body>
    <div class="loginForm">
        <div class="login-main">
            <div class="login-header">
                <h3>Update Password</h3>
             
            </div>
            <div class="login-text">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter New Password" required>


                    </div>
                    <div class="form-group">
                        <input type="password" name="c_password" class="form-control" placeholder="Confirm Password"  required>

                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" name="sign_up" value="Sign Up" class="btn btn-primary" />
                    </div> 

                </form>
                <div class="error">
                    <?php
                    if (isset($password_not_match)) {
                                echo $password_not_match;
                            }
                            
                    ?>

                 </div>
            </div>
        </div>
    </div>
</body>

</html>