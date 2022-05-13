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
                     Add New Site
                    </a>
                </div>
    <div class="containe mb-5">
        <h2 class="mb-4">Site's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>Title</th><th>Date/time</th> <th>Edit</th> </tr>
        </thead>
        <tbody>
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