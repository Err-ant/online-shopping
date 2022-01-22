<?php
session_start();
require_once './dbconn.php';

$user_id = 0;
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $take = mysqli_query($link, "SELECT * FROM `user` WHERE user_id='$user_id';");
    $taker = mysqli_fetch_assoc($take);
    $name = $taker['name'];
    $splitter = " ";
    $pieces = explode($splitter, $name);
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Online Shop</title>
    <!-- Bootstrap -->
    <script src="https://kit.fontawesome.com/cc0fc94170.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/indexSt.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="styles/style1.css" rel="stylesheet">

    <link href="../css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>


</head>

<body>

    <!--Navbar START -->
    <div class="header-sec">
        <div class="row">
            <div class="col-md-9 col-sm-9 brand-logo">
                <p><span class="no-same no-shop">LO</span><span class="no-same logo-shop">GO</span></p>
            </div>

            <div class="col-md-2 col-sm-2" style="text-align: center;margin-top: 10px;margin-bottom: 10px;">
                <?php
                if ($user_id) {
                    echo "Welcome ";
                    echo $pieces[0];
                }
                ?>
            </div>
            <div class="col-md-1 col-sm-1">
                <div class="dropdown">

                    <a class="dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if ($user_id) {
                            echo '<img src="images/user_on.png" alt="">';
                        } else {
                            echo '<img src="images/user_off.png" alt="">';
                        }
                        ?>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        if ($user_id > 0) { ?>
                            <li><a class="dropdown-item" href="regiForm.php">Sign Up</a></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php
                        } else { ?>
                            <li><a class="dropdown-item" href="login.php">Log in</a></li>
                            <li><a class="dropdown-item" href="regiForm.php">Sign Up</a></li>

                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-bg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <div class="d-flex myCartMenu me-2">
                            <a class="" href="index.php">Home</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#newest">Newest Arrival</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#top">Top sale</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $tb_pinfo = mysqli_query($link, "SELECT * FROM `categories`");
                            while ($row3 = mysqli_fetch_assoc($tb_pinfo)) { ?>
                                <li><a class="dropdown-item" href="#<?php echo ucwords($row3['cat_title']); ?>"><?php echo ucwords($row3['cat_title']); ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us">About us</a>
                    </li>
                </ul>
                <?php
                if ($user_id > 0) { ?>
                    <div id="myCartBtn" class="myCartMenu">
                        <a href="mycart.php">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cart-item" class="badge badge-danger"></span>
                        </a>
                    </div>
                <?php
                } else { ?>
                    <div id="myCartBtn" class="myCartMenu">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-item" class="badge badge-danger"></span>
                    </div>
                <?php
                }
                ?>

            </div>

        </div>
    </nav>
    <!--Navbar END -->
    <div style="margin: 20px 50px">
        <?php
        if ($user_id) { ?>
            <div class="row">
                <div class="col-sm-4">
                    <h1 class="text-primary"><i class="fa fa-user"></i> User Profile</h1>
                    <table class="table table-bordered">
                        <tr>
                            <td>ID</td>
                            <td><?= $user_id; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?= ucwords($taker['name']); ?></td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td><?= $taker['email']; ?></td>
                        </tr>
                    </table>

                </div>

                <div class="col-sm-7">
                    <h2 class="text-primary" style="text-align: center;">Your Products</h2>

                    <div class="table-responsive">

                        <table id='data' class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>

                                    <th>Card Number</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Payment Mode</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $tb_pinfo = mysqli_query($link, "SELECT * FROM `order_info` Where `user_id`=$user_id");

                                while ($row = mysqli_fetch_assoc($tb_pinfo)) {
                                    $cnum = $row['cardnumber'];
                                    $sqq = mysqli_query($link, "SELECT * FROM `address` Where `address_card`=$cnum");
                                    $nmm = mysqli_fetch_assoc($sqq);
                                    $ads=$nmm['city'].','.$nmm['subdistrict'].','.$nmm['district'];
                            
                                ?>

                                    <tr>

                                        <td><?php echo  $cnum; ?> </td>
                                        <td><?php echo $row['phone']; ?> </td>
                                        <td><?php echo $ads; ?> </td>
                                        <td><?php echo $row['pmode']; ?> </td>
                                        <td><?php echo $row['date']; ?> </td>
                                        <td><?php echo $row['status']; ?> </td>
                                        <td>

                                            <a href="profilemore.php?cnum=<?php echo base64_encode($cnum); ?>">Show Details</a>

                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>



                    </div>

                </div>
            <?php
        } else {

            echo "<h1>Please <a href='login.php'>Login</a> first</h1>";
        }
            ?>
            <br><br>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<br><br>

</html>
