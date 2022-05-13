<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
</head>
<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
   // max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
 //   max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

    </style>



    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content   offers -->

<div class="main">
  
    <div class="container mb-1">




<figure class="highcharts-figure">
    <div id="container"></div>

</figure>
















     
    </div>
    
   


</div>





    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
<script>
<?php

$js_array = json_encode($valuesdata);
$timearray=json_encode($timedata);
$newarray=json_encode($newdata);
$sensorinfo=json_encode($sesnor_info);
echo "var javascript_array = ". $js_array . ";\n";
echo "var javascript_array = ". $js_array . ";\n";
echo "var fjavascript_array = ". $newarray . ";\n";
echo "var seriesNo = ". $seriesno . ";\n";
echo "var seriesName = ". $sensorinfo . ";\n";
echo "var sensorname = '". $sensorname . "';\n";

?>
// alert(sensorname);
// console.log({fjavascript_array});
const arr1 = [];

for(let outer=0; outer < seriesNo; outer++){
    const arr = [];
    for(let x=0; x<fjavascript_array.length;x++){
        arr.push([
            new Date(fjavascript_array[x][outer][0]),fjavascript_array[x][outer][1]
        ]);
    }
    arr1.push(arr)
}
console.log(arr1);
// const mynewdata= fjavascript_array.reduce((acc,curr)=>{
//     // console.log(acc);
//     for(let x=0; x < seriesNo; x++){
//         acc[0][x].push(curr[x])
//     }
//     return acc;
//     // console.log(val);
//     // const data = new Date(val[0])
//     // return [data,[val.slice(1)]];
// }, [Array.from({length:seriesNo}).fill([])]);
// console.log(newArray3);




    Highcharts.chart('container', {
        chart: {
            type: 'spline',
            zoomType: 'x'
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            // pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
        },
        title: {
            text: sensorname
        },

        // subtitle: {
        //     text: 'Source: thesolarfoundation.com'
        // },

        yAxis: {
            title: {
                text: 'Sensor Value'
            }
        },

        xAxis: {
                type: 'datetime',
            
                dateTimeLabelFormats: { // don't display the dummy year
                    // millisecond: '%H:%M:%S.%L',
                    second: '%H:%M:%S',
                    // minute: '%H:%M',
                    // hour: '%H:%M',
                    // day: '%e. %b',
                    // week: '%e. %b',
                    // month: '%b \'%y',
                    // year: '%Y'
                },
                categories: arr1[0].map((val)=>val[0].toLocaleString('en-GB', { timeZone: 'UTC' })),
                zoomEnabled:true,
                title: {
                    text: 'Time'
                }
            },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                marker:{
                    enabled: true
                }
            }
        },
        series: arr1.map((val,ind)=>{
            return {
                name: seriesName[ind],
                data:val
            }
        }),
        // series: [{
        //     // name: 'Installation',
        //     data: mynewdata,
        // }],

        

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 768
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
    </script>
</body>

</html>