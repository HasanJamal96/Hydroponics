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
    <h2 class="mb-4">Edit Admin</h2>


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'superadmin/editadmindata/'.$id ?>" method="post">

<div class="row my-5">

<?php 

$adminsielist=array();
foreach($adminsite as $as){
    array_push($adminsielist,$as['site_id']);
    
}



?>

    <div class="col-12 col-md-8">
        <div class="form-group">
            <label class="label-ls" for="client">Name:</label>
            <input type="text" name="username" required value="<?php echo  $adminlist['username']; ?>" class="form-control input-ls" required  placeholder="write here">
        </div>
        
         <div class="form-group">
            <label class="label-ls" for="client">Assign Site:</label>
            <select name="site_id[]" required class="form-control input-ls" required multiple >
                
                <?php foreach($site as $s){?>
                 <option <?php  if (in_array($s['site_id'], $adminsielist)) {echo "selected";} ?>

  value="<?php echo $s['site_id']; ?>"><?php echo $s['title']; ?></option>   


             <?php   } ?>
                </select>
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
        <button class="btn btn-success" type="submit">Update Admin</button>
                  
    </div>

</div>
</form>

    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
</body>

</html>