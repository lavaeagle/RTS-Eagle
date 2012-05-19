<?php

/*
*
*	START SESSION
*
*/
if(session_id() == ''):
	ob_start();
	session_start();
endif;

/*
*
*	REQUIRED FILES
*
*/
require_once 'inc/functions.php';
require_once 'inc/globalVars.php';

if($domain!='localhost')
	redirectToHTTPS();

/*
*
*	DEFINE SQL
*
*/
$connection = mysql_connect($sqlHost, $sqlUsername, $sqlPassword) or die("Error connecting to database server");
mysql_select_db($sqlDatabase, $connection) or die("Error selecting database.");

/*
*
*	PAGE/METHOD VARIABLES
*
*/
#remove the directory path we don't want 
$request  = str_replace("/projects/RTS-Eagle/", "", $_SERVER['REQUEST_URI']); 

#split the path by '/'  
$params = explode("/", $request); 

if(count($params) > 0):
	if(file_exists("class/{$params[0]}.class.php")):
		echo 'class';
	else:
		$p = $params[0];
		require_once('app.php');
	endif;
endif;

?>