<?php
    /*
	*
	*	Timezone
	*
	*/
    date_default_timezone_set('America/Los_Angeles');
    
    /*
	*
	*	Domain Information
	*
	*/
    $subdomain = $_SERVER['HTTP_HOST'];
    $subdomain = explode('.', $subdomain);
    if($subdomain[0] == 'www')
        $domain = $subdomain[1];
    else
        $domain = $subdomain[0];
    	
	if(substr($domain, 0, 9) == 'localhost')
		$domain = 'localhost';
	
	/*
	*
	*	Error Reporting
	*
	*/
	ini_set('display_errors',1);
	error_reporting(E_ALL|E_STRICT);

	/*
	*
	*	Domain Information
	*
	*/	
    switch($domain):
        case 'localhost' :
            $sqlDatabase = 'rts_eagle';
            $sqlUsername = 'root';
            $sqlPassword = 'root';
            $sqlHost = 'localhost';
            $relative = '/projects/RTS-Eagle/';
        break;
	endswitch;

	/*
	*
	*	Errors
	*
	*/
	$errors = array();

?>