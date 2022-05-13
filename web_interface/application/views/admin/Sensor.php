<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
</head>

<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content   offers -->

<div class="main">
  
<div class="col-12 col-md-12 d-flex justify-content-end">
                    <a href="<?php echo base_url().'admin/addnewsensor' ?>" class="btn btn-info">
                     Add New Sensor
                    </a>
                </div>
    <div class="containe mb-5">
        <h2 class="mb-4">Sensor's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>#</th><th>Sensor Name</th> <th>Sensor Default Value</th><th>Association output</th>  <th>Action</th> </tr>
        </thead>
        <tbody>
        <?php 
        $I=0;
        foreach($adminlist as $ad){ 
        // echo "<pre>";
        // print_r($ad);
        // echo "</pre>";
        
        ?>
            <tr>
                <td><?php echo ++$I; ?></td>
                <td><?php echo $ad['name']; ?></td>
                                <td>
                                    
                                <?php
                              if(!empty($ad['default_value'])){
                              $xd=$ad['default_value'];
                             //  echo "<pre>";
                               
                              
                               
                           //    print_r($xd);
                               
                              $someArray = json_decode($xd, true);
              for($i=0; $i<count($someArray);$i++){
                    echo    "<b>".$someArray[$i]['label'].":</b><br>";
                    echo "<b> Min:</b>";
                     echo  $minv=$someArray[$i]['min-value'];
                    echo $minu=$someArray[$i]['unit'];
                    echo "<br><b> Max:</b>";
                  echo $maxv=$someArray[$i]['max-val'];
                echo $maxu=$someArray[$i]['unit'];
                echo "<br>";
                             
                               }
                             
                               //echo "</pre>";
                              }
                                ?>
                                
                                
                                </td>
                                <td><?php 
                                
                                if($ad['output_id']=="" || $ad['output_id'] =="0"){
                                    
                                    echo "No Association";
                                    
                                }else{
                                    $xy=$this->db->where('output_id',$ad['output_id'])->get('output')->row_array();
                                    echo "<b>Type:</b>".$xy['type']."<br>";
                                    echo "<b>Interface:</b>".$xy['interface']."<br>";
                                    echo "<b>Other info:</b>".$xy['other_dispcription']."<br>";
                                    echo "<b>Pin:</b>".$xy['pin'];
                                    
                                
                                    //print_r($xy);
                               
                                } 
                                
                                
                                
                                ?></td>
                                
                                
                                
                                
                             <td><a href="<?php echo base_url().'admin/viewgraph/'.$ad['sensor_id']; ?>" class="edit_btn" ><span class="badge badge-success">View Graph</span></a>/<a href="<?php echo base_url().'admin/associatinlist/'.$ad['sensor_id']; ?>" class="edit_btn" ><span class="badge badge-success">Asscociate Outpt</span></a>/<a href="<?php echo base_url().'admin/edit_sensor/'.$ad['sensor_id']; ?>" class="edit_btn" ><span class="badge badge-info">Edit</span></a>/<a href="<?php echo base_url().'admin/delete_sensor/'.$ad['sensor_id']; ?>"><span class="badge badge-danger">Delete</span></a></td>
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