<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Insert title here</title>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=ABeeZee|Cantora+One|Sanchez' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/style.js"></script>

<!-- <script type="text/javascript" src="<?php echo base_url()?>js/dynamic.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/exporting.js"></script>
</head>
    <body>
    <div class="heading round"><center>Live changes in Acceleration</center></div>

<div id="content">
<div id="dynamic">
</div><!--End of dynamic -->

<script type="text/javascript">
var chart;
var x=0,y=0,z,time;
$(document).ready(function() {
   chart = new Highcharts.Chart({
        chart: {
            renderTo: 'dynamic',
            defaultSeriesType: 'spline',
            events: {
                load: getLatestTime
            }
        },
        title: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150
        },
        yAxis: {
            title: {
                text: 'Value',
                margin: 80
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        series: [{
            name: 'X-Coordinate ',
            data: []
        },{
            name: 'Y-Coordinate',
            data: []
        },{
            name: 'Z-Coordinate',
            data: []
        }]
    });    
   function getWasteTime(){
	   x = (new Date()).getTime();
	   y++;
	   alert(x+","+y);var series = chart.series[0];
		var shift = series.data.length > 20;
	   chart.series[0].addPoint([x,y],true,shift);
	   setTimeout(getWasteTime, 1000); 
   }
function getLatestTime()
{
	var dataSend = {
			id : <?php echo $id?>
	};
	 $.ajax({
		url: "<?php echo base_url()?>/index.php/Subscription/getLatestTime",
		type: 'POST',
		data: dataSend,
		success: function(msg){
			var series = chart.series[0];
			var shift = series.data.length > 10;
			var obj = JSON.parse(msg);
			var tempDate = new Date(obj[0]);
			var x =(tempDate).getTime(), y = parseFloat(obj[1]);
			var z = parseFloat(obj[2], a = parseFloat(obj[3]));
			chart.series[0].addPoint([x,y], true, shift);
			chart.series[1].addPoint([x,z], true, shift);
			chart.series[2].addPoint([x,a], true, shift);
			setTimeout(getLatestTime, 1000); 
		}
	});
}    
});
</script>
</div>
    </body>
</html>