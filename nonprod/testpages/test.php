<?php
function viewFilesInDir () {
	$dir="/tmp";
	//$dir="/Applications/MAMP/tmp/php";
	$filecount=0;
	if (is_dir($dir)) {
	 	if ($dh = opendir($dir)) {
	 		while (($rec = readdir($dh)) != false) {
				//$counter=$filecount++;
	 			
		 		if (strlen(strtolower(strpos($rec,"sess_"))) > 0) {
					$counter=$filecount++;
		 			$fullpath="$dir/$rec";
		 			$fileperms=fileperms($fullpath);
		 			echo "$counter: $rec FullPath: $fullpath FilePermissions: $fileperms<br>";
		 			
		 			unlink($fullpath);
				}
	
				//echo "$counter : $rec <br>";
	 		}
	 		closedir($dh);
	 		//echo "<h4>$text1: $filecount </h4>";
	 		//echo "$text2:<br>";
	 		//echo "$filelist";
	 		echo "Done!";
	 	}
	 }
}

//$savepath=session_save_path();
//echo "session save path: $savepath <br>";

//$login_info = array(
//  'ekohanchi' => 'adminpass4rr',
//  'kkane' => 'pass4rentersapp'
//);
//
//foreach($login_info as $key=>$val){
//	echo "Key: $key <br>";
//	echo "Val: $val <br>";
//}

//$guestpasswd = sha1("guestpasswd");
//echo "Guest password: $guestpasswd";

//print($_SESSION);

//$file = $_SERVER['DOCUMENT_ROOT'] . "20090815115938_01.txt"; //Path to your *.txt file
//$contents = file($file);
////$contents2 = file("../datafiles/20090815115938_01.txt");
//$string = implode($contents2);
//
//echo $string; 

//include("../datafiles/20090815115938_01.txt");


//$sha1value=sha1(pass4rentersapp);
//echo "sha1value: $sha1value";
//if (is_writable(session_save_path())){
//	echo "session path $session_save_path() is writeable";
//} else {
//	echo "session path is not writeable";
//}

//echo "print value starts: \r\n";
//print_r($_SESSION);
//echo "print value ends: \r\n";
//
//print $PHPSESSID;

//$_SESSION['loggedIn'] = true;
//if ($_SESSION['loggedIn'] == true) {
//	echo "session loggedIn equals true";
//}

//session_start();
//if (!isset($_SESSION['loggedIn'])) {
//    //$_SESSION['loggedIn'] = false;
//    //echo "session loggedin is not set, and it's value has now been set to false";
//    echo "session loggedin is NOT set<br>";
//}
//if ($_SESSION['loggedIn']) {
//	echo "session logged in value is true<br>";
//}
//if (!$_SESSION['loggedIn']) {
//	echo "session logged in value is false<br>";
//}
//
//$sessionid_val = session_id();
//echo "session id value: $sessionid_val <br>";

//include("../menuebar.php");
//header ("Location: 20090815115938_01.txt");

//$modifieddate = date("Y-m-d H:i:s", time() + -3.00 * 3600);
//echo "$modifieddate"

//$uniqueid = date("YmdHis", $Unixtime + -3.00 * 3600);	//new method of uniqueid
//$fileid = "${uniqueid}_01";

//$rec = "01012009211737_01.html";
//if (preg_match("/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/", $rec)) {
//	echo "the value of rec matches the pattern specified";
//} else {
//	echo "pattern does not match";
//	echo "<br>Rec value: $rec";
//}



//$password = "Fyfjk34sdfjfsjq7";
//
//if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password)) {
//    echo "Your passwords is strong.";
//} else {
//    echo "Your password is weak.";
//}

//$a = "value 1";
//$a = "$a Test";
//
//$b = "hello";
//
//echo "value of a: $a";

//$ct = time();
//$ct = gmstrftime();
//$ctf = date("g:i:s", $ct);
//echo "Time value: $ctf";
//
//echo "<br>";
////$time_offset ="0"; // Change this to your time zone
////$time_a = ($time_offset * 120);
//$time = date("g:i:s",time() + (0 * 120));
//echo 'Current time is : '.$time;

//$sn_long=$_SERVER["SCRIPT_NAME"];
//$break = Explode('/', $_SERVER["SCRIPT_NAME"]);
//$scriptname= $break[count($break) - 1];
//echo "scriptname: $scriptname";

$refstatus_msg="Test";
$refid="20091101010948_01";

//$message = "A $refstatus_msg referral has been processed\nUser's IP Address: $ip\nReferralid stored:<a href=\"viewReferral.php?refid=$refid\"> $refid</a>";
//echo "Message value: $message";

	$ip = getenv('REMOTE_ADDR');					// get ip address 
	$to = "ekohanchi@gmail.com";
	$subject = "Testing";
	$message = "A $refstatus_msg referral has been processed<br>";
	$message .= "User's IP Address: $ip<br>";
	$message .= "Referralid stored:<a href=\"www.fastform.biz/viewReferral.php?refid=$refid\"> $refid</a>";
	//$message = "A $refstatus_msg referral has been processed\nUser's IP Address: $ip\nReferralid stored: $refid</a>";

//	$headers = 'From: rentersreferral@noreply.com' . "\r\n" .
//    'Reply-To: rentersreferral@noreply.com' . "\r\n" .
//    'X-Mailer: PHP/' . phpversion();
	
	$headers = "From: rentersreferral@noreply.com\r\n";
	$headers .= "Reply-To: rentersreferral@noreply.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail( $to, $subject, $message, $headers );
	

?>

<!--<html><head><title>User Verification</title></head>-->
<!--  <body>-->
<!--  <h1><center>User Login</center></h1>-->
<!--  <style>-->
<!--  	input { border: 1px solid black; }-->
<!--  </style>-->
<!--  <div style="width:500px; margin-left:auto; margin-right:auto; text-align:center">-->
<!--    <form method="post">-->
<!--        <h4>Please enter your designated username & password<br>to access this page</h4>-->
<!--    -->
<!--    <table border="0" cellpadding="8"  bgcolor="#FFCC99" width="350" align="center">-->
<!--	    <tr>-->
<!--		    <td align="right">Username:</td>-->
<!--		    <td align="left"><input type="input" name="user"></input></td>-->
<!--	    </tr>-->
<!--	    <tr>-->
<!--		    <td align="right">Password:</td>-->
<!--		    <td align="left"><input type="password" name="password"></input></td>-->
<!--	    </tr>-->
<!--	    <tr>-->
<!--		    <td align="center" colspan="2"><input type="submit" name="submit" value="Login"></input></td>-->
<!--	    </tr>-->
<!--    </table>-->
<!--    </form>-->
<!--  </body>-->
<!--</html>-->

<!--<a href="admin.php">Login me back in</a> -->

<!--<b>Current Date:</b> <script language="JavaScript">now=new Date(); dateFormat(now, "dddd, mmmm dS, yyyy, h:MM:ss TT"); document.write(now.toLocaleString()); </script>-->


