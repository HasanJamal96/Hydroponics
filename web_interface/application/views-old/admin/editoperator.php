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
    <h2 class="mb-4">Edit Operator</h2>


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'admin/editoperatordata/'.$id ?>" method="post">

<div class="row my-5">

<?php 
// echo "<pre>";
// print_r($adminlist);
// echo "</pre>";

?>

    <div class="col-12 col-md-8">
        <div class="form-group">
            <label class="label-ls" for="client">Name:</label>
            <input type="text" name="username" required value="<?php echo  $adminlist['username']; ?>" class="form-control input-ls" required  placeholder="write here">
        </div>
        <div class="form-group">
            <label class="label-ls" for="client">Email:</label>
            <input type="email" name="email" required class="form-control input-ls" value="<?php echo  $adminlist['email']; ?>" required  placeholder="write here">
        </div>
        <div class="form-group">
            <label class="label-ls" for="client">Password:</label>
            <input type="password" name="password"  class="form-control input-ls"   placeholder="write here">
        </div>

    </div>
    <div class="col-12 col-md-12 d-flex justify-content-end">
        <button class="btn btn-success" type="submit">Save Operator</button>
                  
    </div>

</div>
</form>

    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
</body>

</html>