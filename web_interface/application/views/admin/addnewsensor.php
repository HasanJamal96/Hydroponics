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
    <h2 class="mb-4">Add New Sensor</h2>


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'admin/addsensordata' ?>" method="post">

    <div class="row my-5">

        <div class="col-12 col-md-8">
            <div class="form-group mb-4">
                <label class="label-ls" for="client">Name:</label>
                <input type="text" name="name" required class="form-control input-ls" required  placeholder="write here">
            </div>
            
            <div class="form-group mb-4">
                <label class="label-ls" for="client">Type:</label>
                <select name="sensor_type" class="form-control input-ls">
                    <option value="i2c">I2c</option>
                    <option value="gpio">gpio</option>
                    
                </select>
            
            
            </div>
            
            
            <div class="form-group mb-4">
                <label class="label-ls" for="client">I2c/gpio Description:</label>
                <input type="text" name="sensor_type_description" required class="form-control input-ls" required  placeholder="write here">
            </div>
            
            
<input type="hidden" id="countvalue" name="total_count" value="0"/>
<input type="hidden" id="selectedv" name="selectedv" value="0"/>

            <div class="dropdown-divider"></div>
            <h4>Trigger Value</h4>
        <div class="dropdown-divider"></div>

            <div class="main_div">
               <div class="form-group mb-4">
                <label class="label-ls" for="client">Label:</label>
                <input type="text" name="label0" required class="form-control input-ls" required  placeholder="write here">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Min Value</label>
                    <input type="number" min="0" name="minvalue0"  class="form-control" required id="inputEmail4" placeholder="Default value 1">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Unit</label>
                    <input type="text" name="minunit0"  class="form-control" required id="inputPassword4" placeholder="Unit">
                </div>
            </div>
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Max Value</label>
                    <input type="number" min="0" name="maxvalue0" class="form-control" required id="inputEmail4" placeholder="Default value 1">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Unit</label>
                    <input type="text" name="maxunit0" class="form-control" required id="inputPassword4" placeholder="Unit">
                </div>
            </div>       
                
            </div>
             <div id="newRow"></div>

         

            
            <!-- <div class="form-group row ">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-info float-right">Add More Values</button>
                </div>
            </div> -->


        </div>
        <div class="col-12 col-md-12 d-flex justify-content-end">
               <button class="btn btn-info" id="addRow" type="button">Add More Sensor Default Value</button>
            <button class="btn btn-success" type="submit">Save Sensor</button>
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
         $("#countvalue").val(new_value);
        
        
        $(this).closest('#inputFormRow').remove();
    
        
        
    });
</script>    
</body>

</html>