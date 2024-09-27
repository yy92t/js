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
	if ($_SESSION[check]) {
		unset($_SESSION[check]);
		echo '<center><h3>Logout successfully!</h3></center>';
		header('Refresh:5;URL=login.php');
	} else {
		header('Location:login.php');
	}
?>
</body>
</html>