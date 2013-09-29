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
    <div class="heading round"><center>Recent Location Identified</center></div>
<div id="content">
<div id="values">
<table>
	<tr>
		<th>Time</th>
		<th>Latitude</th>
		<th>Longitude</th>
	</tr>
	<tr>
		<td id="atTime"></td>
		<td id="latitude"></td>
		<td id="longitude"></td>
</table>
</div>
<div id="map_canvas">
</div><!--End of map_canvas -->
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBnVt3-Dc-bTvROxbKEDKC_8mTwFaAh8c&sensor=true">
    </script>
<script type="text/javascript">
$(document).ready(function() {
	getLatestTime();
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
				var obj = JSON.parse(msg);
				var latVal = parseFloat(obj[4]);
				var lngVal = parseFloat(obj[5]);
				$('#atTime').html(obj[0]);
				$('#latitude').html(latVal);
				$('#longitude').html(lngVal);
				initialize(latVal, lngVal);
				setTimeout(getLatestTime, 10000); 
			}});
	}
	function initialize(latVal,lngVal) {
        var mapOptions = {
          center: new google.maps.LatLng(latVal, lngVal),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
      }
});
</script>
</div><!-- End of Content -->
    </body>
</html>