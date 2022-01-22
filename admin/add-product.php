<h1 class="text-primary"><i class="far fa-plus-square"></i> Add Product <small>Statistics Overview</small></h1>
<ol class="breadcrumb">
    <li><a href="adminIndex.php?page=adminDashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><i class="far fa-plus-square"></i> Add Product</a></li>
</ol>
<?php


if (isset($_POST['add-product'])) {
    $cat_id = $_POST['choose_cat'];
    $brand_id = $_POST['choose_brand'];
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];

    $photo = $_FILES['photo']['name'];
    $photo = explode('.', $photo);
    $photo_extension = end($photo);
    $photo_name = $product_title . '.' . $photo_extension;
    $dc=$_POST['dc'];



    $query = "INSERT INTO `products`(`cat_id`, `brand_id`, `product_title`, `product_price`, `product_image`,`description`) VALUES ('$cat_id','$brand_id','$product_title','$product_price','$photo_name','$dc')";
    $result = mysqli_query($link, $query);
    if ($result) {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo_name);
        $success = "Data inserted successfully";
    } else {
        $error = "Wrong";
    }
}

?>
<div class="row">
    <?php if (isset($success)) {
        echo '<p class="alert alert-success">' . $success . '</p>';
    } ?>
    <?php if (isset($error)) {
        echo '<p class="alert alert-danger">' . $error . '</p>';
    } ?>
</div>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="choose_cat">Chose Category</label>
                <select class="form-control" id="choose_cat" name="choose_cat" required>
                    <option value="">Choose product category</option>

                    <?php
                    $cat_info = mysqli_query($link, "SELECT * FROM `categories`");

                    while ($row = mysqli_fetch_assoc($cat_info)) { ?>

                        <option value="<?php echo $row['cat_id']; ?>"> <?php echo $row['cat_title']; ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Choose_brand">Chose Brand</label>
                <select class="form-control" id="Choose_brand" name="choose_brand">
                    <option value="">Choose product Brand</option>

                    <?php
                    $brand_info = mysqli_query($link, "SELECT * FROM `brands`");

                    while ($row1 = mysqli_fetch_assoc($brand_info)) { ?>

                        <option value="<?php echo $row1['brand_id']; ?>"> <?php echo $row1['brand_title']; ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>


            <div class="form-group">
                <label for="product_title">Product Title</label>
                <input type="text" name="product_title" placeholder="Product Name" id="product_title" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" name="product_price" placeholder="Product Price" id="product_price" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="dc">Description</label>
                <input type="text" name="dc" placeholder="Product Description" id="dc" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo">
            </div>

            <div class="form-group">
                <input type="submit" name="add-product" value="Add Product" class="btn btn-primary pull-right" />
            </div>



        </form>
        <br><br>
    </div>
</div>