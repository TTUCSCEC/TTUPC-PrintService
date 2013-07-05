<?php
	require_once("./include/config.php");
	$db = mysql_connect($dbhost, $dbuser, $dbpassword);
	$sel = mysql_select_db($dbname, $db);
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"0>
	
		<title>TTUPC Print Service Admin Page</title>
		
	</head>
	<body>
		<h3 align="center">
			In ready queue
		</h3>
		<?php
			$result = mysql_query("	SELECT ipmapteam.teamno, team.teamname, print.*
									FROM `ipmapteam`
									LEFT JOIN team
										ON ipmapteam.teamno=team.teamno
									RIGHT JOIN print
										ON ipmapteam.ip = print.ip
									WHERE print.hasprint = 0
									ORDER BY print.timestamp DESC");
			$log = array();
			for ($i = 0; $i < mysql_num_rows($result); $i++) {
				$log[$i] = mysql_fetch_array($result);
			}
		?>

		<table border="1" align="center">
			<tr>
				<th>TeamNo</th>
				<th>RealName</th>
				<th>Timestamp</th>
				<th>IP</th>
				<th>TeamName</th>
				<th>FileName</th>
				<th>Complete</th>
			</tr>
		<?php
			for ($i = 0; $i < count($log); $i++) {
				echo "<tr>";
					echo "<td align=center>" . $log[$i]["teamno"]. "</td>";
					echo "<td align=center>" . $log[$i]["realname"]. "</td>";
					echo "<td align=center>" . $log[$i]["timestamp"]. "</td>";
					echo "<td align=center>" . $log[$i]["ip"]. "</td>";
					echo "<td align=center>" . $log[$i]["teamname"]. "</td>";
					echo "<td align=center>" . $log[$i]["filename"]. "</td>";
					echo "<td align=center>" . "<a href=setPrinted.php?realname=" . $log[$i]["realname"] . ">OK</a>" . "</td>";
				echo "</tr>";
			}
		?>
		</table>

		<br>

		<h3 align="center">
			Complete!!
		</h3>
		<?php
			$result = mysql_query("	SELECT ipmapteam.teamno, team.teamname, print.*
									FROM `ipmapteam`
									LEFT JOIN team
										ON ipmapteam.teamno=team.teamno
									RIGHT JOIN print
										ON ipmapteam.ip = print.ip
									WHERE print.hasprint = 1
									ORDER BY print.timestamp DESC");
			$log = array();
			for ($i = 0; $i < mysql_num_rows($result); $i++) {
				$log[$i] = mysql_fetch_array($result);
			}
		?>

		<table border="1" align="center">
			<tr>
				<th>TeamNo</th>
				<th>RealName</th>
				<th>Timestamp</th>
				<th>IP</th>
				<th>TeamName</th>
				<th>FileName</th>
			</tr>
		<?php
			for ($i = 0; $i < count($log); $i++) {
				echo "<tr>";
					echo "<td align=center>" . $log[$i]["teamno"]. "</td>";
					echo "<td align=center>" . $log[$i]["realname"]. "</td>";
					echo "<td align=center>" . $log[$i]["timestamp"]. "</td>";
					echo "<td align=center>" . $log[$i]["ip"]. "</td>";
					echo "<td align=center>" . $log[$i]["teamname"]. "</td>";
					echo "<td align=center>" . $log[$i]["filename"]. "</td>";
				echo "</tr>";
			}
		?>
		</table>


	</body>
	</body>
</html>
