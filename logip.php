<?php
/*
 * Created on Jan 5, 2008
 *
 */
 
$log_file = "iplog.txt"; 
$ip = getenv('REMOTE_ADDR');					// get ip address 
$fp = fopen("$log_file", "a");					// open file for writing, appending
$Unixtime = time();
$today = date("F j, Y, g:i:s a \P\S\T", $Unixtime + -3.00 * 3600);                 // March 10, 2001, 5:16 pm

if (file_exists ($log_file)) {
	$rows = file ($log_file);
	$linecnt = count ($rows);
	$linenum = $linecnt + 1;
}

$user = "";
if ($ip == "75.57.2.49") {
	$user = "Eli";
}
elseif ($ip == "205.166.218.38" || $ip == "205.242.229.37" || $ip =="205.166.218.35") {
	$user = "Kevin";
}
else {
	$user = "Unknown";
}

//$scriptname=basename(__FILE__);

$scriptname_long = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $scriptname_long);
$scriptname= $break[count($break) - 1]; 
//echo $scriptname; 

fputs($fp, "$linenum) $today - $ip - $scriptname - $user\n");					// write current date time and ip to file

flock($fp, 3);									//close up file
fclose($fp);

?>
