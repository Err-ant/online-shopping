<?php
	session_start();
    require_once './dbconn.php';
	$user_id=0;
	if(isset($_SESSION['user_login'])){
	$user_id = $_SESSION['user_login'];
	}
	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  //$pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice * $pqty;
      
      $qr = mysqli_query($link, "SELECT * FROM `cart` WHERE `product_id`='$pid' AND user_id='$user_id';");
      $r=mysqli_fetch_assoc($qr);
      $num = mysqli_num_rows($qr);
	  
	  if (!$num) {
        $query = mysqli_query($link, "INSERT INTO `cart`(`product_id`, `product_price`,`qty`,`total_price`,`user_id`) VALUES ('$pid','$pprice','$pqty','$total_price','$user_id');");

		echo '<script>alert("Item added to your cart!")</script>';
       
		/*
		echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
						*/
	  } else {
		echo '<script>alert("Item already added to your cart!")</script>';		
		/*
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
						*/
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
        $qr = mysqli_query($link, "SELECT * FROM `cart` WHERE user_id='$user_id';");
       
        $rows = mysqli_num_rows($qr);

	    echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];
	  $stmt =mysqli_query($link,"DELETE FROM cart WHERE product_id=$id AND user_id='$user_id';");
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:mycart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
      $stmt=mysqli_query($link,"DELETE FROM cart WHERE user_id='$user_id';");
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:mycart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  //$user_id = $_SESSION['user_login'];
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];
	  $tprice = $qty * $pprice;
      $stmt=mysqli_query($link,"UPDATE `cart` SET `qty`='$qty',`total_price`='$tprice' WHERE `product_id`='$pid' AND user_id='$user_id' ;");
	}

	// Checkout and save customer info in the order table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $district = $_POST['district'];
	  $subdistrict = $_POST['subdistrict'];
	  $city = $_POST['city'];
	  $pmode = $_POST['pmode'];

	  $data = '';

	  

	  $qr = mysqli_query($link, "SELECT * FROM `cart` WHERE user_id='$user_id';"); 
      $num_rows = mysqli_num_rows($qr);
	  $row=mysqli_fetch_assoc($qr);
	  $dt=date("Y-m-d");

	  $sql= mysqli_query($link,"INSERT INTO order_info (`user_id`,`phone`,`pmode`,`date`,`status`)VALUES('$user_id','$phone','$pmode','$dt','ordered');");

	  $tk=mysqli_query($link,"SELECT * FROM `order_info` WHERE user_id='$user_id'
	  ORDER BY cardnumber DESC
	  LIMIT 1;");
	  $tkrow=mysqli_fetch_assoc($tk);
	  $order_info_id= $tkrow['cardnumber'];
	  $sql= mysqli_query($link,"INSERT INTO `address` (`district`,`subdistrict`,`city`,`address_card`)VALUES('$district','$subdistrict','$city','$order_info_id');");

	  while($row){
		  
		$pid=$row['product_id'];
		$qrr = mysqli_query($link, "SELECT * FROM `products` WHERE product_id='$pid';"); 
		$info=mysqli_fetch_assoc($qrr);
		$ptitle=$info['product_title'];
		$pimage=$info['product_image'];
        $qty=$row['qty'];
		$pprice=$row['product_price'];

	    mysqli_query($link,"INSERT INTO orders (`p_id`,`qty`,`order_info_id`)VALUES('$pid','$qty','$order_info_id');");

        $row=mysqli_fetch_assoc($qr);
	  }

      $sql= mysqli_query($link,"DELETE FROM cart WHERE user_id='$user_id';");

	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
                                <h4>Your Address: ' . $city.','.$subdistrict.','.$district. '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
								<br> <br>
								<a href="pdf.php" class="btn btn-danger" target="_blank">Invoice Pdf</a>
						  </div>';
	  echo $data;
	}
?>