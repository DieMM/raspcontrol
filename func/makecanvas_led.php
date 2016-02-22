<?php

///////////
///////////
///////////
?>
<script src="inc/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "ramdisk/led.csv",
        dataType: "text",
        success: function (data) { processData(data); }
    });





        function processData(allText) {
                var allLinesArray = allText.split('\n');
                if(allLinesArray.length>0){
                        var dataPoints = [];

                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                dataPoints.push({label:rowData[0],y:parseFloat(rowData[1])});
                        }

/////////////////////////////////////////////////////////////////////
                chart2 = new CanvasJS.Chart("chartContainer1", {
                theme: "theme2",
		zoomEnabled: true,
		zoomType: "xy",
                title:{
                        text: "Temperaturverlauf"
                },
		axisX:{
		  title: "Datum/Uhrzeit",
		  labelAngle: 50,
		  labelFontSize: 10,
		  gridThickness: 1,
		  labelWrap: true,
		  labelMaxWidth: 70,

 		},


                zoomEnabled:true,
                data: [
                {
                        type: "line",
                        dataPoints: dataPoints,
			legendText: "Kammer links",
			showInLegend: true,
			toolTipContent: "Kammer links: {y} - {label}",

                }],



                });

                chart2.render();
/////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////


                }
        }





















   
});
</script>
<script type="text/javascript" src="inc/canvasjs.min.js"></script>
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
<div id="chartContainer2" style="height: 300px; width: 100%;"></div>

<?php
