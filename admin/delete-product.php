<?php

    require_once './dbconn.php';
    //echo $_GET['id'];
    $id=base64_decode($_GET['id']);
    mysqli_query($link,"DELETE FROM `products` WHERE product_id=$id");
    header("location:index.php?page=products");

?>