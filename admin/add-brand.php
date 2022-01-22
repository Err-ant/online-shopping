<h1 class="text-primary"><i class="far fa-plus-square"></i> Add Brand</h1>
<ol class="breadcrumb">
    <li><a href="index.php?page=adminDashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><i class="far fa-plus-square"></i> Add Brand</a></li>
</ol>

<?php
if (isset($_POST['brand-category'])) {
    $brand_title = $_POST['brand_title'];

    $brand_check = mysqli_query($link, "SELECT * FROM brands WHERE brand_title='$brand_title';");
    if (mysqli_num_rows($brand_check) == 0) {
        
                $query = "INSERT INTO `brands`(`brand_title`) VALUES ('$brand_title')";
                $result = mysqli_query($link, $query);
                if ($result) {
                    $success = "Data inserted successfully";
                } else {
                    $error = "Wrong";
                }
         
    } else {
        $brand_error = "This Brand is already exists";
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
                <label for="brand_title">Brand Title</label>
                <input type="text" name="brand_title" placeholder="Brand Name" id="brand_title" class="form-control" required />
                <label class="error" style="font-style:italic; font-weight: 400;color:red "><?php if (isset($brand_error)) {
                                    echo $brand_error;
                                  } ?></label>
            </div>

            
            <div class="form-group">
                <input type="submit" name="brand-category" value="Add Brand" class="btn btn-primary pull-right"/>
            </div>
           


        </form>
    </div>
</div>
