<?php
session_start();
require_once './dbconn.php';
if (isset($_POST['sign_up'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    

    $email_check = mysqli_query($link, "SELECT * FROM user WHERE email='$email';");
    if (mysqli_num_rows($email_check) == 0) {
        if (strlen($password) > 5) {
            if ($password == $c_password) {
                $password = md5($password);
                $query = "INSERT INTO `user`(`name`, `email`, `password`) VALUES ('$name','$email','$password');";
                $result = mysqli_query($link, $query);
                if ($result) {
                    $q=mysqli_query($link,"SELECT * FROM `user` WHERE `email`='$email';");
                    $rr=mysqli_fetch_assoc($q);
                    $user_id=$rr['user_id'];
                    $_SESSION['user_login'] = $user_id;
                    header('location:index.php');
                }
            } else {
                $password_not_match = "password doesn't matched";
            }
        } else {
            $password_l = "password should be more than 5 character";
        }
    } else {
        $email_error = "This email address is already exists";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/signupFormSt.css">
</head>

<body>
    <div class="loginForm">
        <div class="login-main">
            <div class="login-header">
                <h3>Register Here</h3>
            </div>
            <!--<form action="wel.php" method="post">-->
            <div class="row">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- <div class="login-text">-->
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php if (isset($name)) {
                                                                                                                    echo $name;
                                                                                                                } ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if (isset($email)) {
                                                                                                                echo $email;
                                                                                                            } ?>" required>

                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if (isset($password)) {
                                                                                                                        echo $password;
                                                                                                                    } ?>" required>


                    </div>
                    <div class="form-group">
                        <input type="password" name="c_password" class="form-control" placeholder="Confirm Password" value="<?php if (isset($c_password)) {
                                                                                                                                echo $c_password;
                                                                                                                            } ?>" required>
                   
                    </div>
                    <!--
                    <div class="form-group">
                        <input type="text" name="mobile" id="" class="form-control" placeholder="Mobile" pattern="01[1|5|6|7|8|9][0-9]{8}" value="<?php //if (isset($mobile)) {
                                                                                                                                                       // echo $mobile;
                                                                                                                                                   // } ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" id="" class="form-control" placeholder="Address" value="<?php //if (isset($address)) {
                                                                                                                        //echo $address;
                                                                                                                   // } ?>" required>
                    </div>
                    <div class="form-group">

                        <select class="form-control" id="Choose" name="choose">
                            <option value="">Chose Security Question</option>
                            <option value="one">What is your Primary School name?</option>
                            <option value="two">What is you favourite Pet</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="answer" id="" class="form-control" placeholder="Give your Answer" required>
                    </div>
                   -->
                    <div class="form-group">
                        <input type="submit" name="sign_up" value="Sign Up" class="btn btn-primary" />
                    </div> 
                </form>
                                                  
                <div class="error">
                    <?php
                    if (isset($email_error)) {
                        echo $email_error;
                    } else {
                        if (isset($password_l)) {
                            echo $password_l;
                        } else {
                            if (isset($password_not_match)) {
                                echo $password_not_match;
                            }
                        }
                    }

                    ?>

                </div>

            </div>

            <div class="login-signup-option">
                <h6>Already have an account? <a href="login.php">Log in</a></h6>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>