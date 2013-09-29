<table cellpadding="5px" bgcolor="#FFFFFF" width="100%" class="content_table">
<tr bgcolor="#FF9999">
<th align="center">Name of the Person</th>
<th align="center">Subscription</th>
<th align="center">Last Changed</th>
</tr>
<?php
$i=0;
  for(;$i<count($senior_citizens_name);$i++){?>
<tr>
<td align="center"><?php echo $senior_citizens_name[$i] ?></td>
<td align="center"><?php if($subsStatus[$i]=="true") echo "Yes"; else echo "No";?></td>
<td align="center"><?php echo $resetTime[$i]?></td>
</tr>
<?php }?>
</table>