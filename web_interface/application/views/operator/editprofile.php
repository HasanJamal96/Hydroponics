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
    <form action="<?php echo base_url().'Operator/editoproifledata/'.$id ?>" enctype="multipart/form-data"  method="post">

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
            <label class="label-ls" for="client">Password:(Fill if You Want Change)</label>
            <input type="password" name="password"  class="form-control input-ls"   placeholder="write here">
        </div>
        <div class="form-group">
                          <label for="field-1" class=" label-ls">Photo</label>
                          
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                  <?php if($adminlist['profile_photo']!=""){ ?>
                                  <img src="<?php  echo $adminlist['profile_photo'] ?>" alt="...">
                                  <?php }else{?>
                                    <img src="<?php echo base_url() . 'assets/'; ?>images/25.png" alt="...">
                                  <?php } ?>
                                    </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 6px;"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new">Select image</span>
                                          <span class="fileinput-exists">Change</span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                  </div>
                              </div>
                          </div>
                      </div>

    </div>
    <div class="col-12 col-md-12 d-flex justify-content-end">
        <button class="btn btn-success" type="submit">Save Changes</button>
                  
    </div>

</div>
</form>

    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
</body>

</html>