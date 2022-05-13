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
                    <a href="<?php echo base_url().'admin/addnewoutput' ?>" class="btn btn-info">
                     Add New Output
                    </a>
                </div>
    <div class="containe mb-5">
        <h2 class="mb-4">output's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>Output id</th><th>type</th><th>interface</th> <th>Other Description</th> <th>pin/address</th> <th>Action</th></tr>
        </thead>
        <tbody>
        <?php 
        $adminlist=$this->db->get('output')->result_array();
        $i=0;
        foreach($adminlist as $ad){ ?>
            <tr>
                <td><?php echo $ad['output_id']; ?></td>
                <td><?php echo $ad['type']; ?></td>
                <td><?php echo $ad['interface']; ?></td>
                <td><?php echo $ad['other_dispcription']; ?></td>
                <td><?php echo $ad['pin']; ?></td>
                <td><a href="<?php echo base_url().'admin/editoutput/'.$ad['output_id']; ?>">Edit</a>/<a href="<?php echo base_url().'admin/deleteoutput/'.$ad['output_id']; ?>">Delete</a></td>
                
                
                </tr>
            <?php } 
    
            
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