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
  //SELECT * FROM `user_info` WHERE user_id='1';
}

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
  <!-- slider Start Here -->
  <div class="slider container">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/laptop_Banner.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
        <div class="carousel-item">
          <img src="images/mobile_Banner.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="images/game_Kit1.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- slider end here -->
  <br><br>
  <!-- Newest start here -->
  <section class="container product-card" id="newest">
    <div id="message"></div>
    <div class="cat1Heading d-flex justify-content-between">
      <h3>Newest Arrival</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      $new = mysqli_query($link, "SELECT * FROM `products` ORDER BY `product_id` DESC LIMIT 6;");
      $hw = mysqli_fetch_assoc($new);
      while ($hw) { ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="product-bg">
            <div class="card h-100 shadow p-3 mb-5 bg-body rounded">
              <img src="admin/images/<?php echo $hw['product_image'] ?>" class="card-img-top img-fluid" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $hw['product_title']; ?></h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
              <div class="d-flex justify-content-between pCardPrice">
                <h4><?php echo $hw['product_price']; ?></h4>
                <div>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                </div>
              </div>

              <div class="card-footer p-1">
                <form action="" class="form-submit">
                  <input type="hidden" class="pqty" value="1">
                  <input type="hidden" class="pid" value="<?= $hw['product_id'] ?>">
                  <input type="hidden" class="pname" value="<?= $hw['product_title'] ?>">
                  <input type="hidden" class="pprice" value="<?= $hw['product_price'] ?>">
                  <input type="hidden" class="pimage" value="<?= $hw['product_image'] ?>">
                  <?php
                  if ($user_id > 0) { ?>
                    <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                      cart</button>
                  <?php
                  } else { ?>
                    <button class="btn btn-info btn-block addItemBtn disabled"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                      cart</button>
                  <?php
                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
        </div>

      <?php
        $hw = mysqli_fetch_assoc($new);
      }
      ?>


    </div>

  </section>
  <!-- Newest end here -->

  <!-- Top start here -->
  <section class="container product-card" id="top">
    <div class="cat1Heading d-flex justify-content-between">
      <h3>Top Sale</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php

      $nw = mysqli_query($link, "SELECT products.product_id,`product_title`,`product_price`,`product_image` FROM products INNER JOIN
              (SELECT `p_id`,SUM(qty) as sm FROM `orders` GROUP BY `p_id`
              ORDER BY sm DESC
              LIMIT 3)as dt
              on products.product_id=dt.p_id
              ;");

      $hww = mysqli_fetch_assoc($nw);
      while ($hww) { ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="product-bg">
            <div class="card h-100 shadow p-3 mb-5 bg-body rounded">
              <img src="admin/images/<?php echo $hww['product_image'] ?>" class="card-img-top img-fluid" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $hww['product_title']; ?></h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
              <div class="d-flex justify-content-between pCardPrice">
                <h4><?php echo $hww['product_price']; ?></h4>
                <div>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                  <i class="fas fa-star ratingColor"></i>
                </div>
              </div>

              <div class="card-footer p-1">
                <form action="" class="form-submit">
                  <input type="hidden" class="pqty" value="1">
                  <input type="hidden" class="pid" value="<?= $hww['product_id'] ?>">
                  <input type="hidden" class="pname" value="<?= $hww['product_title'] ?>">
                  <input type="hidden" class="pprice" value="<?= $hww['product_price'] ?>">
                  <input type="hidden" class="pimage" value="<?= $hww['product_image'] ?>">
                  <?php
                  if ($user_id > 0) { ?>
                    <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                      cart</button>
                  <?php
                  } else { ?>
                    <button class="btn btn-info btn-block addItemBtn disabled"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                      cart</button>
                  <?php
                  }
                  ?>



                </form>
              </div>
            </div>
          </div>
        </div>

      <?php
        $hww = mysqli_fetch_assoc($nw);
      }
      ?>


    </div>

  </section>
  <!-- Newest end here -->


  <?php
  $info = mysqli_query($link, "SELECT * FROM `categories`;");
  $total_categories = mysqli_num_rows($info);
  $row1 = mysqli_fetch_assoc($info);
  $category_name = $row1['cat_title'];
  while ($row1) { ?>

    <!-- Laptop START Here-->
    <section class="container product-card" id="<?php echo ucwords($row1['cat_title']); ?>">
      <div class="cat1Heading d-flex justify-content-between">
        <h3><?php echo ucwords($row1['cat_title']); ?></h3>

      </div>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $category_id = $row1['cat_id'];

        $tb_pinfo = mysqli_query($link, "SELECT * FROM `products` where `cat_id`='$category_id'");
        $total_products = mysqli_num_rows($tb_pinfo);
        $i = 1;

        $row = mysqli_fetch_assoc($tb_pinfo);
        $cat_id = $row['cat_id'];
        while ($row and $i < 4) { ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="product-bg">
              <div class="card h-100 shadow p-3 mb-5 bg-body rounded">
                <img src="admin/images/<?php echo $row['product_image'] ?>" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['product_title']; ?></h5>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-flex justify-content-between pCardPrice">
                  <h4><?php echo $row['product_price']; ?></h4>
                  <div>
                    <i class="fas fa-star ratingColor"></i>
                    <i class="fas fa-star ratingColor"></i>
                    <i class="fas fa-star ratingColor"></i>
                    <i class="fas fa-star ratingColor"></i>
                    <i class="fas fa-star ratingColor"></i>
                  </div>
                </div>


                <div class="card-footer p-1">
                  <form action="" class="form-submit">
                    <input type="hidden" class="pqty" value="1">
                    <input type="hidden" class="pid" value="<?= $row['product_id'] ?>">
                    <input type="hidden" class="pname" value="<?= $row['product_title'] ?>">
                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                    <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                    <?php
                    if ($user_id > 0) { ?>
                      <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                        cart</button>
                    <?php
                    } else { ?>
                      <button class="btn btn-info btn-block addItemBtn disabled"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                        cart</button>
                    <?php
                    }
                    ?>



                  </form>
                </div>
              </div>
            </div>
          </div>

        <?php
          $row = mysqli_fetch_assoc($tb_pinfo);
          $i++;
        }
        ?>


      </div>
      <?php
      if ($user_id > 0) { ?>
        <div>
          <a href="categories.php?id=<?php echo base64_encode($category_id); ?>" class="cat1Heading d-flex justify-content-between"><i class=""></i>see more</a>
        </div>
      <?php
      }
      ?>
    </section>

  <?php
    $row1 = mysqli_fetch_assoc($info);
  }
  ?>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

      // Send product details in the server
      $(".addItemBtn").click(function(e) {

        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var pid = $form.find(".pid").val();
        var pname = $form.find(".pname").val();
        var pprice = $form.find(".pprice").val();
        var pimage = $form.find(".pimage").val();
        //var pcode = $form.find(".pcode").val();

        var pqty = $form.find(".pqty").val();

        $.ajax({
          url: 'action.php',
          method: 'post',
          data: {
            pid: pid,
            pname: pname,
            pprice: pprice,
            pqty: pqty,
            pimage: pimage,
            //pcode: pcode
          },
          success: function(response) {
            $("#message").html(response);
            //window.scrollTo(0, 0);
            load_cart_item_number();
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





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>