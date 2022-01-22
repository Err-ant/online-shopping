<h1 class="text-primary"><i class="far fa-plus-square"></i> Add Category</h1>
<ol class="breadcrumb">
    <li><a href="index.php?page=adminDashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><i class="far fa-plus-square"></i> Add Category</a></li>
</ol>

<?php
if (isset($_POST['add-category'])) {
    $cat_title = $_POST['cat_title'];

    $cat_check = mysqli_query($link, "SELECT * FROM categories WHERE cat_title='$cat_title';");
    if (mysqli_num_rows($cat_check) == 0) {
        
                $query = "INSERT INTO `categories`(`cat_title`) VALUES ('$cat_title')";
                $result = mysqli_query($link, $query);
                if ($result) {
                    $success = "Data inserted successfully";
                } else {
                    $error = "Wrong";
                }
         
    } else {
        $cat_error = "This Category is already exists";
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
                <label for="cat_title">Category Title</label>
                <input type="text" name="cat_title" placeholder="Category Name" id="cat_title" class="form-control" required />
                <label class="error" style="font-style:italic; font-weight: 400;color:red "><?php if (isset($cat_error)) {
                                    echo $cat_error;
                                  } ?></label>
            </div>
            
            <div class="form-group">
                <input type="submit" name="add-category" value="Add Category" class="btn btn-primary pull-right"/>
            </div>
           


        </form>
    </div>
</div>
