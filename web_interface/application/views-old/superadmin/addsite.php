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
        <br>
    <h2 class="mb-4">Add New Location</h2>


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'superadmin/addsitedata' ?>" method="post">

<div class="row my-5">



    <div class="col-12 col-md-8">
        <div class="form-group">
            <label class="label-ls" for="client">Name:</label>
            <input type="text" name="title" required class="form-control input-ls" required  placeholder="write here">
        </div>
    </div>
    <div class="col-12 col-md-12 d-flex justify-content-end">
        <button class="btn btn-success" type="submit">Save Location</button>
                  
    </div>

</div>
</form>

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