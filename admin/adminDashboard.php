<h1 class="text-primary"><i class="fa fa-dashboard"></i> Dashboard <small>Statistics Overview</small></h1>
<ol class="breadcrumb">
  <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>

</ol>
<?php
  require_once './dbconn.php';

?>

<h3>All Users</h3>

<div class="table-responsive">

  <table id='data' class="table table-striped table-hover table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>   
      </tr>
    </thead>
    <tbody>
      <?php
      $tb_sinfo=mysqli_query($link,"SELECT * FROM `user`");
      
      while($row=mysqli_fetch_assoc($tb_sinfo)){?>

      <tr>
        <td><?php echo $row['user_id']; ?> </td>
        <td><?php echo ucwords($row['name']); ?> </td>   
        <td><?php echo ucwords($row['email']); ?> </td>
        
      </tr>
      <?php
      }
      ?>
      
    </tbody>
  </table>

</div>