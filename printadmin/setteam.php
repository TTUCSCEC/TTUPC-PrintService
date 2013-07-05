<?php
	require_once("./include/config.php");
	$db = mysql_connect($dbhost, $dbuser, $dbpassword);
	$sel = mysql_select_db($dbname, $db);
?>
<?php
	if(isset($_POST["teamno"])){
		$userIP = $_SERVER["REMOTE_ADDR"];
		$teamno = $_POST["teamno"];
		$result = mysql_query("	REPLACE INTO ipmapteam
							(ip, teamno)
							VALUES
							('$userIP', $teamno)
		");
		if($result){
?>
			<h2 align="center">
				Set 
				<?php
					echo "$userIP" . " as Team";
					printf("%02d", $teamno);
				?>
				Complete!
			</h2>
<?php
		}
	}
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"0>
	
		<title>Set Team</title>
		
	</head>
	<body>
		<div align="center">
			<form action="" method="post" accept-charset="utf-8">
				Set team number as: 
				<input type="text" name="teamno">
				<p><input type="submit" value="Continue &rarr;"0></p>
			</form>
		</div>
	</body>
</html>
