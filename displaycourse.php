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
	
	$sql = 'SELECT course_id, course_name, course_date, course_remain FROM courses';
	$result = mysql_query($sql);
	echo $result;
?>
<table width="500" border="1" align="center">
  <tbody>
    <tr>
      <td bgcolor="#8AD0FF">Course ID</td>
      <td bgcolor="#8AD0FF">Course Name</td>
      <td bgcolor="#8AD0FF">Course Date</td>
      <td bgcolor="#8AD0FF">Course Remain</td>
      <td bgcolor="#8AD0FF">Students</td>
    </tr>

<?
	$init = 0;
	$num = mysql_num_rows($result);
	  
	while ($init < $num) {
		
		$row = mysql_fetch_array($result);
		
		echo "<tr>\n";
	  	echo "<td>$row[course_id]</td>\n";
	  	echo "<td>$row[course_name]</td>\n";
	  	echo "<td>$row[course_date]</td>\n";
	  	echo "<td>$row[course_remain]</td>\n";
		echo "<td><a href=\"displaystudents.php?courseid=$row[course_id]\">Details</a></td>";
		echo "</tr>\n";
		$init++;
	}
?>	  
  </tbody>
</table>
<p><a href="manage.php">Back</a></p>
</body>
</html>











