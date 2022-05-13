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
        <h2 class="mb-4">Bider List</h2>
        <table class="table table-fluid table-responsive" id="myTable">
        <thead>
        <tr><th>Job Title</th><th>Bid Delivery Time</th><th>Bid Note</th><th>Bid Price</th><th>Bider Email</th><th>Bider Id</th><th>Bider Image</th> <th>Bider Name</th><th>Cat Id</th><th>Cat Name</th><th>Job ID</th><th>Job Note</th><th>Posted By</th></tr>
        </thead>
        <tbody>
        <?php // foreach($bider as $k) {?>
        <tr><td><?php //echo $k['jobTitle']; ?>1:Experience 1.5 Year. 2: Min Projects 5, 3: Education: BS Degree</td><td><?php // echo $k['bidDeliveryTime']; ?>1 Day</td><td><?php // echo $k['bidNote'] ?>BidNote</td><td><?php // echo $k['bidPrice'] ?>15</td><td><?php // echo $k['biderEmail'] ?>"ecp02@yahoo.fr"</td><td><?php // echo $k['biderID']; ?>8y48qM5764Xx82</td><td><?php // echo $k['biderimage'] ?>Null</td><td><?php // echo $k['biderName']; ?>Stanley</td><td><?php // echo $k['catID']; ?>5</td><td><?php //echo $k['catName']; ?>Python Development</td> <td><?php //echo $k['jobID']; ?>16295485</td><td><?php //echo $k['jobNote']; ?>I need a Python Developer</td><td><?php //echo $k['postedBy']; ?>iqmieNpbTCO</td> </tr>
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