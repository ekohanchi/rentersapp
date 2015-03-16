<?php
include("include/configs.php");

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
	}
	else {
		include("menuebar.php");
		die ('Incorrect username and/or password!');
	}
}


if (!$_SESSION['loggedIn']) { ?>

<html><head><title>User Verification</title></head>
  <body>
  <style>
  	input { border: 1px solid black; }
  </style>
  <div style="width:500px; margin-left:auto; margin-right:auto; text-align:center">
    <form method="post">
        <h3>Please enter your designated username & password<br>to access this page</h3>
    
      User:<br><input type="input" name="user"></input> <br>
      Password:<br><input type="password" name="password"> <br><br>
      <input type="submit" name="submit" value="Login">
    </form>
  </body>
</html>

<?php
exit();
}
// logout?
if(isset($_GET['logout'])) {
	//session_start();
    $_SESSION['loggedIn'] = false;
    unset($_SESSION['loggedIn']);
    session_destroy();
	
	echo "<font color=\"red\">You have successfully been logged out!</font>";
	include("menuebar.php");
  exit();
}
?>