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
    <h2 class="mb-4">Add New Camera</h2>


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'admin/addcamdata' ?>" method="post">

<div class="row my-5">



    <div class="col-12 col-md-8">
        <div class="form-group">
            <label class="label-ls" for="client"> Cam Name:</label>
            <input type="text" name="cam_name" required class="form-control input-ls" required  placeholder="write here">
        </div>
        
    </div>
        <div class="col-12 col-md-8 d-none">
        <div class="form-group">
            <label class="label-ls" for="client"> Cam Type:</label>
            
            <input type="hidden" name="camtype" value="both"/>
        </div>
        
    </div>
    
        <div class="col-12 col-md-8 timelase">
        <div class="form-group">
            <label class="label-ls" for="client">Timelapes Picture per day/hour:</label>
            <input type="number" name="picperhour" required class="form-control input-ls" value="20" required  placeholder="write here">
            <input type="hidden" name="timelasestatus" required class="form-control input-ls" required value="stop">
        </div>
        </div>
     <div class="col-12 col-md-8 ">
        <div class="form-group">
            <label class="label-ls" for="client"> LiveStream Key:</label>
            <input type="text" name="livecamkey" required class="form-control input-ls" value=""   placeholder="write here">
        
        </div>
        </div>
                <div class="col-12 col-md-8 ">
        <div class="form-group">
            <label class="label-ls" for="client"> Resolution:</label>
            <input type="text" name="livecamresolation" required class="form-control input-ls" value="1280x720" required  placeholder="write here">
            <input type="hidden" name="livecamstatus" required class="form-control input-ls" required value="stop">
        </div>
        </div>
          <div class="col-12 col-md-8 ">
        <div class="form-group">
            <label class="label-ls" for="client"> Rotation :</label>
            <select name="rotation"  required class="form-control input-ls" >
                <option value="0">0</option>
                <option value="90">90</option>
                <option value="180">180</option>
                <option value="270">270</option>
                
            </select>
      
        </div>
        
    </div>
     <div class="col-12 col-md-8 ">
        <div class="form-group">
            <label class="label-ls" for="client"> FPS:</label>
            <input type="text" name="livecamfps" required class="form-control input-ls"    placeholder="write here">
        
        </div>
        </div>
    <div class="col-12 col-md-12 d-flex justify-content-end">
        <button class="btn btn-success" type="submit">Save Camera</button>
                  
    </div>

</div>
</form>

    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
    
    <script>
        $(function(){
       $(".livecam").hide();
 $("#camtype").change(function(){
     var status = this.value;
     
   if(status=="livestream"){
       $(".livecam").show();
       $(".timelase").hide();
   }else{
       $(".livecam").hide();
       $(".timelase").show();
   }
        
  });

});
    </script>
    
    
    
    
    
    
    
</body>

</html>