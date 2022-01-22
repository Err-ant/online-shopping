<h1 class="text-primary"><i class="fa fa-pencil-square-o"></i> Update Product <small>Statistics Overview</small></h1>
<ol class="breadcrumb">
    <li><a href="index.php?page=adminDashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="index.php?page=products"><i class="fa fa-user-plus"></i>All Products</a></li>
    <li class="active"><i class="fa fa-pencil-square-o"></i>Update Product</li>
</ol>
<?php
require_once './dbconn.php';
//echo $_GET['id'];
$id = base64_decode($_GET['id']);
$db_data= mysqli_query($link,"SELECT * FROM `products` WHERE product_id=$id");

$db_row = mysqli_fetch_assoc($db_data);

if (isset($_POST['update-product'])) {

    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];

    $photo = $_FILES['photo']['name'];
    $photo = explode('.', $photo);
    $photo_extension = end($photo);
    $photo_name = $product_title . '.' . $photo_extension;

    $query = "UPDATE `products` SET `product_title`='$product_title',`product_price`='$product_price',`product_image`='$photo_name' WHERE product_id=$id";
    $result = mysqli_query($link, $query);
    if ($result) {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo_name);
        header('location:index.php?page=products');
    }
}

?>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_title">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" value="<?= $db_row['product_title'] ?>" />
            </div>

            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" name="product_price" id="product_price" class="form-control" value="<?= $db_row['product_price'] ?>" />
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo">
            </div>

            <div class="form-group">
                <input type="submit" name="update-product" value="Update Product" class="btn btn-primary pull-right" />
            </div>



        </form>
    </div>
</div>