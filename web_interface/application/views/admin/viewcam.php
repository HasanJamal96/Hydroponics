<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
</head>

<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content   offers -->
<div class="main">
  <?php 
//   echo "<pre>";
//   print_r($adminlist);
//   echo "</pre>";
  ?>
  
    <div class="row">
        <div class="col-sm-6">
        <h2 class="mb-4">Cam Detail</h2>
        <?php if($adminlist['embedcode'] !=""){ ?>
        <?php echo $adminlist['embedcode'];  ?>
        <?php }else{ ?>
        echo "Embed Code is not provided.";
        <?php } ?>
</div>
<div class="col-sm-6">
        <h2 class="mb-4">Timelapes</h2>
    <form action ="<?php echo base_url().'admin/viewtimeslice/'.$cam_id ?>" method ="GET">
  <div class="form-group">
    <label for="formGroupExampleInput">Start Date</label>
    <input type="date" class="form-control" required name="start_date" id="formGroupExampleInput" placeholder="Start Date">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">End Date</label>
    <input type="date" class="form-control" required name="end_date" id="formGroupExampleInput2" placeholder="End Date">
  </div>
  
   <div class="form-group">
  <button type="submit" class="btn btn-success">Submit</button>
  </div>
  
</form>
    
    
</div>
    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
        </script>

</body>

</html>