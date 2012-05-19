<?php
$sqlHost = 'localhost';
$sqlUsername = 'root';
$sqlPassword = 'root';
$sqlDatabase = 'rts_eagle';

$connection = mysql_connect($sqlHost, $sqlUsername, $sqlPassword) or die("Error connecting to database server");
mysql_select_db($sqlDatabase, $connection) or die("Error selecting database.");

$json = array();
$markerSql = mysql_query("SELECT * FROM markers") or die(mysql_error());
while($markerRow = mysql_fetch_assoc($markerSql)):
	$json[] = $markerRow;
endwhile;

header('Content-type: application/json');
echo "{\"markers\": ".json_encode($json)."}";
?>