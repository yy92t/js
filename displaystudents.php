<?
	ob_start();
	session_start();
	if (!$_SESSION[check]) {
		header('Location:login.php');
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<?
	$link = mysql_connect('localhost', 'root', 'rootpass');	
	if ($link) {
		echo 'Connect to the MySQL successful.<br>';
	} else {
		echo 'Could not connect to the MySQL.';
		exit;
	}	
	
	$selectdb = mysql_select_db('course', $link);
	if ($selectdb) {
		echo 'Select database successful.<br>';
	} else {
		echo 'Could not select database.';
		exit;
	}
	
	$sql = "SELECT es.enrol_date, s.eng_name, s.id_num, s.tel1, s.email FROM enrolstudents es, students s, enrolcourses ec WHERE es.student_id = s.student_id AND ec.enrol_id = es.enrol_id AND ec.course_id = '$_GET[courseid]'";
	$result = mysql_query($sql);
	echo $result;
?>
<table width="500" border="1" align="center">
  <tbody>
    <tr>
      <td bgcolor="#8AD0FF">Enrolled Date</td>
      <td bgcolor="#8AD0FF">Student Name</td>
      <td bgcolor="#8AD0FF">HKID</td>
      <td bgcolor="#8AD0FF">Telephone</td>
      <td bgcolor="#8AD0FF">Email</td>
    </tr>

<?
	$init = 0;
	$num = mysql_num_rows($result);
	  
	while ($init < $num) {
		
		$row = mysql_fetch_array($result);
		
		echo "<tr>\n";
	  	echo "<td>$row[enrol_date]</td>\n";
	  	echo "<td>$row[eng_name]</td>\n";
	  	echo "<td>$row[id_num]</td>\n";
	  	echo "<td>$row[tel1]</td>\n";
		echo "<td>$row[email]</td>";
		echo "</tr>\n";
		$init++;
	}
?>	  
  </tbody>
</table>
<p><a href="displaycourse.php">Back</a></p>
</body>
</html>











