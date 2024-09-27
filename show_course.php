<?php
require('course_sc_fns.php');

$get_courseid = $_GET['courseid'];
$get_catid = $_GET['catid'];

check_enrolprocess();

$get_cat_list = get_categories();

$get_course_detail = get_course_detail($get_courseid,$get_catid);

$get_available_course = get_available_courses($get_courseid,$get_catid);
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
        <td height="90%" valign="top"><?php display_course_details($get_course_detail); ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
    	<td valign="top"><?php display_available_course($get_available_course); ?></td>
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