<?php
session_start();
require_once './dbconn.php';

$user_id = $_SESSION['user_login'];
$take = mysqli_query($link, "SELECT * FROM `user` WHERE user_id='$user_id';");
$taker = mysqli_fetch_assoc($take);
$name = $taker['name'];
$splitter = " ";
$pieces = explode($splitter, $name);

$grand_total = 0;
$allItems = '';
$items = [];

$sql = mysqli_query($link,"SELECT CONCAT(product_title, '(',qty,')') AS ItemQty, total_price FROM cart INNER JOIN products ON products.product_id=cart.product_id WHERE user_id='$user_id';");
$row=mysqli_fetch_assoc($sql);
while ($row){
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty']; 
    $row=mysqli_fetch_assoc($sql);
}
$allItems = implode(', ', $items);

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
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  
  <link rel="stylesheet" href="styles/indexSt.css">
  <link rel="stylesheet" href="styles/myCartSt.css">

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
                <div id="myCartBtn" class="myCartMenu">
                    <a href="mycart.php">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-item" class="badge badge-danger"></span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!--Navbar END -->

    <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" pattern="01[1|5|6|7|8|9][0-9]{8}" required>
          </div>
          <div class="form-group">
            <input type="text" name="district" class="form-control" placeholder="Enter District" required>
          </div>
          <div class="form-group">
            <input type="text" name="subdistrict" class="form-control" placeholder="Enter Subdistrict" required>
          </div>
          <div class="form-group">
            <input type="text" name="city" class="form-control" placeholder="Enter City/Village" required>
          </div>
         
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="cod">Cash On Delivery</option>
              <option value="bKash">bKash</option>
              <option value="Nagad">Nagad</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger"><!--btn-block-->

          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>