<?
	ob_start();
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<?
	$in_usr = $_POST[username];
	$in_pass = $_POST[password];
	
	if (!$_SESSION[check]) {
		if ($in_usr != 'admin' || $in_pass != 'adminpass') {						
			$check = $_COOKIE[cktime] + 1;			
			setcookie('cktime', $check, time()+300);
			header('Location:login.php');
			exit;
		} else {
			$_SESSION[check] = 'admin';
		}
	}
?>
	
<table width="400" border="0" align="center">
  <tbody>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><a href="displaycourse.php">Display course remain</a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><a href="logout.php">Logout</a></td>
    </tr>
  </tbody>
</table>
</body>
</html>