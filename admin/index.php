<?php
session_start();
require_once './dbconn.php';

if (!isset($_SESSION['aduser_login'])) {
  header('location:adminlogin.php');
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
  <style>
    .content {
      min-height: 410px;
    }

    .footer-area {
      padding: 25px;
      background: #3CA9E8;
      text-align: center;
      color: #fff;
      margin-top: 10px;
    }
   



  </style>
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
  

    
 
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <a class="navbar-brand" href="index.php">Online Shop</a>
        <a class="navbar-brand" href="adminlogout.php">Logout</a>

      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav navbar-right">



        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        <div class="list-group">
          <a href="index.php?page=adminDashboard" class="list-group-item active">
          <i class="fa fa-dashboard"></i> Dashboard
          </a>
          <a href="index.php?page=add-user" class="list-group-item"><i class="fa fa-user-plus"></i> ADD USER</a>
          <a href="index.php?page=products" class="list-group-item"><i class="fas fa-list-alt"></i> PRODUCT LIST</a>
          <a href="index.php?page=orders" class="list-group-item"><i class="fas fa-shopping-bag"></i> ORDERS</a>
          <a href="index.php?page=add-product" class="list-group-item"><i class="far fa-plus-square"></i> ADD PRODUCTS</a>
          <a href="index.php?page=add-category" class="list-group-item"><i class="far fa-plus-square"></i> ADD NEW CATEGORY</a>
          <a href="index.php?page=add-brand" class="list-group-item"><i class="far fa-plus-square"></i> ADD NEW BRAND</a>


        </div>

      </div>
      <div class="col-sm-9">
        <div class="content">
          <?php
          if (isset($_GET['page'])) {
            $page = $_GET['page'] . '.php';
          } else {
            $page = 'adminDashboard.php';
          }

          if (file_exists($page)) {
            require_once $page;
          } else {
            require_once "ad404.php";
          }

          ?>

        </div>

      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>