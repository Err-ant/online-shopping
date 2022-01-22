<?php
session_start();
require_once './dbconn.php';
$user_id=0;
if(isset($_SESSION['user_login'])){
  $user_id=$_SESSION['user_login'];
}
$date =date('Y-m-d');
//increment 2 days
$mod_date = strtotime($date."- 30 days");
$up= date("Y-m-d",$mod_date);
$take = mysqli_query($link, "SELECT SUM(products.product_price*dd.qty) as total FROM products INNER JOIN
(SELECT * FROM orders INNER JOIN
(SELECT `cardnumber` FROM `order_info` WHERE `date`>$up AND status='Done')dt
ON orders.order_info_id=dt.cardnumber)dd
ON products.product_id=dd.p_id;");
$row=mysqli_fetch_assoc($take);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>No shop</title>
  <script src="https://kit.fontawesome.com/cc0fc94170.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="styles/indexSt.css">
  <link rel="stylesheet" href="styles/myCartSt.css">

</head>

<body>

  <!--Navbar START -->
  <div class="header-sec">
    <div class="row">
      <div class="col-md-10 col-sm-10 brand-logo">
        <p><span class="no-same no-shop">LO</span><span class="no-same logo-shop">GO</span></p>
      </div>
      <div class="col-md-2 col-sm-2">
        <div class="dropdown">
          <a class="dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="images/Unknown_person.jpg" alt="">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="login.php">Log in</a></li>
            <li><a class="dropdown-item" href="regiForm.php">Sign Up</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
      </ul>
      <div id="myCartBtn" class="myCartMenu">
         <a href="mycart.php?id=<?php echo base64_encode($user_id);?>">                                
            <i class="fas fa-shopping-cart"></i> CART
          </a>
      </div>
      </div>

    </div>
  </nav>
  <!--Navbar END -->

  <script src="js/cartScript.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
