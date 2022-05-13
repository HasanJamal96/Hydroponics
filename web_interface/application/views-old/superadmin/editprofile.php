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
    <h2 class="mb-4">Edit Profile</h2>
    <?php 
    // echo "<pre>";
    // print_r($this->session->userdata());
    // echo "</pre>";
    
    
    ;?>


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'superadmin/editprofiledata/' ?>" enctype="multipart/form-data" method="post">

<div class="row my-5">



    <div class="col-12 col-md-8">
        <div class="form-group">
            <label class="label-ls" for="client">Username:</label>
            <input type="text" name="name" value="<?php echo $this->session->userdata('name'); ?>" required class="form-control input-ls" required  placeholder="write here">
            
        </div>
    </div>
    
    <div class="col-12 col-md-8">
        <div class="form-group">
            <label class="label-ls" for="client">Profile Picture:</label>
            <input type="file" name="userfile"   class="form-control input-ls"   placeholder="write here">
            
        </div>
    </div>
    <div class="col-12 col-md-12 d-flex justify-content-end">
        <button class="btn btn-success" type="submit">Update Profile</button>
                  
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