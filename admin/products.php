<h1 class="text-primary"><i class="fas fa-list-alt"></i> All Product <small>Statistics Overview</small></h1>
<ol class="breadcrumb">
    <li><a href="index.php?page=adminDashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><i class="fas fa-list-alt"></i> All Products</a></li>
</ol>
<?php
  require_once './dbconn.php';
?>

<h3>All Products</h3>

<div class="table-responsive">

  <table id='data' class="table table-striped table-hover table-bordered">
    <thead>
      <tr>
        <th>Product ID</th>
        <th>Category ID</th>
        <th>Brand ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $tb_pinfo=mysqli_query($link,"SELECT * FROM `products`");
      
      while($row=mysqli_fetch_assoc($tb_pinfo)){?>

      <tr>
        <td><?php echo $row['product_id']; ?> </td>
        <td><?php echo $row['cat_id']; ?> </td>
        <td><?php echo $row['brand_id']; ?> </td>
        <td><?php echo ucwords($row['product_title']); ?> </td>
        <td><?php echo $row['product_price']; ?> </td>
        <td><img src="images/<?php echo $row['product_image'] ?>" height="60" width="55" alt=""> </td>
        <td>
             <a href="index.php?page=update-product&id=<?php echo base64_encode($row['product_id']); ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i>Edit</a>
             &nbsp;&nbsp;&nbsp;
             <a href="delete-product.php?id=<?php echo base64_encode($row['product_id']); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>Delete</a>
        </td>


      </tr>
      <?php
      }
      ?>
      
    </tbody>
  </table>

</div>