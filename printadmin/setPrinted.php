<?php
	require_once("./include/config.php");
	$db = mysql_connect($dbhost, $dbuser, $dbpassword);
	$sel = mysql_select_db($dbname, $db);
?>
<?php
	if(isset($_GET["realname"])){

		$realname = $_GET["realname"];

		mysql_query("	UPDATE print
						SET hasprint = 1
						WHERE realname = '$realname'");

		$result = rename("/upload/" . $realname, "/printed/" . $realname);

		if($result){
			echo "<h2 align=center>OK</h2>";
			header("Refresh: 1; url=index.php");
		}

	}
?>
