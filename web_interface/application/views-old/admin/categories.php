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
        <h2 class="mb-4">Categories List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
        <tr><th>Category ID</th><th>Icon</th><th>Name</th></tr>
        </thead>
        <tbody>
        <?php // foreach($category as $k) {?>
        <tr><td><?php // echo $k['imageUrl'] ;?>1</td><td><i class="fa fa-code"></i> <?php // echo $k['icon']; ?></td><td><?php // echo $k['name']; ?>Web Development </td> </tr>
         <tr><td><?php // echo $k['imageUrl'] ;?>2</td><td><i class="fa fa-android"></i> <?php // echo $k['icon']; ?></td><td><?php // echo $k['name']; ?>Android Development</td> </tr>
          <tr><td><?php // echo $k['imageUrl'] ;?>3</td><td><i class="fa fa-viacoin"></i> <?php // echo $k['icon']; ?></td><td><?php // echo $k['name']; ?>PHP Development </td> </tr>
        <?php // } ?>        
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