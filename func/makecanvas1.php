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
        url: "ramdisk/output.csv",
        dataType: "text",
        success: function (data) { processData(data); }
    });



var chart1 = [];
var chart2 = [];

        function processData(allText) {
                var allLinesArray = allText.split('\n');
                if(allLinesArray.length>0){
                        var dataPoints = [];
                        var dataPoints2= [];
                        var dataPoints3= [];
                        var dataPoints4= [];
			var Licht1= [];
			var Licht2= [];
			var LTI= [];
			var umluft= [];
			var boxluft= [];

                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                dataPoints.push({label:rowData[0],y:parseFloat(rowData[1])});
                        }
                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                dataPoints2.push({label:rowData[0],y:parseFloat(rowData[2])});
                        }


                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                dataPoints3.push({label:rowData[0],y:parseFloat(rowData[3])});
                        }
                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                dataPoints4.push({label:rowData[0],y:parseFloat(rowData[4])});
                        }

                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                Licht1.push({label:rowData[0],y:parseFloat(rowData[5])});
                        }
                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                Licht2.push({label:rowData[0],y:parseFloat(rowData[6])});
                        }

                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                LTI.push({label:rowData[0],y:parseFloat(rowData[7])});
                        }

                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                umluft.push({label:rowData[0],y:parseFloat(rowData[8])});
                        }
                        for (var i = 1; i <= allLinesArray.length-1; i++) {
                                var rowData = allLinesArray[i].split(';');
                                boxluft.push({label:rowData[0],y:parseFloat(rowData[9])});
                        }





                        drawChart(dataPoints,dataPoints2,dataPoints3,dataPoints4);
                 drawChart2( dataPoints,Licht1,Licht2,LTI,umluft,boxluft);       

                }
        }




//--------------------Sync Chart-------------------
var charts = [chart1, chart2];

function syncHandler(e) {

    for (var i = 0; i < charts.length; i++) {
        var chart = charts[i];

        if (!chart.options.axisX) chart.options.axisX = {};

        if (e.trigger === "reset") {
            chart.options.axisX.viewportMinimum = chart.options.axisX.viewportMaximum = null;
            chart.render();
            
        } else if (chart !== e.chart) {
            chart.options.axisX.viewportMinimum = e.axisX.viewportMinimum;
            chart.options.axisX.viewportMaximum = e.axisX.viewportMaximum;
            chart.render();
        }

    }
}








        function drawChart2( dataPoints,Licht1,Licht2,LTI,umluft,boxluft) {
                chart1 = new CanvasJS.Chart("chartContainer2", {
                theme: "theme2",
		zoomEnabled: true,
		zoomType: "xy",
                title:{
                        text: "Verlauf"
                },
		axisX:{
		  title: "Datum/Uhrzeit",
		  labelAngle: 50,
		  labelFontSize: 10,
 		},


                zoomEnabled:true,
                data: [
                {
                        type: "line",
                        dataPoints: Licht1,
			legendText: "Licht  links",
			showInLegend: true,
			toolTipContent: "Licht links: {y} - {label}",

                },
                {
                        type: "line",
                        dataPoints: Licht2,
			legendText: "Licht recht",
			showInLegend: true,
			toolTipContent: "Licht rechts: {y} - {label}",
                },
                {
                        type: "line",
                        dataPoints: LTI,
			legendText: "LTI",
			showInLegend: true,
			toolTipContent: "LTI: {y} - {label}",
                },
                {
                        type: "line",
                        dataPoints: umluft,
			legendText: "Umluft",
			showInLegend: true,
			toolTipContent: "Umluft: {y} - {label}",
                },
                
                {
                        type: "line",
                        dataPoints: boxluft,
			legendText: "Boxluefter",
			showInLegend: true,
			toolTipContent: "Boxluefter: {y} - {label}",
                }],

		rangeChanged: syncHandler

                });

                chart1.render();
        }



        function drawChart( dataPoints,dataPoints2,dataPoints3,dataPoints4) {
                chart2 = new CanvasJS.Chart("chartContainer1", {
                theme: "theme2",
		zoomEnabled: true,
		zoomType: "xy",
                title:{
                        text: "Verlauf"
                },
		axisX:{
		  title: "Datum/Uhrzeit",
		  labelAngle: 50,
		  labelFontSize: 10,
 		},


                zoomEnabled:true,
                data: [
                {
                        type: "line",
                        dataPoints: dataPoints,
			legendText: "Kammer links",
			showInLegend: true,
			toolTipContent: "Kammer links: {y} - {label}",

                },
                {
                        type: "line",
                        dataPoints: dataPoints2,
			legendText: "Kammer recht",
			showInLegend: true,
			toolTipContent: "Kammer rechts: {y} - {label}",
                },
                {
                        type: "line",
                        dataPoints: dataPoints3,
			legendText: "Luftschacht",
			showInLegend: true,
			toolTipContent: "Luftschacht: {y} - {label}",
                },
                
                
                {
                        type: "line",
                        dataPoints: dataPoints4,
			legendText: "Ansaugbox",
			showInLegend: true,
			toolTipContent: "Luftbox: {y} - {label}",
                }],


		rangeChanged: syncHandler


                });

                chart2.render();
        }













   
});
</script>
<script type="text/javascript" src="inc/canvasjs.min.js"></script>
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
<div id="chartContainer2" style="height: 300px; width: 100%;"></div>

<?php
