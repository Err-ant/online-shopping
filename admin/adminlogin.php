<?php
   session_start();
  require_once './dbconn.php';
 
  if(isset($_SESSION['aduser_login'])){
    header('location:index.php');
  }
  
  if(isset($_POST['login'])){

    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    
    $username_check=mysqli_query($link,"SELECT * FROM `admin` WHERE `admin_name`='$username';");
    if(mysqli_num_rows($username_check)>0){
       $row=mysqli_fetch_assoc($username_check);
       if($row['admin_password']==md5($password)){
         
            $_SESSION['aduser_login']=$username;
            header('location:index.php');
            
          
       }
       else{
         $wrong_password="This password is wrong";
       }
    }
    else{
      $username_not_found="This Admin Name not found";
    }
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Online Shopping System</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

  </head>
  <body style="background:#f5f5f5">
    
  <div class="container animate__animated animate__shakeX">
      <!--https://animate.style/-->

           
           <div>
                <h1  class="col-lg-12 text-center">Welcome to Online Shopping System</h1>
           </div>
        <div class="row">
        <h2 class="text-center">Admin Login Form</h2>
            <div class="col-sm-4 col-sm-offset-4">
            <form action="" method="POST">
                <div>
                    <input type="text" placeholder="Username" name="username" required="" class="form-control" value="<?php if(isset($username)){echo $username;} ?>"/>
                </div>
                <br>
                <div>
                    <input type="email" placeholder="Email" name="email" required="" class="form-control" value="<?php if(isset($email)){echo $email;} ?>"/>
                </div>
                <br>
                <div>
                    <input type="password" placeholder="Password" name="password" required="" class="form-control" value="<?php if(isset($password)){echo $password;} ?>" />
                </div>
                <br>
                <div>
					          <input class="btn btn-info pull-right" type="submit" value="Login" name="login">
			          </div>
            </form>
            </div>
         </div>
         <?php if(isset($username_not_found)){echo '<div class="alert danger-alert col-sm-3 col-sm-offset-4">'.$username_not_found.'</div>';}?>
         <?php if(isset($wrong_password)){echo '<div class="alert danger-alert col-sm-3 col-sm-offset-4">'.$wrong_password.'</div>';}?>

    </div>
  </body>
</html>