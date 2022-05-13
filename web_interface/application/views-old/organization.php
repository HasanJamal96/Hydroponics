<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
    <style>
       

    </style>
</head>

<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content -->
<div class="main">
    <h1 class="text-center mt-4">Roasters</h1>

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Mode</th>
                <th>No Of Member</th>
                <!--
                <th>Action</th>
-->
              </tr>
            </thead>
            <tbody>
           <?php 
           $i=1;
           foreach($organizar as $j=> $k){ 
           
           
           ?>  
            <tr>
                <td><?php echo $i++; ?></td>
                <td>
                <?php if($k['imageUrl']!="noimage"){ ?>
                <img src="<?php echo $k['imageUrl'] ?>" style="height:100px;width:100px"/>
                <?php } ?>
                </td>
                <td><?php echo $k['roastersName'] ?></td>
                <td><?php echo $k['mode'] ?></td>
                <td>
                 <?php echo count($k['members']); ?>
                </td>
<!--
                <td>
                  View/Delete  
                </td>
                -->
                <!--
                <td><a href="#/">Delete</a> <a href="#/">Suspend</a></td>
              -->
              </tr>
              <?php } ?>
              
            </tbody>
           
          </table>
        </div>
      </div>
    </div>
</div>



    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>



    <script>
      $('table').DataTable();
    </script>
    
   

</body>

</html>