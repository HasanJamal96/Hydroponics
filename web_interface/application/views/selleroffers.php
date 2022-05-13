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
        <h2 class="mb-4">Seller's Offers List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>Title</th> <th>Budget</th><th>Delivery Time</th><th>Description</th><th>gigID</th><th>JobID</th> <th>Job Posted By</th><th>Note</th> <th>OfferedBy</th><th>Status</th></tr>
        </thead>
        <tbody>
        <?php // foreach($offer as $k) {?>
        <tr><td> <?php //  echo $k['title']; ?>I will make App for You</td><td> <?php // echo $k['budget']; ?>500</td><td><?php // echo $k['deliveryTime']; ?>6 Days</td><td><?php // echo $k['description']; ?>Description is required </td><td><?php // echo $k['gigID']; ?>1629197105837 </td><td><?php // echo $k['offeredBy']; ?>1629548522416 </td><td>iqmieNpbTCOrgsYj6NH14Jag6fJ3</td> <td>Release note is required</td><td>2gGZ6e2P6KSdOwjGi6t4bRQ9n9G3</td><td>pending</td> </tr>
        <?php  // } ?> 
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