<table cellpadding="5px" bgcolor="#FFFFFF" width="100%" class="content_table">
<tr bgcolor="#33FF99">
<th align="center">Name of the Person</th>
<th align="center">Subscription</th>
<th align="center">Permissions</th>
</tr>
<?php for($i=0;$i<count($care_givers_name);$i++){?>
<tr>
<td align="center"><?php echo $care_givers_name[$i] ?></td>
<td align="center"><?php if($subsStatusC[$i]=="true") echo "Yes"; else echo "No";?></td>
<td align="center"><?php switch($permissionC[$i]){
	case "both":
	case "location":echo "Location,<br>";
					if($permissionC[$i]=="location") break;
	case "activity":echo "Activity";
					break;
}?></td>
</tr>
<?php }?>
</table>