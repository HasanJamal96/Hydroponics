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


    <div class="row my-5">

        <div class="col-12 col-md-8">
            <div class="form-group mb-4">
                <label class="label-ls" for="client">Mode:</label>
                <select name="name" id="mode" required class="form-control input-ls">
                    <option value="">Please Select Mode</option>
                    <option value="live">Live</option>
                        <option value="Timelapse">Time-lapse </option>
                    </select>
                    
                
                
            </div>


            <div class="dropdown-divider"></div>



            <div class="form-row" id="timediv" >
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Start Date Time</label>
                    <input type="datetime-local"  class="form-control" required id="startdate" placeholder="Please Start Date/Time">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">End Date Time</label>
                    <input type="datetime-local"  class="form-control" required id="enddate" placeholder="Please Emd Date/Time">
                </div>
            </div>
            
            
            


            
            <!-- <div class="form-group row ">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-info float-right">Add More Values</button>
                </div>
            </div> -->


        </div>
        
        <div class="col-12 col-md-12 d-flex justify-content-end">
        <h3>Video Status:<b><span id="video_status"></span></b></h3>
    
        <button class="btn btn-success" id="submit">Start</button>
         <button class="btn btn-danger" style="display:none;" id="stop">Stop</button>
        </div>

    </div>


    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
<script type="text/javascript">
    // add row
    $("#timediv").hide();
        $("#stop").click(function () {
         var formData = {
      mode: '',
      startdate: "",
      enddate: "",
      type:"3",
      cam_id:'<?php echo $id; ?>',
    };

    $.ajax({
      type: "POST",
      url: "<?php echo base_url().'admin/stopcam' ?>",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
      console.log(data.sucess);
      if(data.sucess==1){
          $("#video_status").text("");
          $("#submit").show();
          $("#stop").hide();
      }
      
      
    });
        
            
        });
    
    //
    
    $("#submit").click(function () {
    
    if($("#mode").val() == ""){
        alert("Please Select Mode.");
    }else if($("#mode").val() =="Timelapse" && ($("#startdate").val() =="" || $("#enddate").val() =="" )){
        alert("PLease Select All Fields.")
        
    }else{
        
    if($("#mode").val()=="live"){
         var formData = {
      mode: $("#mode").val(),
      startdate: "",
      enddate: "",
      type:"1",
      cam_id:'<?php echo $id; ?>',
    };

    $.ajax({
      type: "POST",
      url: "<?php echo base_url().'admin/startcam' ?>",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
      console.log(data.sucess);
      if(data.sucess==1){
          $("#video_status").text("Live Mode is On");
          $("#submit").hide();
          $("#stop").show();
      }
      
      
    });
        
    }else if($("#mode").val()=="Timelapse"){
        var formData = {
      mode: $("#mode").val(),
      startdate: $("#startdate").val(),
      enddate: $("#enddate").val(),
      type:'2',
      cam_id:'<?php echo $id; ?>',
    };

    $.ajax({
      type: "POST",
      url: "<?php echo base_url().'admin/startcam' ?>",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
            console.log(data.sucess);
    if(data.sucess==1){
          $("#video_status").text("Time Elepsed Mode is On");
            $("#submit").hide();
          $("#stop").show();
      }
        
    });
        
    }else{
        
    }
    
    
    
    }
    
    
    
    

        
    
        

        
        
    });

$( "#mode" ).change(function() {
 var mode=$(this).val(); 

if(mode == "live"){
    $("#timediv").hide();
}
else if(mode == "Timelapse"){
    $("#timediv").show();
}else{
    console.log(mode);
    $("#timediv").hide();
}
console.log(mode);

    
});

    // remove row
  
</script>    
</body>

</html>