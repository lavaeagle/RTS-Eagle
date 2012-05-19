<?php
/* get markes from file */
$dataPath = '';
$markerDataFile = 'markers.json';
$markerText = file_get_contents($markerDataFile);
 
/* create array list from markers */
$markerList = json_decode($markerText,true);
 
/* check if new marker is posted */
if( !empty($_POST['marker'])  ){
 
	/* get new marker data */
	$markerData =  $_POST['marker'];
 
	/* add additional marker information */
	$markerData['ip'] = $_SERVER['REMOTE_ADDR'];
	$markerData['created'] = time();
 
 
	/*  create detail marker content file */
	$markerContent = "<h2>" . $markerData['creator'] . "-> " . $markerData['name'] . "</h2>";
	$markerContent .= "<p>" . date("D M j G:i:s T Y") . "</p>";
 
	/* save marker file to server */
	$markerFile = $dataPath . $markerData['id'] . ".html";
	file_put_contents($markerFile  , $markerContent);
 
        /* add new marker to existing list */
        $markerList['markers'][] = $markerData;
 
        /* convert comments to string */
        $markerText = json_encode($markerList);
 
        /* save comment to file */
        file_put_contents($markerDataFile, $markerText);
 
        /* return newly created marker */
	echo json_encode($markerData);
}else{
	echo "Invalid request";
}
?>