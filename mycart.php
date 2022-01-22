<?php
session_start();
require_once './dbconn.php';

$user_id = $_SESSION['user_login'];
$take = mysqli_query($link, "SELECT * FROM `user` WHERE user_id='$user_id';");
$taker = mysqli_fetch_assoc($take);
$name = $taker['name'];
$splitter = " ";
$pieces = explode($splitter, $name);

/*
$user_id == 0;
if (isset($_SESSION['user_login'])) {
  $user_id = $_SESSION['user_login'];
}
if ($user_id == 0) { ?>

  <div style="height: 220px;text-align:center">
    <h4>This Shopping cart is empty </h4>
  </div>

<?php
} else { ?>
  */
  ?>
  <!--Cart start -->
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
        <div class="col-lg-10">
          <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                                echo $_SESSION['showAlert'];
                              } else {
                                echo 'none';
                              }
                              unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php if (isset($_SESSION['message'])) {
                      echo $_SESSION['message'];
                    }
                    unset($_SESSION['showAlert']); ?></strong>
          </div>
          <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped text-center">
              <thead>
                <tr>
                  <td colspan="7">
                    <h4 class="text-center text-info m-0">Products in your cart!</h4>
                  </td>
                </tr>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>
                    <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once './dbconn.php';
                $tb_pinfo = mysqli_query($link, "SELECT * FROM  `products`
                                  INNER JOIN `cart` ON products.product_id=cart.product_id");


                $row = mysqli_fetch_assoc($tb_pinfo);
                $grand_total = 0;

                while ($row) {
                 
                ?>
                  <tr>
                    <td><?= $row['product_id'] ?></td>
                    <input type="hidden" class="pid" value="<?= $row['product_id'] ?>">
                    <td><img src="admin/images/<?php echo $row['product_image'] ?>" width="50"></td>
                    <td><?= $row['product_title'] ?></td>
                    <td>
                      &nbsp;&nbsp;<?= number_format($row['product_price'], 2)." /="; ?>
                    </td>
                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                    <td>
                      <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                    </td>
                    <td>&nbsp;&nbsp;<?= number_format($row['total_price'], 2)." /="; ?></td>
                    <td>
                      <a href="action.php?remove=<?= $row['product_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <?php $grand_total +=$row['total_price']; ?>
                <?php
                  $row = mysqli_fetch_assoc($tb_pinfo);
                } ?>
                <tr>
                  <td colspan="3">
                    <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                      Shopping</a>
                  </td>
                  <td colspan="2"><b>Grand Total</b></td>
                  <td><b>&nbsp;&nbsp;<?= number_format($grand_total, 2)." /="; ?></b></td>
                  <td>
                    <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
      $(document).ready(function() {

        // Change the item quantity
        $(".itemQty").on('change', function() {
          var $el = $(this).closest('tr');

          var pid = $el.find(".pid").val();
          var pprice = $el.find(".pprice").val();
          var qty = $el.find(".itemQty").val();
          location.reload(true);
          $.ajax({
            url: 'action.php',
            method: 'post',
            cache: false,
            data: {
              qty: qty,
              pid: pid,
              pprice: pprice
            },
            success: function(response) {
              console.log(response);
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

    <!--Cart END-->
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>

  </html>
  
<?php
/*
}
*/
?>
<?php
include 'footer.php';
?>