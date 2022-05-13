<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
   
</head>

<body>


<!-- Content -->
<div class="main">

<div class="container">
            <div class="row align-items-center" style="height: 100vh;">
                <div class="col-12 col-sm-6">
                    <div class="share-div">
                        <img src="<?php echo base_url() . 'assets/'; ?>images/35.png" class="img-fluid d-none mt-5 mb-4" alt="">
                        <h1>Hydrophonic System</h1>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="main-login bg-white rounded p-4">
                    <?php if($this->session->flashdata('error_flash_message') !=""){ ?>
                            <div class="alert alert-danger" role="alert">
  Error . Invalid credientals.
</div>
<?php } ?>
          <?php if($this->session->flashdata('flash_message') !=""){ ?>
                            <div class="alert alert-success" role="alert">
 Email has been Sent in Your Account
</div>
<?php } ?>

                        <form action="<?php echo base_url() . 'site/processforget'; ?>" method="post">
                        <input type="email" name="email" required class="form-control my-form-control" placeholder="Email">
                           
                            <a class="text-white">
                                <button type="submit" class="btn btn-block my-btn">Submit</button>
                            </a>
                            
                            <br>
                            <a href="<?php echo base_url().'site/' ?>">Log In</a>

                        </form>
                    </div>
                </div>
            </div>
    </div>


</div>
















    <?php include('includes/bottom_links.php'); ?>
    

</body>

</html>