<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
</head>

<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content   offers -->

<div class="main">
  
<div class="containe mb-5">
        <h2 class="mb-4">Sensor's Reading</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>#</th><th>Sensor Name</th>  <th>Readings</th> <th>Date/Time</th></tr>
        </thead>
        <tbody>
        <?php 
        $I=0;
        foreach($adminlist as $ad){
        
        $x1=$this->db->order_by('id','desc')->where('sensor_id',$ad['sensor_id'])->get('sensor_data')->row_array();
        //print_r($x);
        ?>
            <tr>
                <td><?php echo ++$I; ?></td>
                <td><?php echo $ad['name']; ?></td>
                              <td><?php
                              if(!empty($x1['sensor_data'])){
                              $x=json_decode($x1['sensor_data']);
                            //   echo "<pre>";
                            //   print_r($x);
                              echo $x[0]->val ." ". $x[0]->unit ;
                              
                            //   echo "</pre>";
                              }
                           if(!empty($x)){
                               //echo $x['sensor_data'];   
                           }
                              ?></td>
                              <td><?php 
                              if(!empty($x1['inserted_date'])){
                              
                              echo $x1['inserted_date'];
                              
                              }
                              ?></td>
            </tr>
            <?php } ?>
    </tbody>
        </table>
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