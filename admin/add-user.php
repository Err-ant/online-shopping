<h1 class="text-primary"><i class="fa fa-user-plus"></i> Add User <small>Statistics Overview</small></h1>
<ol class="breadcrumb">
    <li><a href="adminIndex.php?page=adminDashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><i class="fa fa-user-plus"></i>Add User</a></li>
</ol>
<?php
if (isset($_POST['add-user'])) {
    $fname = $_POST['f_name'];
   
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    

    $email_check = mysqli_query($link, "SELECT * FROM user WHERE email='$email';");
    if (mysqli_num_rows($email_check) == 0) {
        if (strlen($password) > 5) {
            if ($password == $c_password) {
                $password = md5($password);
                $query = "INSERT INTO `user`(`name`,`email`, `password`) VALUES ('$fname','$email','$password')";
                $result = mysqli_query($link, $query);
                if ($result) {
                    $success = "Data inserted successfully";
                } else {
                    $error = "Wrong";
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
<div class="row">
    <?php if (isset($success)) {
        echo '<p class="alert alert-success">' . $success . '</p>';
    } ?>
    <?php if (isset($error)) {
        echo '<p class="alert alert-danger">' . $error . '</p>';
    } ?>
</div>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="f_name">Name</label>
                <input type="text" name="f_name" placeholder="Name" id="f_name" class="form-control" required />
            </div>
           
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" id="email" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" id="password" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="c_password">Confirm Password</label>
                <input type="password" name="c_password" placeholder="Confirm Password" id="c_password" class="form-control" required />
            </div>
            <!--
            <div class="form-group">
               <label for="choose">Chose Security Question</label>
             <select class="form-control" id="Choose" name="choose">
                <option value="">Chose Security Question</option>
                <option value="one">What is your Primary School name?</option>
                <option value="two">What is you favourite Pet</option>

             </select>
            </div>
            <div class="form-group">
                <label for="answer">Answer</label>
                <input type="text" name="answer" placeholder="Answer" id="answer" class="form-control" required />
            </div>
-->
            
            <div class="form-group">
                <input type="submit" name="add-user" value="Add User" class="btn btn-primary pull-right"/>
            </div>
           <br><br>


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
</div>
