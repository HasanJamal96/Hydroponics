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


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'admin/updatesensordata/'.$id ?>" method="post">

    <div class="row my-5">

        <div class="col-12 col-md-8">
            <div class="form-group mb-4">
                <label class="label-ls" for="client">Name:</label>
                <input type="text" name="name" value="<?php echo $adminlist['name']; ?>" required class="form-control input-ls" required  placeholder="write here">
            </div>
   <div class="form-group mb-4">
                <label class="label-ls" for="client">Type:</label>
                <select name="sensor_type" class="form-control input-ls">
                    <option <?php if($adminlist['sensor_type']=="i2c"){echo 'selected';}?>  value="i2c">I2c</option>
                    <option <?php if($adminlist['sensor_type']=="gpio"){echo 'selected';}?> value="gpio">gpio</option>
                    
                </select>
            
            
            </div>
            
            
            <div class="form-group mb-4">
                <label class="label-ls" for="client">I2c/gpio Description:</label>
                <input type="text" value="<?php echo $adminlist['sensor_type_description']; ?>" name="sensor_type_description" required class="form-control input-ls" required  placeholder="write here">
            </div>
            



            <?php 
            $minv="0";
            $minu="";
            $maxv="0";
            $maxu="";
            
            /**
             if(!empty($adminlist['default_value'])){
            $xd=$adminlist['default_value'];
              $someArray = json_decode($xd, true);
                  $minv=$someArray[0]['min-value'];
                $minu=$someArray[0]['unit'];
                  $maxv=$someArray[1]['max-val'];
                $maxu=$someArray[1]['unit'];
             } 
             */
            ?>
            



      <div id="newRow">
          
                       <?php if(!empty($adminlist['default_value'])){ 

$innervalue=array();
$xd=$adminlist['default_value'];
              $someArray = json_decode($xd, true);
              for($i=0; $i<count($someArray);$i++){
                  $innervalue[$i]=$i;
                  $minv=$someArray[$i]['min-value'];
                $minu=$someArray[$i]['unit'];
                  $maxv=$someArray[$i]['max-val'];
                $maxu=$someArray[$i]['unit'];
                $label=$someArray[$i]['label'];
                       
                       ?>
          
          
          
          <div id="inputFormRow"><hr>
          <label for="inputPassword4">Label:</label>
          <div class="input-group mb-3">
              <input type="text" required="" name="label<?php echo $i; ?>" class="form-control m-input" value="<?php echo $label; ?>" placeholder="Enter title" autocomplete="off">
              <div class="input-group-append">
                  <button id="removeRow" data-id="<?php echo $i; ?>" type="button" class="btn btn-danger">
                      Remove</button></div></div>
                      <div class="form-row">
                          <div class="form-group col-md-6"><label for="inputPassword4">Min Value</label>
                          <input type="number" min="0" name="minvalue<?php echo $i; ?>" value="<?php echo $minv; ?>"
                          class="form-control" required="" id="inputEmail4" placeholder="Default value 1">
                          
                          </div>
                          <div class="form-group col-md-6"><label for="inputPassword4">Unit</label>
                          <input type="text" name="minunit<?php echo $i; ?>" class="form-control" required="" value="<?php echo $minu; ?>" id="inputPassword4" placeholder="Unit">
                          </div></div><div class="form-row">
                              <div class="form-group col-md-6">
                              <label for="inputPassword4">Max Value</label> 
                              <input type="number" min="0" name="maxvalue<?php echo $i; ?>" value="<?php echo $maxv; ?>" class="form-control" required="" id="inputEmail4" 
                              placeholder="Default value 1">
                              
                              </div><div class="form-group col-md-6">
                                  <label for="inputPassword4">Unit</label>
                                  <input type="text" name="maxunit<?php echo $i; ?>" class="form-control" required="" value="<?php echo $maxu; ?>" id="inputPassword4" placeholder="Unit"></div></div></div>
          
          <?php } ?>
          
          <input type="hidden" id="countvalue" name="total_count" value="<?php echo count($someArray); ?>"/>
<input type="hidden" id="selectedv" name="selectedv" value="<?php echo implode(",",$innervalue); ?>"/>

          
          
          
          
          
          <?php } ?>
          
          
          
          
          
          
          
          
          
      </div>
      
      
      
      




























<!--
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Min Value</label>
                    <input type="number" min="0" name="minvalue"  class="form-control" required  value="<?php echo $minv; ?>" id="inputEmail4" placeholder="Default value 1">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Unit</label>
                    <input type="text" name="minunit"  class="form-control" required id="inputPassword4" value="<?php echo $minu; ?>" placeholder="Unit">
                </div>
            </div>
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Max Value</label>
                    <input type="number" min="0" name="maxvalue" class="form-control" required id="inputEmail4" value="<?php echo $maxv; ?>" placeholder="Default value 1">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Unit</label>
                    <input type="text" name="maxunit" value="<?php echo $maxu; ?>" class="form-control" required id="inputPassword4" placeholder="Unit">
                </div>
            </div>

    -->        
            <!-- <div class="form-group row ">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-info float-right">Add More Values</button>
                </div>
            </div> -->


        </div>
        <div class="col-12 col-md-12 d-flex justify-content-end">
            <button class="btn btn-info" id="addRow"  type="button">Add More Sensor Default Value</button>
            <button class="btn btn-success" id="button_check" type="submit">Save Sensor</button>
        </div>

    </div>
    </form>

    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    <script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var old_value=$("#countvalue").val();
        var new_value=parseInt(old_value)+1;
         $("#countvalue").val(new_value);
         $("#selectedv").val($("#selectedv").val() + "," + new_value);
            
        
        var html = '';
         
        html += '<div id="inputFormRow">';
    html += '<hr>';
        //html += '<div class="form-group mb-4"><label class="label-ls">Label:</label><input type="text" name="label0" required class="form-control input-ls" required  placeholder="write here"></div>';
        html+='<label for="inputPassword4">Label:</label>';        
        html += '<div class="input-group mb-3">';
        html += '<input type="text" required name="label'+ new_value +'" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" data-id="'+new_value+'" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';
        html += '<div class="form-row"><div class="form-group col-md-6"><label for="inputPassword4">Min Value</label> <input type="number" min="0" name="minvalue'+new_value+'"  class="form-control" required id="inputEmail4" placeholder="Default value 1"></div>';
        html += '<div class="form-group col-md-6"><label for="inputPassword4">Unit</label><input type="text" name="minunit'+new_value+'"  class="form-control" required id="inputPassword4" placeholder="Unit"></div></div>';
     html += '<div class="form-row"><div class="form-group col-md-6"><label for="inputPassword4">Max Value</label> <input type="number" min="0" name="maxvalue'+new_value+'"  class="form-control" required id="inputEmail4" placeholder="Default value 1"></div>';
        html += '<div class="form-group col-md-6"><label for="inputPassword4">Unit</label><input type="text" name="maxunit'+new_value+'"  class="form-control" required id="inputPassword4" placeholder="Unit"></div></div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
       // alert();
      var newvar= "," + $(this).attr("data-id");
        $("#selectedv").val($("#selectedv").val().replace(newvar,''));
         var old_value=$("#countvalue").val();
        var new_value=parseInt(old_value)-1;
        if(new_value ==0){
            $("#button_check").attr("disabled", true);
        } 
         
        $("#countvalue").val(new_value);
        
        
        $(this).closest('#inputFormRow').remove();
    
        
        
    });
</script>    
</body>

</html>