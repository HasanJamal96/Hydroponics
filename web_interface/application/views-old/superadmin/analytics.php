<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
        <style>
       .number-font {
           font-size: 1.5rem;
       }

       .bg-market {
        background-image: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%) !important;
        }
       

       .bg-vendors {
        background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;
        }
       
       .bg-org {
        background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%) !important;
        }
       

    </style>
</head>

<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content -->
<div class="main">
    <h1 class="text-center mt-4">Analytics</h1>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="d-flex text-white py-4 px-2 rounded bg-market">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">No Of Admin</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo $no_of_admin; ?></p>
                        </div>
                </div>
                <br><br>
            </div>
            <br><br>
            <div class="col-12 col-md-4">
                <div class="d-flex text-white py-4 px-2 rounded bg-vendors">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">No Of Operator</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo $no_of_opertaor; ?></p>
                        </div>
                </div>
            </div>
            <br><br>
            <div class="col-12 col-md-4" style="">
                <div class="d-flex text-white py-4 px-2 rounded bg-org">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">No Of Locations</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo $no_of_site; ?></p>
                        </div>
                </div>
            </div>
            <br><br>
            <div class="col-12 col-md-4">
                <div class="d-flex text-white py-4 px-2 rounded bg-market">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">Total Sensor</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo $no_of_sensor; ?></p>
                        </div>
                </div>
            </div>

          

        </div>
    </div>
</div>










    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
   
</body>

</html>