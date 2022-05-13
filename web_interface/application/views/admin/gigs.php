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
        <h2 class="mb-4">Gigs List</h2>
        <table class="table table-fluid table-responsive" id="myTable">
        <thead>
        <tr><th>Title</th><th>Attachment</th><th>CatID</th><th>Delivery Time:</th><th>Description</th><th>First Image:</th><th>Gig Posted By</th><th>Price</th><th>Revisions</th><th>Second Image</th><th>Tags</th><th>thirdImage</th></tr>
        </thead>
        <tbody>
        <?php // foreach($user as $k) {?>
        <tr><td><?php // echo $k['title']; ?>I will make App for You</td><td><?php // echo $k['bidNote'] ?>Null</td><td><?php // echo $k['bidPrice'] ?>2</td><td><?php // echo $k['biderEmail'] ?>1 Day</td><td><?php // echo $k['biderID']; ?>Description is required</td><td><?php // echo $k['biderimage'] ?>Null</td><td><?php // echo $k['biderName']; ?>2gGZ6e2P6</td><td><?php // echo $k['catID']; ?>500</td><td><?php //echo $k['catName']; ?>1</td> <td><?php //echo $k['jobID']; ?>Null</td><td><?php //echo $k['jobNote']; ?>Android, Android Developer, Android Development</td><td><?php //echo $k['jobTitle']; ?>Null</td> </tr>
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