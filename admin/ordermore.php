<?php
session_start();
require_once './dbconn.php';
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
    
<h3 style="text-align:center">Details</h3>


<div style="margin: 20px 50px">
<div class="table-responsive">

  <table id='data' class="table table-striped table-hover table-bordered">
    <thead>
      <tr>
       
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $cnum=base64_decode($_GET['cnum']);

      $tb_pinfo = mysqli_query($link, "SELECT * FROM orders     
      WHERE `order_info_id`=$cnum
      ;");

      while ($row = mysqli_fetch_assoc($tb_pinfo)) {
        $pid=$row['p_id'];
        $pqr=mysqli_query($link, "SELECT * FROM products     
        WHERE `product_id`=$pid
        ;");

        $prow=mysqli_fetch_assoc($pqr);
      ?>

        <tr>

         <td><img src="images/<?php echo $prow['product_image'] ?>" height="60" width="55" alt=""> </td>
          <td><?php echo $prow['product_title']; ?> </td>
          <td><?php echo $prow['product_price']; ?> </td>
          <td><?php echo $row['qty']; ?> </td>
          <td><?php echo $prow['product_price']* $row['qty']; ?> </td>
        </tr>
      <?php
       
      }
      ?>

    </tbody>
  </table>
  <a href="index.php?page=orders">Return Orders</a>
  </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>