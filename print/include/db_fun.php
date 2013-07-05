<?php

	function connectdb(){
		$db = mysql_connect($dbhost, $dbuser, $dbpassword);
		var_dump($dbhost);
		//mysql_connect("localhost", "ttupc", "print");
		return $db;
	}

	function selectTable(){
		$sel = mysql_select_db($dbname, $db);
		return $sel;
	}

?>
