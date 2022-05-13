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
        <div class="row d-none">
            <div class="col-12 col-md-4 d-none">
                <div class="d-flex text-white py-4 px-2 rounded bg-market">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">No Of Admin</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo count($listadmin); ?></p>
                        </div>
                </div>
                <br><br>
            </div>
            <br><br>
            <div class="col-12 col-md-4 d-none">
                <div class="d-flex text-white py-4 px-2 rounded bg-vendors">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">No Of Operator</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo count($listopertaor)
                            ; ?></p>
                        </div>
                </div>
            </div>
            <br><br>
            <div class="col-12 col-md-4 d-none" style="">
                <div class="d-flex text-white py-4 px-2 rounded bg-org">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">No Of Locations</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo count($listsite); ?></p>
                        </div>
                </div>
            </div>
            <br><br>
            <div class="col-12 col-md-4 d-none">
                <div class="d-flex text-white py-4 px-2 rounded bg-market">
                        <div class="left-div">
                            <p class="mb-0 font-weight-bolder">Total Sensor</p>
                        </div>

                        <div class="ml-auto">
                            <p class="mb-0 number-font font-weight-bolder"><?php echo count($listsensor); ?></p>
                        </div>
                </div>
            </div>

      
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
            foreach($listsite as $s) {
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

<!---list of admin-->
<div class="containe mb-5">
        <h2 class="mb-4">Admin's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>Name</th><th>Email</th> <th>Site Name</th> <th>Action</th> </tr>
        </thead>
        <tbody>
        <?php foreach($listadmin as $ad){ ?>
            <tr>
                <td><?php echo $ad['username']; ?></td>
                <td><?php echo $ad['email']; ?></td>
                <td>
                <?php 
                 $sitlist=$this->db->where('user_id',$ad['id'])->get('adminsite')->result_array();
                 foreach($sitlist as $sl){
                   echo   $this->db->where('site_id',$sl['site_id'])->get('site')->row()->title.'<br>';


                 }
                ?>


                </td>
                               <td><a href="<?php echo base_url().'superadmin/editadmin/'.$ad['id']; ?>">Edit</a>/<a href="<?php echo base_url().'superadmin/deleteadmin/'.$ad['id']; ?>">Delete</a></td>
            </tr>
            <?php } ?>
    </tbody>
        </table>
    </div>

<!---list of operator list-->
<div class="containe mb-5">
        <h2 class="mb-4">Operator's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>Name</th><th>Email</th> </tr>
        </thead>
        <tbody>
        <?php foreach($listopertaor as $ad){ ?>
            <tr>
                <td><?php echo $ad['username']; ?></td>
                <td><?php echo $ad['email']; ?></td>
               
               
            </tr>
            <?php } ?>
    </tbody>
        </table>
    </div>


    <!---sensor list-->
    <div class="containe mb-5">
        <h2 class="mb-4">Sensor's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>#</th><th>Sensor Name</th> <th>Sensor Default Value</th><th>Association output</th>   </tr>
        </thead>
        <tbody>
        <?php 
        $I=0;
        foreach($listsensor as $ad){ 
        // echo "<pre>";
        // print_r($ad);
        // echo "</pre>";
        
        ?>
            <tr>
                <td><?php echo ++$I; ?></td>
                <td><?php echo $ad['name']; ?></td>
                                <td>
                                    
                                <?php
                              if(!empty($ad['default_value'])){
                              $xd=$ad['default_value'];
                             //  echo "<pre>";
                               
                              
                               
                           //    print_r($xd);
                               
                              $someArray = json_decode($xd, true);
              for($i=0; $i<count($someArray);$i++){
                    echo    "<b>".$someArray[$i]['label'].":</b><br>";
                    echo "<b> Min:</b>";
                     echo  $minv=$someArray[$i]['min-value'];
                    echo $minu=$someArray[$i]['unit'];
                    echo "<br><b> Max:</b>";
                  echo $maxv=$someArray[$i]['max-val'];
                echo $maxu=$someArray[$i]['unit'];
                echo "<br>";
                             
                               }
                             
                               //echo "</pre>";
                              }
                                ?>
                                
                                
                                </td>
                                <td><?php 
                                
                                if($ad['output_id']=="" || $ad['output_id'] =="0"){
                                    
                                    echo "No Association";
                                    
                                }else{
                                    $xy=$this->db->where('output_id',$ad['output_id'])->get('output')->row_array();
                                    echo "<b>Type:</b>".$xy['type']."<br>";
                                    echo "<b>Interface:</b>".$xy['interface']."<br>";
                                    echo "<b>Other info:</b>".$xy['other_dispcription']."<br>";
                                    echo "<b>Pin:</b>".$xy['pin'];
                                    
                                
                                    //print_r($xy);
                               
                                } 
                                
                                
                                
                                ?></td>
                                
                                
                                
                                
                
            </tr>
            <?php } ?>
    </tbody>
        </table>
    </div>
    
   


    
    
    
    
    </div>
</div>










    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
   
</body>

</html>