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
        <h2 class="mb-4">Seller's Orders List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
        <tr><th>Title</th><th>Budget</th><th>Deliverd At</th><th>Delivery Time</th><th>Job ID</th><th>Job Posted By</th><th>Note</th> <th>Offerd By</th><th>OrderID</th><th>Status</th></tr> 
        </thead>
        <tbody>
        <?php // foreach($user as $k) {?>
        <tr><td><?php // echo $k['title']; ?>I need a Python Developer</td><td><?php // echo $k['Budget'] ?>500</td><td><?php // echo $k['deliverdat']; ?>16303361</td><td><?php // echo $k['Deliverytime'] ?>6 Days</td><td><?php // echo $k['JobID']; ?>1629548522416</td><td><?php // echo $k['jobPostedBy']; ?>iqmieN</td><td><?php //echo $k['note']; ?>1:Experience 1.5Year.2:Min Projects5.3:Education:Degree.</td> <td><?php // echo$k['offeredBy']; ?>2gGZ6</td><td><?php // echo $k['postesAt1629732821086']; ?>162</td><td><?php // echo $k['status']; ?>completed</td> </tr>
        <tr><td><?php // echo $k['title']; ?>I need a Php Developer</td><td><?php // echo $k['Budget'] ?>600</td><td><?php // echo $k['deliverdat']; ?>163037876</td><td><?php // echo $k['Deliverytime'] ?>7 Days</td><td><?php // echo $k['JobID']; ?>1629547679</td><td><?php // echo $k['jobPostedBy']; ?>iqmieN</td><td><?php //echo $k['note']; ?>1:Experience 1.4Year.2:Min Projects 4.3:Education:Degree.</td> <td><?php // echo$k['offeredBy']; ?>2gGZ6</td><td><?php // echo $k['postesAt1629732821086']; ?>162</td><td><?php // echo $k['status']; ?>completed</td> </tr>

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