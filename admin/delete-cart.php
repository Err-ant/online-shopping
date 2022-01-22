<?php

    require_once './dbconn.php';
    //echo $_GET['id'];
    $id=base64_decode($_GET['id']);
    mysqli_query($link,"DELETE FROM `cart` WHERE cart_id=$id");
    header("location:myCart.php");

?>