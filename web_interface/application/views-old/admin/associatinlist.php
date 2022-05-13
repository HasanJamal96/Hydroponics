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
    <h2 class="mb-4">Edit Sensor</h2>

<?php $y=$this->db->get('output')->result_array();

// print_r($y);
// print_r($adminlist);

?>

<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'admin/updatesensordatawithout/'.$id ?>" method="post">

    <div class="row my-5">

              <div class="col-12 col-md-8">
   <div class="form-group mb-4">
                <label class="label-ls" for="client">Output Id:</label>
                <select name="output_id"  class="form-control input-ls">
                    <option value="">No Association</option>
                  <?php foreach($y as $x){ ?>
                    <option <?php if($adminlist['output_id']==$x['output_id']){echo 'selected';}?>  value="<?php echo $x['output_id'] ;?>"><?php echo $x['output_id'] ;?></option>
                    <?php } ?>
                    
                </select>
            
            
            </div>
            </div>
            
        <div class="col-12 col-md-12 d-flex justify-content-end">

            <button class="btn btn-success" id="button_check" type="submit">Associate output with Sensor</button>
        </div>

    </div>
    </form>

    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
</body>

</html>