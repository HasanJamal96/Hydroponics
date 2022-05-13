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
        <h2 class="mb-4">Seller's Review List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
        <tr><th>Comment</th><th>Rating</th><th>Reviewed At</th><th>Reviewed By</th></tr>
        </thead>
        <tbody>
        <?php // foreach($user as $k) {?>
        <tr><td><?php // echo $k['comment']; ?>Best seller in the world</td><td><?php // echo $k['rating'] ?>5.0</td><td><?php // echo $k['reviewedAt'] ?>1629732</td><td><?php // echo $k['reviewedBy'] ?>iqmieNpbTCOrg</td></tr>
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