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
    <h1 class="text-center mt-4">Events</h1>


    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <!--
                <th>Income</th>
                -->
                <th>Event Name</th>
                <th>Mode</th>
                <th>Date</th>
                <th>Time</th>
                <th>Note</th>
                <th>No Of Members</th>
              <!--
                <th>Action</th>
-->
              </tr>
            </thead>
            <tbody>
              <?php 
              $i=1;
              foreach($vendor as $m=> $va){ ?> 
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php  echo $va['event_Name'];?></td>
                <td><?php  echo $va['mode'];?></td>
                <td><?php  echo $va['date'];?></td>
                <td><?php  echo $va['time'];?></td>
                <td><?php  echo $va['notes'];?></td>
                <td><?php  echo count($va['members']);?></td>
               <!--
                <td>View/Delete</td>
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