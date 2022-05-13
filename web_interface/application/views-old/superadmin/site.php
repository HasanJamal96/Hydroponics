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
                    <a href="<?php echo base_url().'superadmin/addsite' ?>" class="btn btn-info">
                    Add New Location
                    </a>
                </div>
    <div class="containe mb-5">
        <h2 class="mb-4">Location List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>$</th><th>Name</th><th>Date/time</th> <th>Edit</th> </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            foreach($site as $s) {
            //print_r($s)
            
            ?>
            <tr>
            <td><?php echo $i++; ?></td> 
            <td><?php echo $s['title']; ?></td>
            <td><?php echo $s['created_at']; ?></td>
            <td>
            <a class="btn btn-info" href="<?php echo base_url().'superadmin/editsite/'.$s['site_id'] ?>">Edit</a>
            <a class="btn btn-danger" href="<?php echo base_url().'superadmin/deletesite/'.$s['site_id'] ?>">
            Delete
            </a>
            </td>   
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