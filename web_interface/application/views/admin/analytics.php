<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
        <style>
       .number-font {
           font-size: 1.5rem;
       }

       .bg-market {
        background-image: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%) !important;
        }
       

       .bg-vendors {
        background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;
        }
       
       .bg-org {
        background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%) !important;
        }
       

    </style>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content -->
<div class="main">
    <h1 class="text-center mt-4">Analytics</h1>

    <div class="container-fluid mt-5">
        <div class="row">


        <canvas id="myChart" style="width:auto%;width:600px"></canvas>

        </div>
    </div>
</div>










    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
    
   
</body>

<script>
var myarray=[];
var minarray=[];
var currentvalue=[];

<?php foreach($sensorname as $s){?>

<?php                 if(!empty($s['default_value'])){
                              $xd=$s['default_value'];
                              $someArray = json_decode($xd, true);
                              $x1=$this->db->select('sensor_data')->order_by('id','desc')->where('sensor_id',$s['sensor_id'])->get('sensor_data')->row_array();
                           
                            $x=json_decode($x1['sensor_data']);
                           

                              for($i=0; $i<count($someArray);$i++){
                                $innerlabel=$someArray[$i]['label'];
                                 $minv=$someArray[$i]['min-value'];
                                 $current=$x[$i]->val;
                                
                                
                                ?>

                                myarray.push("<?php echo $s['name'] . " -" .$innerlabel; ?>")
                                minarray.push(<?php echo $minv; ?>);
                                currentvalue.push(<?php echo $current; ?>);

<?php 

                              }
}
                              ?>
<?php } ?>
console.log(myarray);
console.log(minarray);
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15];
var barColors = ["red", "green","blue","orange","brown","yellow","pink","purpal"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: myarray,
    datasets: [{
      backgroundColor: barColors,
      data: currentvalue
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Latest Reading"
    }
  }
});
  </script>
</html>