<div class="heading round"><center>My Account (<?php echo $display?>)</center></div>
<div id="content">
<div id="tab_title">
<ul>
<li><a href="#" id="1">Senior Citizens</a></li>
<li><a href="#" id="2">Care Givers</a></li>
<li><a href="#" id="3">My Details</a></li>
<li><a href="<?php echo base_url()?>index.php/account/logout" id="4">Logout</a></li>
</ul>
</div><!-- Tab Titles -->
<div id="tab_content">
<ul>
<li id="tab1">
<table cellpadding="5px" bgcolor="#FFFFFF" width="100%" class="content_table">
<tr bgcolor="#FF9999">
<th align="center">Name of the Person</th>
<th align="center">Subscription</th>
<th align="center">Last Changed</th>
<th align="center">View</th>
</tr>
<?php
$i=0;
if(count($senior_citizens_name)>0)
  for(;$i<count($senior_citizens_name);$i++){?>
<tr>
<td align="center"><?php echo $senior_citizens_name[$i] ?></td>
<td align="center"><?php if($subsStatus[$i]=="true") echo "Yes"; else echo "No"; if($idSubs[$i]!=0) echo "<a href= \"".base_url()."index.php/Subscription/changeSubs?idSubs=".$idSubs[$i]."\">(Change)</a>";?></td>
<td align="center"><?php echo $resetTime[$i]?></td>
<td align="center"><?php switch($permission[$i]){
	case "both":
	case "location":echo "<a href=\"".base_url()."index.php/Subscription/showLocation?idSubs=".$tempId[$i]."&sessionId=".md5(time())."\">Location</a> <br>";
					if($permission[$i]=="location") break;
	case "activity":echo "<a href=\"".base_url()."index.php/Subscription/showActivity?idSubs=".$tempId[$i]."&sessionId=".md5(time())."\">Activity</a>";
					break;
}?></td>
</tr>
<?php }else {
echo "You do not have invitations from any of our users. Please come back again!! Thanks!!";
}?>
</table>
</li>
<li id="tab2">
<div id="addSubsDiv" class="round">Click here to send an Invitation</div>
<table cellpadding="5px" bgcolor="#FFFFFF" width="100%" class="content_table" id="careTable">
<tr bgcolor="#33FF99">
<th align="center">Name of the Person</th>
<th align="center">Subscription</th>
<th align="center">Last Changed</th>
<th align="center">Permissions</th>
</tr>
<?php
if(count($care_givers_name)>0) for($i=0;$i<count($care_givers_name);$i++){?>
<tr>
<td align="center"><?php echo $care_givers_name[$i] ?></td>
<td align="center"><?php if($subsStatusC[$i]=="true") echo "Yes"; else echo "No";?></td>
<td align="center"><?php echo $resetTimeC[$i]?></td>
<td align="center"><?php switch($permissionC[$i]){
	case "both":
	case "location":echo "Location <a href=\"".base_url()."index.php/Subscription/deleteSubscription?perm=location&idSubs=".$idSubsC[$i]."\" class=\"del\">x</a><br>";
					if($permissionC[$i]=="location") break;
	case "activity":echo "Activity <a href=\"".base_url()."index.php/Subscription/deleteSubscription?perm=activity&idSubs=".$idSubsC[$i]."\" class=\"del\">x</a>";
					break;
}?></td>
</tr>
<?php }else{
	echo "<tr><td colspan = \"4\" align=\"center\" id=\"nullHandler\">You do not have any Care Givers. Add atleast one caregiver as early as possible.</td></tr>";
}?>
</table>
</li>
<li id="tab3"><?php echo form_open('Account/editDetails'); ?>
<table bgcolor="#FFFFFF" cellpadding="5px" width="600px">
<tr>
<td align="right" width="200px"><b>First Name:</b></td><td><span class="formData"><input type="text" name="firstName" value="<?php echo $info->firstName?>"></span></td>
</tr>
<tr>
<td align="right"><b>Last Name:</b></td><td><span class="formData"><input type="text" name="lastName" value="<?php echo $info->lastName?>"></span></td>
</tr>
<tr>
<td align="right"><b>Date of Birth:</b></td><td><span class="formData"><input type="text" name="dob" value="<?php echo $info->dob?>"></span></td>
</tr>
<tr>
<td align="right"><b>Gender:</b></td><td><span class="formData"><input type="text" name="gender" value="<?php echo $info->gender?>"></span></td>
</tr>
<tr>
<td align="right"><b>Blood Group:</b></td><td><span class="formData"><input type="text" name="bloodGroup" value="<?php echo $info->bloodGroup?>"></span></td>
</tr>
<tr>
<td align="right"><b>Emergency Contact Number:</b></td><td><span class="formData"><input type="text" name="emergencyNumber" value="<?php echo $info->emergencyNumber?>"></span></td>
</tr>
<tr>
<td align="right"><b>Email ID:</b></td><td><span class="formData"><?php echo $info->emailId?></span></td>
</tr>
<tr>
<td align="right"><b>Routine Start:</b></td><td><span class="formData"><input type="text" name="routineStart" value="<?php echo $info->routineStart?>"></span></td>
</tr>
<tr>
<td align="right"><b>Routine End:</b></td><td><span class="formData"><input type="text" name="routineEnd" value="<?php echo $info->routineEnd?>"></span></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Save Changes" /></td>
</tr>
</table>
<?php echo form_close(); ?>
</li>
<li id="tab4">
Logging off......
</li>
</ul>
</div><!-- End of tab_content -->
</div><!-- End of Content -->