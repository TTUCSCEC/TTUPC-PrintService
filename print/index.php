<?php
	require_once("./include/config.php");
	$db = mysql_connect($dbhost, $dbuser, $dbpassword);
	$sel = mysql_select_db($dbname, $db);
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"0>
	
		<title>The 3rd TTUPC Print Service</title>
		
	</head>
	<body>
		<script type=text/javascript>
			function check(){
				var info = confirm("Really need to print?");
				if(info == true){
					document.forms[0].submit();
				}
			}
		</script>
		<h3 align="center">
			The 3rd Tatung University Programming Contest Print Service
		</h3>
		<br>

		<div align="center">
		<?php
			//show user profile
			$userIP = $_SERVER["REMOTE_ADDR"];
			$result = mysql_query("	SELECT teamno, teamname
									FROM ipmapteam
									WHERE ip = '$userIP'");
			$result = mysql_query("	SELECT ipmapteam.teamno, team.teamname
									FROM `ipmapteam`
									LEFT JOIN team
										ON ipmapteam.teamno=team.teamno
									WHERE ipmapteam.ip = '$userIP'");
			$row = mysql_fetch_array($result);

			if(!$row){
				echo "Not allow user";
				header("Location: http://goo.gl/X086X");
			}

			echo "Team";
			printf("%02d", $row["teamno"]);
			echo "&nbsp;&nbsp;" . $row["teamname"];
		?>
		</div>
		
		<br>
		<br>
		
		<div align="center">
			<form action="uploadfile.php" method="post" enctype="multipart/form-data" accept-charset="utf-8" align="center">
				Choose a file to upload:<br>
				<input type="file" name="file">
				<br>
				<br>
				<p>
					<input type="reset" name="clear">
					<input type="button" onclick=check(0); value="Upload">
					<!--input type="submit" value="Upload"-->
				</p>
			</form>
		</div>

		<?php
			//Print All Upload File
			$result = mysql_query("	SELECT *
									FROM print
									WHERE ip = '$userIP'
									ORDER BY timestamp DESC
			");
			$log = array();
			for ($i = 0; $i < mysql_num_rows($result); $i++) {
				$log[$i] = mysql_fetch_array($result);
			}
		?>

		<br>
		<br>

		<table width="800" border="1" align="center">
			<tr>
				<th>FileName</th>
				<th>TimeStamp</th>
				<th>Printed</th>
			</tr>
		<?php
			for ($i = 0; $i < count($log); $i++) {
				echo "<tr>";
					echo "<td align=center>" . $log[$i]["filename"] . "</td>";
					echo "<td align=center>" . $log[$i]["timestamp"] . "</td>";
					echo "<td align=center>";
						if($log[$i]["hasprint"]){
							echo "Yes";
						}
						else{
							echo "in ready queue";
						}
					echo "</td>";
				echo "</tr>";
			}

		?>
		</table>

	</body>
</html>
