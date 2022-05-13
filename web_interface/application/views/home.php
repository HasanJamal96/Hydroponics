<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
</head>

<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content -->
<div class="main">
  
    <div class="containe mb-5">
        <h2 class="mb-4">User's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
        <tr><th>Image</th><th>Name</th><th>UserName</th><th>Email</th><th>Role</th><th>Type</th></tr>
        </thead>
        <tbody>
        <?php foreach($user as $k) {?>
        <tr><td><img src="<?php echo $k['user_image'] ?>" style="height:100px;width:100px"/></td><td><?php echo $k['name']; ?></td><td><?php echo $k['username']; ?></td><td><?php echo $k['email']; ?></td><td><?php echo $k['role']; ?></td><td><?php echo $k['account_type']; ?></td></tr>
        <?php } ?>        
        </tbody>
        </table>
    </div>
    
   


</div>













    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
        </script>

</body>

</html>