<div class="heading round"><center>Welcome to EAS!!!</center></div>
<div id="errors" class="round"><?php echo validation_errors();?>
<?php echo $loginInvalid?></div>
<div id="content">
<div id="register" class="shadow round">
<?php echo form_open('Account/register'); ?>
<table cellspacing="5px">
  <tr>
    <th scope="col" colspan="2">Register</th>
  </tr>
  <tr>
    <td align="right">Username</td>
    <td><input name="username" id="username" type="text" value="<?php echo set_value('username') ?>"  /></td>
  </tr>
  <tr>
    <td align="right">Password</td>
    <td><input name="password" id="password" type="password" value="<?php echo set_value('password'); ?>"  /></td>
  </tr>
  <tr>
    <td align="right">First Name</td>
    <td><input name="firstName" id="firstName" type="text" value="<?php echo set_value('firstName'); ?>" /></td>
  </tr>
  <tr>
    <td align="right">Last Name</td>
    <td><input name="lastName" id="lastName" type="text" value="<?php echo set_value('lastName'); ?>" /></td>
  </tr>
  <tr>
    <td align="right">Contact Number</td>
    <td><input name="contactNumber" id="contactNumber" type="text" value="<?php echo set_value('contactNumber'); ?>"  /></td>
  </tr>
  <tr>
  	<td colspan="2" align="center"><input type="submit" /></td>
  </tr>
</table>
<?php echo form_close(); ?>
</div><!-- End of Registration -->
<div id="login" class="shadow round">
<?php echo form_open('Account/login'); ?>
<table cellspacing="5px">
<tr>
<th colspan="2">Log In</th>
</tr>
<tr>
    <td align="right">Username</td>
    <td><input name="emailId" type="text" value="<?php echo set_value('emailId'); ?>" /></td>
  </tr>
  <tr>
    <td align="right">Password</td>
    <td><input name="logpassword" type="password" value="<?php echo set_value('logpassword'); ?>"  /></td>
  </tr>
  <tr>
  	<td colspan="2" align="center"></td>
  </tr>
  <tr>
  	<td colspan="2" align="center"><input type="submit" /></td>
  </tr>
</table>
<?php echo form_close(); ?>
</div> <!-- End of Login -->
</div><!-- End of Content -->
