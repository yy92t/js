<?
	ob_start();
	
	if (!$_COOKIE[cktime]) {		
		$check = 1;		
		setcookie('cktime', $check, time()+300);
		echo $_COOKIE[cktime];
	} else {
		if ($_COOKIE[cktime] > 3) {
			echo '<center><h3>Please try again later!</h3></center>';
			exit;
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<table width="500" border="0" align="center">
  <tbody>
    <tr>
      <td align="center"><form action="manage.php" method="post" name="form1" id="form1">
        <fieldset>
          <legend>Login</legend>
          <table width="400" border="0" align="center">
            <tbody>
              <tr>
                <td>User Name:</td>
                <td><input name="username" type="text" id="username" size="25"></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input name="password" type="password" id="password" size="25"></td>
              </tr>
            </tbody>
          </table>
          <p>
            <input type="submit" name="submit" id="submit" value="Submit">
            <input type="reset" name="reset" id="reset" value="Reset">
          </p>
        </fieldset>
      </form></td>
    </tr>
  </tbody>
</table>
</body>
</html>