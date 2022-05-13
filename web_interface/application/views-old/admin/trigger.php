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
                    <a href="<?php echo base_url().'admin/addnewtrigger' ?>" class="btn btn-info">
                     Add New Trigger
                    </a>
                </div>
    <div class="containe mb-5">
        <h2 class="mb-4">output's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>#</th><th>Title</th><th>Status</th> <th>Action</th> </tr>
        </thead>
        <tbody>
        <?php 
        /*
        $i=0;
        foreach($adminlist as $ad){ ?>
            <tr>
                <td><?php echo ++$i; ?></td>
                <td><?php echo $ad['cam_name']; ?></td>
                <td>
                    <?php if($ad['status']=="1"){ ?>
                    <a href="<?php echo base_url().'admin/camtatsus/'.$ad['camera_id'].'/0' ?>" class="btn btn-success">
                     Deactive
                    </a>
                    <?php }else{ ?>
                            <a href="<?php echo base_url().'admin/camtatsus/'.$ad['camera_id'].'/1' ?>" class="btn btn-danger">
                     Active
                    </a>
                    <?php } ?>
                    
                    </td>
                <td>
                    <!--
                    <a href="<?php echo base_url().'admin/camconfigration/'.$ad['camera_id'].'/1' ?>">View/Configration</a>
                    -->
                    
                    <?php
                    //echo $ad['mode'];
                    
                    if($ad['mode']=="stop"){ ?>
                    <a href="<?php echo base_url().'admin/setstrat/'.$ad['camera_id'].'/1' ?>">Start</a>
                    <?php } else{?>
                        <a href="<?php echo base_url().'admin/setstrat/'.$ad['camera_id'].'/0' ?>">Stop</a>
                    <?php } ?>
                    /<a href="<?php echo base_url().'admin/viewcam/'.$ad['camera_id'].'' ?>">View</a>
                                        /<a href="<?php echo base_url().'admin/editcam/'.$ad['camera_id'].'' ?>">Edit</a>
                    /<a href="<?php echo base_url().'admin/camtatsus'.$ad['camera_id'].'/1' ?>">Delete</a></td>
            </tr>
            <?php } 
            */
            
            ?>
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