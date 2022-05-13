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
        <h2 class="mb-4">Offers List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
        <tr><th>Title</th> <th>Budget</th><th>Delivery Time</th><th>Description</th><th>gigID</th><th>JobID</th> <th>Job Posted By</th><th>Note</th> <th>OfferedBy</th><th>Status</th></tr>
        </thead>
        <tbody>
        <?php // foreach($offer as $k) {?>
        <tr><td><?php // echo $k['title']; ?>I need a Python Developer</td><td><?php // echo $k['Budget'] ?>500</td><td><?php // echo $k['deliverdat']; ?>6 Days</td><td><?php // echo $k['Description'] ?>Description is required</td><td><?php // echo $k['JobID']; ?>185845784</td><td><?php // echo $k['jobPostedBy']; ?>iqmieN</td><td><?php // echo $k['jobPostedBy']; ?>iqmieNpbTCOrgsY</td><td><?php //echo $k['note']; ?>Release note is required</td> <td><?php // echo$k['offeredBy']; ?>2gGZ6</td><td><?php // echo $k['status']; ?>pending</td> </tr>

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