<?php
include("include/configs.php");

function print_login_form () {
	echo '<html><head><title>User Verification</title></head>
  <body>
  <h1><center>User Login</center></h1>
  <style>
  	input { border: 1px solid black; }
  </style>
  <div style="width:500px; margin-left:auto; margin-right:auto; text-align:center">
    <form method="post">
        <h4>Please enter your designated username & password<br>to access this page</h4>
    
    <table border="0" cellpadding="8"  bgcolor="#FFCC99" width="350" align="center">
	    <tr>
		    <td align="right">Username:</td>
		    <td align="left"><input type="input" name="user"></input></td>
	    </tr>
	    <tr>
		    <td align="right">Password:</td>
		    <td align="left"><input type="password" name="password"></input></td>
	    </tr>
	    <tr>
		    <td align="center" colspan="2"><input type="submit" name="submit" value="Login"></input></td>
	    </tr>
    </table>
    </form>
  </body>
</html>';
}

function sessionStaleCheck () {
	//Determining how long session has been active for
		//and removing stale sessions
	$sessionTimeOut = (60*5);	//5 Minutes
	if((isset($_SESSION['startTime'])) && ($_SESSION['loggedIn'])) {
	  $timeDiff = time() - $_SESSION['startTime'];
	  if ($timeDiff >= $sessionTimeOut) {
	  	echo "<font color=\"red\">Your session has expired. You've been logged out.<br><br>Please <a href=\"admin.php\">login again.</a></font><br>";
	  	session_destroy();  	
	  	//include("menuebar.php");
	  	exit ();
	  } else {
	  	$_SESSION['startTime'] = time();
	  }
//	  $_SESSION['sessTimeLeft'] = ($sesionTimeOut - abs($_SESSION['startTime'] - time()));
//	  $_SESSION['sessTimeLeft'] = (((time() + $sessionTimeOut) - time()) / 60);
//	  $value = $_SESSION['sessTimeLeft'];
//	  echo "value: $value";
	} else{
	  $_SESSION['startTime'] = time();
	}
}

$ip = getenv('REMOTE_ADDR');
		//in testing env $ip="::1" for some reason
if ($ip == "::1") {
	$ipcleaned = "000.000.000.000";
} else {
	$ipcleaned = $ip;
}
$ipformatted = str_replace(".","Z",$ipcleaned);

session_id($ipformatted);
session_start();

sessionStaleCheck ();

if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}

$verified = false;
if ((isset($_POST['password'])) && (isset($_POST['user']))) {
	$userinput=$_POST['user'];
	$passinput=$_POST['password'];
	foreach($login_info as $key=>$val) {
		if (($userinput == $key) && (sha1($passinput) == $val)) {
			$verified = true;
		}
	}
	if ($verified) {
		$_SESSION['loggedIn'] = true;
		$_SESSION['user'] = $userinput;
//		header ("Location: admin.php");
	}
	else {
		//die ('Incorrect username and/or password!');
		echo "<font color=\"red\">Incorrect username and/or password!</font>";
		header ("Location: admin.php");
	}
}


if (!$_SESSION['loggedIn']) {
	print_login_form();
	exit();
}
if (($_SESSION['loggedIn']) && !isset($_GET['logout'])) {
	$userloggedin = $_SESSION['user'];
	$loggedinsince = date("g:i:s", $_SESSION['startTime'] + -3.00 * 3600);
	$sessionTimeLeft = date("i:s", $_SESSION['sessTimeLeft'] + -3.00 * 3600);
	echo "Status: Logged in";
	echo " | <b>User: $userloggedin</b>";
	echo " | Last session refresh: $loggedinsince";
//	echo " | Session time left: $sessionTimeLeft";
}

// logout?
if(isset($_GET['logout'])) {
	//session_start();
    $_SESSION['loggedIn'] = false;
    unset($_SESSION['loggedIn']);
    session_destroy();
	
	echo "<font color=\"red\">You have successfully been logged out!</font>";
	echo "<br><br> <a href=\"admin.php\">Login me back in</a>";
	exit();	
}
?>