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
    <h2 class="mb-4">Add New Output</h2>


<?php include('includes/alert-msgs.php'); ?>        
    <form action="<?php echo base_url().'admin/editoutputdata/'.$id ?>" method="post">

<div class="row my-5">



    <div class="col-12 col-md-8">

        <div class="form-group">
            <label class="label-ls" for="client"> Type :</label>
            <select name="type"  required class="form-control input-ls" >
                <option value="pump" <?php if($adminlist['type']=="pump"){echo 'selected';} ?>>Pump</option>
                <option value="relay" <?php if($adminlist['type']=="relay"){echo 'selected';} ?>>Relay</option>
                
            </select>
      
        </div>
    </div>
    
        <div class="col-12 col-md-8">

        <div class="form-group">
            <label class="label-ls" for="client"> Interface :</label>
            <select name="interface"  required class="form-control input-ls" >
                <option value="I2c" <?php if($adminlist['interface']=="I2c"){echo 'selected';} ?>>I2c</option>
                <option value="Gpio" <?php if($adminlist['interface']=="Gpio"){echo 'selected';} ?>>Gpio</option>
                
            </select>
      
        </div>
    </div>
    
        

     <div class="col-12 col-md-8 ">
        <div class="form-group">
            <label class="label-ls" for="client"> Other Description:</label>
            <input type="text" name="other_dispcription" required class="form-control input-ls" value="<?php echo $adminlist['other_dispcription']; ?>"   placeholder="write here">
        
        </div>
        </div>
        
             <div class="col-12 col-md-8 ">
        <div class="form-group">
            <label class="label-ls" for="client"> pin/address:</label>
            <input type="text" name="pin" required class="form-control input-ls" value="<?php echo $adminlist['pin']; ?>"    placeholder="write here">
        
        </div>
        </div>
        
        
    <div class="col-12 col-md-12 d-flex justify-content-end">
        <button class="btn btn-success" type="submit">Update </button>
                  
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