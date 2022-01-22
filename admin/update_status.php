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

    <?php

    $cnum = base64_decode($_GET['cnum']);

    mysqli_query($link, "UPDATE `order_info` SET `status`='Done' WHERE `cardnumber`='$cnum'
      ;");
/*
    $tb = mysqli_query($link, "SELECT * FROM `order_info`    
        WHERE `cardnumber`='$cnum'
        ;");

    $tbr = mysqli_fetch_assoc($tb);
    $id = $tbr['user_id'];


    $tb_pinfo = mysqli_query($link, "SELECT * FROM orders     
      WHERE `order_info_id`=$cnum
      ;");
    $total = 0;
    while ($row = mysqli_fetch_assoc($tb_pinfo)) {
        $pid = $row['p_id'];
        $pqr = mysqli_query($link, "SELECT * FROM products     
        WHERE `product_id`=$pid
        ;");
        $prow = mysqli_fetch_assoc($pqr);
        $total += ($row['qty'] * $prow['product_price']);
    }
    $vt = ($total * 5) / 100;
    $total += $vt;
    $dt = date("d/m/Y");
    mysqli_query($link, "INSERT INTO `payment`( `date`, `user_id`, `total_amount`) VALUES ('$dt','$id','$total')
      ;");
*/
     header('location:index.php?page=orders');
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>