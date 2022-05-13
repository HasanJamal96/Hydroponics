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
    <h1 class="text-center mt-4">Vendors</h1>


    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Income</th>
                <th>Vendor</th>
                <th>Based In</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i=1;
              for($j=0;$j<count($vendorin); $j++){

              
              foreach($vendorin[$j] as $k1=> $va){ 
              echo "<pre>";
              print_r($k1);
              echo "</pre>";
                  ?> 
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php  echo $va['cost_range'];?></td>
                <td><?php  echo $va['username'];?></td>
                <td><?php  echo $va['based_in'];?></td>
                <td><a href="<?php echo base_url().'site/delete_vendor/'.$k1 ?>">Delete</a>
                <?php if($va['vendorstatus']=="active"){ ?>
                <a href="<?php echo base_url().'site/vendorstatus/0/'.$k1 ?>">Suspend</a>
                <?php }else{ ?>
                    <a href="<?php echo base_url().'site/vendorstatus/1/'.$k1 ?>">Active</a>
                <?php  } ?>
                
                </td>
              </tr>
             <?php } } ?>
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