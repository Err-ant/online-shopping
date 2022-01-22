<h1 class="text-primary"><i class="fas fa-shopping-bag"></i> ORDERS <small>Statistics Overview</small></h1>
<ol class="breadcrumb">
  <li><a href="index.php?page=adminDashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
</ol>
<?php
require_once './dbconn.php';
?>

<h3>All Orders</h3>



<div class="table-responsive">

  <table id='data' class="table table-striped table-hover table-bordered">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Payment Mode</th>
        <th>Date</th>
        <th>Status</th>
        <th>Details</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $tb_pinfo = mysqli_query($link, "SELECT * FROM `order_info`");

      while ($row = mysqli_fetch_assoc($tb_pinfo)) {
        $cnum = $row['cardnumber'];
        $id = $row['user_id'];
        $sq = mysqli_query($link, "SELECT * FROM `user` Where `user_id`=$id");
        $nm = mysqli_fetch_assoc($sq);
        $name = $nm['name'];
        $sqq = mysqli_query($link, "SELECT * FROM `address` Where `address_card`=$cnum");
        $nmm = mysqli_fetch_assoc($sqq);
        $ads=$nmm['city'].','.$nmm['subdistrict'].','.$nmm['district'];

      ?>

        <tr>
          <td><?php echo $row['user_id']; ?> </td>
          <td><?php echo ucwords($name); ?> </td>
          <td><?php echo $row['phone']; ?> </td>
          <td><?php echo $ads; ?> </td>
          <td><?php echo $row['pmode']; ?> </td>
          <td><?php echo $row['date']; ?> </td>
          

          <td><?php echo $row['status']; ?> <a href="update_status.php?cnum=<?php echo base64_encode($cnum); ?>">
          <i class="fa fa-pencil"></i>Done</a></td>
          <td>

            <a href="ordermore.php?cnum=<?php echo base64_encode($cnum); ?>">Show Details</a>

          </td>
        </tr>
      <?php
      }
      ?>

    </tbody>
  </table>



</div>