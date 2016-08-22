<?php
$sqlServerName = "localhost";
$sqlUserName = "root";
$sqlPassWord = "tao19890221xie";

// Create connection
$con = mysql_connect($sqlServerName, $sqlUserName, $sqlPassWord);

// Check connection
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

// Select a database
$db_selected = mysql_select_db('mycompany',$con);
if (!$db_selected) {
	die ('Can\'t use the database mycompany: ' . mysql_error());
}
?>