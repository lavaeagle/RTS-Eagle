<?php

function getMaxUploadSize() {
	$max_upload = (int)(ini_get('upload_max_filesize'));
	$max_post = (int)(ini_get('post_max_size'));
	$memory_limit = (int)(ini_get('memory_limit'));
	$upload_mb = min($max_upload, $max_post, $memory_limit);
	return $upload_mb;
}

function sortBySubkey(&$array, $subkey, $sortType = SORT_ASC) {
    foreach ($array as $subarray) {
        $keys[] = $subarray[$subkey];
    }
    array_multisort($keys, $sortType, $array);
}

/*
*
*	Get the $_GET or $_POST value of a variable
*
*/
function getVar($var) {
	$return = 0;
	
	if(isset($_GET[$var]))
		$return = cleanInput($_GET[$var]);
		
	if(isset($_POST[$var]))
		$return = cleanInput($_POST[$var]);
		
	return $return;
}

/*
*
*	Autoloads Classes
*
*/
function __autoload($classname) { 
    include_once('classes/'.$classname.'.class.php');
} 

/*
*
*   Returns file extension
*
*/
function getExtension($file) {
    return pathinfo($file, PATHINFO_EXTENSION);
}

function makeLinks($text) {
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    // Check if there is a url in the text
    if(preg_match($reg_exUrl, $text, $url)):
        return preg_replace($reg_exUrl, "<a target='_blank' href=\"{$url[0]}\">{$url[0]}</a> ", $text);
    else:
        return $text;
    endif;
}

function getAgoTime($date)
{
    //$date = "2011-12-17 17:45"
    // year-month-day hour:minute
    //echo $result = Agotime($date); // 2 days ago

    if(empty($date))
        return "No date provided";
    
    if(strlen($date) == 10)
        $date = unixToSql($date);
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
 
    $now             = time();
    $unix_date      = strtotime($date);
 
    // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }
 
    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
 
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
 
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
 
    $difference = round($difference);
 
    if($difference != 1) {
        $periods[$j].= "s";
    }

    if($periods[$j] != 'seconds' && $periods[$j] != 'second')
        return "$difference $periods[$j] {$tense}";
    else
        return "just now";
}

/*
*
*	Messages: Alerts, Errors, Success, Info
*
*/
function addMessage($message, $messageType="success")
{
    $_SESSION['message'] = $message;
    $_SESSION['messageType'] = $messageType;
}

function clearMessages()
{
    unset($_SESSION['message']);
    unset($_SESSION['messageType']);
}

/*
*
*	String processing container functions
*
*/
function cleanInput($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = cleanScript($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanScript($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}

function cleanScript($input) {
	$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	);
	
	$output = preg_replace($search, '', $input);
	$output = str_replace(array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavaible', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragdrop', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterupdate', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmoveout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'), "", $output);
	return $output;
}

/*
*
*	Truncating Functions
*
*/
function truncateString($phrase, $max_words=10) {
    $phrase_array = explode(' ',$phrase);
    if(count($phrase_array) > $max_words && $max_words > 0)
        $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
    return $phrase;
}

function truncateCharacters($string, $maxChars=16) {
	if(strlen($string) > $maxChars)
		$string = substr($string, 0, $maxChars) . '...';

	return $string;
}

/*
*
*	Boolean checks
*
*/
function isImage($image) {
    $image = strtolower($image);

    $extension = getExtension($image);
    $allowed = array('jpg', 'png', 'gif', 'jpeg');
    if(!in_array($extension, $allowed))
        return false;
    else
        return true;
}

function isUrl($url) {
    $validation = filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
    
    if ( $validation ) $output = TRUE;
    else $output = FALSE;
    
    return $output;
}

function isEmail($email) {
    if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
    {
        list($username,$domain)=explode('@',$email);
        if(!checkdnsrr($domain,'MX')) {
            return false;
        }
        return true;
    }
    return false;
}

/*
*
*	Create unique value
*
*/
function uniqueId($length=30) {
    $salt       = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".time();
    $len        = strlen($salt);
    $makepass   = '';
    mt_srand(10000000*(double)microtime());
    for ($i = 0; $i < $length; $i++) {
        $makepass .= $salt[mt_rand(0,$len - 1)];
    }
    return $makepass;
}

?>