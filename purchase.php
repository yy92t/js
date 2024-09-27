<?php
ob_start();
require('course_sc_fns.php');
check_enrolprocess();

$in_data['engname'] = $_POST['engname'];
$in_data['gender'] = $_POST['gender'];
$in_data['idnum'] = $_POST['idnum'];
$in_data['phone1'] = $_POST['phone1'];
$in_data['phone2'] = $_POST['phone2'];
$in_data['phone3'] = $_POST['phone3'];
$in_data['email'] = $_POST['email'];
$in_data['address'] = $_POST['address'];
$in_data['courseid'] = $_POST['courseid'];
$in_data['catid'] = $_POST['catid'];
$in_data['enrolcode'] = $_POST['enrolcode'];

setcookie('cke_engname',$in_data['engname'],time()+180);
setcookie('cke_gender',$in_data['gender'],time()+180);
setcookie('cke_idnum',$in_data['idnum'],time()+180);
setcookie('cke_phone1',$in_data['phone1'],time()+180);
setcookie('cke_phone2',$in_data['phone2'],time()+180);
setcookie('cke_phone3',$in_data['phone3'],time()+180);
setcookie('cke_email',$in_data['email'],time()+180);
setcookie('cke_address',$in_data['address'],time()+180);
setcookie('cke_course',$in_data['courseid'],time()+180);
setcookie('cke_catid',$in_data['catid'],time()+180);
setcookie('cke_enrolcode',$in_data['enrolcode'],time()+180);

$cat_array = get_categories();
$get_course_detail = get_course_detail($in_data['courseid'],$in_data['catid']);
@ extract($get_course_detail,EXTR_PREFIX_ALL,'purchase');
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
       <td width="20%" valign="top" align="center">
<?php
if ($in_data['engname'] && $in_data['gender'] && $in_data['idnum'] && is_numeric($in_data['phone1']) && is_numeric($in_data['phone2']) && $in_data['email'] && $in_data['address']) 
{
	$ref_no = insert_enrolprocess($in_data);
	
	if ($ref_no) {
		header("Refresh: 600; URL=pExpire.php?Ref=$ref_no");
	}
	
	if ($ref_no)
	{
?>
		<p>&nbsp;</p>
		<form name="payForm" method="post" action="https://test.paydollar.com/b2cDemo/eng/payment/payForm.jsp">
		<table width="50%"  border="0" cellspacing="1" bordercolor="#999999" bgcolor="#CCCCCC">
  			<tr bgcolor="#999999">
    			<td colspan="2" align="center"><strong>Check Out Information : </strong></td>
  			</tr>
  			<tr bgcolor="#FFFFFF">
    			<td width="50%">Course ID : </td>
    			<td><?php echo $purchase_course_id; ?></td>
  			</tr>
			<tr bgcolor="#FFFFFF">
    			<td width="50%">Course Name : </td>
    			<td><?php echo $purchase_course_name; ?></td>
  			</tr>
  			<tr bgcolor="#FFFFFF">
			    <td width="50%"><p>Course Price :</p>    </td>
			    <td><?php echo $purchase_course_price; ?></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td width="50%">Course Date : </td>
				<td><?php echo $purchase_course_date; ?></td>
  			</tr>
  			<tr bgcolor="#FFFFFF">
  				<td colspan="2">
				<input type="hidden" name="merchantId" value="101349">
				<input type="hidden" name="amount" value="<?php echo $purchase_course_price; ?>">
				<input type="hidden" name="orderRef" value="<?php echo $ref_no; ?>">
				<input type="hidden" name="currCode" value="344">
				<input type="hidden" name="successUrl" value="http://systematic.serveftp.org/course/pSuccess.php">
				<input type="hidden" name="failUrl" value="http://systematic.serveftp.org/course/pFail.php">
				<input type="hidden" name="cancelUrl" value="http://systematic.serveftp.org/course/pCancel.php">
				<input type="hidden" name"lang" value="C">
				<center><br><input type="submit" value="Pay Now"></center>
				</td>
			</tr>
		</table>
		</form>
		</p><p>&nbsp;</p>
		
<?php
		echo "<a href='pCancel.php?Ref=$ref_no'>Cancel Purchase</a>";
	}
	else
	{
?>
		<p>&nbsp;</p><p><b>Your process was failed.</b></p>
<?php
		echo "<a href='checkout.php?courseid=".$in_data['courseid']."&catid=".$in_data['catid']."'>Return</a>";
	}
}
else
{
?>
	<p>&nbsp;</p><p><b>You did not fill in all the fields, please try again.</b></p>
<?php
		echo "<a href='checkout.php?courseid=".$in_data['courseid']."&catid=".$in_data['catid']."'>Return</a>";
}
?>
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

