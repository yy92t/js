<?php
require('course_sc_fns.php');

$get_courseid = $_GET['courseid'];
$get_catid = $_GET['catid'];

check_enrolprocess();

$get_cat_list = get_categories();
$get_course_detail = get_course_detail($get_courseid,$get_catid);
@ extract($get_course_detail,EXTR_PREFIX_ALL,'chkout');
?>
<html>
<head>
  <title>Computer Science</title>
  <meta http-equiv="Content-Type" content="text/html; charset=big5">
    <style>
      h2 { font-family: Arial, Helvetica, sans-serif; font-size: 22px; color = red; margin = 6px }
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #0066FF; width=70%; text-align=center}
      a { color: #000000 }
    </style>
</head>
<body>
  <table width="100%">
  <tr>
  	<td>
	  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#08246B">
    	<tr>
      		<td width="38%" rowspan="2" bgcolor="#819CC9"><a href="index.php"><img src="images/CS.jpg" width="295" height="60" border="0"></a></td>
      		<td height="41" bgcolor="#819CC9">&nbsp;</td>
    	</tr>
    	<tr>
      		<td width="62%" bgcolor="#819CC9"><div align="right" class="style1">June 2004 </div></td>
    	</tr>
  	  </table>
	</td>
  </tr>
  <tr>
    <td>
   <table width="100%"  border="0">
    <tr>
     <td width="187" valign="top">
<?php 
	display_categories($get_cat_list);
?>
	   </td>
	   <td height="90%" valign="top">
		<br>
		<strong>You are going to enrol : </strong><?php echo "$chkout_course_id - $chkout_course_name"; ?><p>
		  <table border = 0 width = 100% cellspacing = 0>
		 	 <form action=purchase.php method=post>
		  	<tr>
		  		<th colspan = 2 bgcolor="#cccccc">Please enter your contact information:</th>
			</tr>
  			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
			    <td>English Name: <font color="red">*</font></td>
    			<td><input type="text" name="engname" value="<?php echo $_COOKIE['cke_engname']; ?>" maxlength="40" size="40"></td>
  			</tr>
  			<tr>
    			<td>Gender: <font color="red">*</font></td>
    			<td>
    			  <input name="gender" type="radio" value="M" <?php if ($_COOKIE['cke_gender']=='M') echo 'checked'; ?>>
    			  M 
    			  <input name="gender" type="radio" value="F" <?php if ($_COOKIE['cke_gender']=='F') echo 'checked'; ?>>
    			  F
				</td>
  			</tr>
  			<tr>
  			  <td>ID Number: <font color="red">*</font></td>
  			  <td><input name="idnum" type="text" id="idnum" value="<?php echo $_COOKIE['cke_idnum']; ?>" size="8" maxlength="8"> 
  			    ( eg. a1234567 ) </td>
			  </tr>
  			<tr>
    			<td>Tel (Home): <font color="red">*</font></td>
    			<td><input type="text" name="phone1" value="<?php echo $_COOKIE['cke_phone1']; ?>" maxlength="20" size="20"></td>
  			</tr>
  			<tr>
    			<td>Tel (Mobile): <font color="red">*</font></td>
    			<td><input type="text" name="phone2" value="<?php echo $_COOKIE['cke_phone2']; ?>" maxlength="20" size="20"></td>
  			</tr>
  			<tr>
    			<td>Tel (Company):</td>
    			<td><input type="text" name="phone3" value="<?php echo $_COOKIE['cke_phone3']; ?>" maxlength="20" size="20"></td>
  			</tr>
  			<tr>
    			<td>Email Address: <font color="red">*</font></td>
    			<td><input type="text" name="email" value = "<?php echo $_COOKIE['cke_email']; ?>" maxlength="30" size="20"></td>
  			</tr>  
  			<tr>
    			<td valign="top">Address: <font color="red">*</font></td>
    			<td><textarea name="address" value ""  cols="30" rows="10"><?php echo $_COOKIE['cke_address']; ?></textarea></td>
  			</tr>
  			<tr>
    			<td><input type="hidden" name="courseid" value="<?php echo $chkout_course_id; ?>">
					<input type="hidden" name="catid" value="<?php echo $chkout_cat_id; ?>">
					<input type="hidden" name="enrolcode" value="<?php echo rand(); ?>">
				</td>
			</tr>
  			<tr>
				<td>&nbsp;</td>
			</tr>
  			<tr>
    			<td colspan = 2 align = center><input type="submit" value="Purchase">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset"></td>
  			</tr>
  			</form>
  		</table>
		<p><hr /></p>
	   </td>
      </tr>
     </table>
	</td>
  </tr>
  <tr>
    <td>
		<table width="100%">
		  <tr><td height="65">&nbsp;</td></tr>
  		  <tr>
    		<td align="right" bgcolor="#6699FF">
				<font color="#333333"><strong>Powered by Systematic Education Center.&nbsp;</strong></font>
			</td>
  		  </tr>
		</table>
	</td>
  </tr>
</table>
</body>
</html>