<?php
	require_once("./include/config.php");
	$db = mysql_connect($dbhost, $dbuser, $dbpassword);
	$sel = mysql_select_db($dbname, $db);

	$userIP = $_SERVER["REMOTE_ADDR"];
	$result = mysql_query(" SELECT ipmapteam.teamno
							FROM `ipmapteam`
							LEFT JOIN team
								ON ipmapteam.teamno=team.teamno
							WHERE ipmapteam.ip = '$userIP'");

	$row = mysql_fetch_array($result);

	$teamno = $row["teamno"];
	$realname = "team" . $teamno . "_" . date('Ymd_his', mktime());
	if(!isset($_FILES["file"])){
		header("Location: index.php");
	}
?>
<?php
if ($_FILES["file"]["error"] > 0)
{
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else
{
//	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//	echo "Type: " . $_FILES["file"]["type"] . "<br />";
//	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//	echo "Stored in: " . $_FILES["file"]["tmp_name"];
}

$filename = $_FILES["file"]["name"];
$filetype = $_FILES["file"]["type"];
$filesize = $_FILES["file"]["size"];

if(	$filetype == "text/x-csrc" || 
	$filetype == "text/x-c++src" || 
	$filetype == "text/x-java" &&
	$filesize < 1024000){

	move_uploaded_file($_FILES["file"]["tmp_name"], "/upload/" . $realname);

	mysql_query("	INSERT INTO print
					(`ip`, `filename`, `realname`, `timestamp`, `hasprint`)
					VALUES
					('$userIP', '$filename', '$realname', NOW(), '0')
	");
?>
	<h1 align="center">
		Upload success!
	</h1>
	<h5 align="center">
		<font color="red">DO NOT Refresh this page!!</font>
		<br>
		Will be back to print service page 3 second later.
	</h5>
	<?php
		header('Refresh: 3; url=index.php');
	?>
<?php

}
else{
?>
	<h1 align="center">
		<font color="red">
			Just accept .c .cpp .java subfilename And small than 1MB
		</font>
	</h1>
<?php
}
?>
<div align="center">
	<h2>
		<a href="./index.php">Back</a>
	</h2>
</div>
