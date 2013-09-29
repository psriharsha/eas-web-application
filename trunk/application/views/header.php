<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=ABeeZee|Cantora+One|Sanchez' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/style.js"></script>

<!-- <script type="text/javascript" src="<?php echo base_url()?>js/dynamic.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/exporting.js"></script>

</head>

<body>
<div id="dialog" class="round">
<div class="heading round">Send Invitation</div><center>
<table cellspacing="5px" class="inviTable">
  <tr>
    <td align="right">Email Id</td>
    <td><input name="toMail" id="toMail" type="text" value="<?php echo set_value('toMail') ?>"  /></td>
  </tr>
  <tr>
  	<td align="right">Permission(s)</td>
  	<td><input type="checkbox" id="actCheck" name="activity" checked="checked" disabled="disabled">Activity<br>
  		<input type="checkbox" id="locCheck" name="location">Location
  	</td>
  </tr>
  <tr>
  	<td align="center" colspan="2"><input type="button" value="Submit" class="special" id="addInvi"></td>
  </tr>
</table>
<div id="error_bg"></div>
</center>
</div>
<script type="text/javascript">
$('#addInvi').click(function(){
	var toMail = $('#toMail').val();
	var permission = "activity", finRes = "false";
	var tempPer = $('#locCheck').is(':checked');
	if(tempPer)
	 permission = "both";
	var dataSend = {
			idUser : <?php echo $this->session->userdata('userId')?>,
			toMail : toMail,
			permission: permission,
			status : "false"
	};
		$.ajax({
		url: "<?php echo base_url()?>/index.php/Subscription/addSubscription",
		type: 'POST',
		data: dataSend,
		success: function(msg){
			if(msg == "Success")
			{
				if(permission == "both")
					permission = "Location<br>Activity";
				finRes = true;
				$('#nullHandler').hide();
				$('#careTable').append("<tr><td align=\"center\">"+toMail+"</td><td align=\"center\">No</td><td align=\"center\"></td><td align=\"center\">"+permission+"</td></tr>");
			}
			else
			{
				finRes = false;
				$('#error_bg').html("Enter the email Id correctly!!");
			}
		}});
		if(finRes)
	$('#dialog').hide();
});
</script>
<div id="container">
<div id="header">
<center><img src="<?php echo base_url();?>pics/logo_96.jpg" class="logo" width="100px" height="80px" vspace="10px" /><img src="<?php echo base_url();?>pics/Title.png" /></center>
</div> <!-- End of the Header-->