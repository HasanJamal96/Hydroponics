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
        <h2 class="mb-4">Job's List</h2>
        <table class="table table-fluid" id="myTable">
        <thead>
         <tr><th>Title</th><th>Attachment</th> <th>Budget</th><th>CatID</th><th>Delivery Time</th><th>Name</th><th>Note</th><th>postAt</th> <th>Posted By</th></tr>
        </thead>
        <tbody>
        <?php // foreach($offer as $k) {?>
        <tr><td><?php // echo $k['title'];?>I need a Python Developer</td><td> <?php // echo $k['attachment']; ?>Null</td><td> <?php // echo $k['budget']; ?>1000 </td><td><?php // echo $k['catID']; ?>5</td><td><?php // echo $k['deliveryTime']; ?>10 Days</td><td><?php // echo $k['name']; ?>Python Development</td><td><?php // echo $k['note']; ?>1:Experience 1.5 Year.2: Min Projects 5.3 : Education:Bacholars Degree</td> <td><?php // echo$k['posteAt'] ?>16295</td><td><?php // echo $k['postedBy']; ?>iqmieNpbT</td> </tr>
        <tr><td><?php // echo $k['title'];?>I need a Php Developer</td><td> <?php // echo $k['attachment']; ?>Null</td><td> <?php // echo $k['budget']; ?>1200 </td><td><?php // echo $k['catID']; ?>5</td><td><?php // echo $k['deliveryTime']; ?>12 Days</td><td><?php // echo $k['name']; ?>Python Development</td><td><?php // echo $k['note']; ?>1:Experience 1 Year.2: Min Projects 4.3 : Education:Bacholars Degree</td> <td><?php // echo$k['posteAt'] ?>78685</td><td><?php // echo $k['postedBy']; ?>sytui</td> </tr>
    
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