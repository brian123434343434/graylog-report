<?php
require('datos.php');
$dt=stats::newReg();
?>
<html>
  <head>
    <title>HTML5 Canvas example</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.onload = function() {
        
        var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title:{
                        text: "Gold Reserves"
                },
                axisY: {
                        title: "Gold Reserves (in tonnes)"
                },
                data: [{
                        type: "column",
                        yValueFormatString: "#,##0.## tonnes",
                        dataPoints: [{"y":<?php echo $dt[1]['rows'][0][4] ?>,"label":"Germany"},{"y":2435.94,"label":"France"},{"y":1842.55,"label":"China"},{"y":1828.55,"label":"Russia"},{"y":1039.99,"label":"Switzerland"},{"y":765.215,"label":"Japan"},{"y":612.453,"label":"Netherlands"}]
                }]
        });
        chart.render();
        
        }
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</body>
</html>