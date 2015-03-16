<?php
include("include/configs.php");

session_start();
//session_register("loggedin");
//session_register("username");

//$loginval=$_SESSION['loggedin'];
//$userameval=$_SESSION['username'];
//$sessid=$session_id();
//echo "loginval: [$loginval] and usernameval: [$usernameval] <br>";


//if (!isset($_SESSION['loggedIn'])) {
//    $_SESSION['loggedIn'] = false;
//}

//if (session_id() == "") {
//	session_start(); // if no active session we start a new one
//	echo "sessionid value equals to nothing";
//	echo $_SESSION['loggedIn'];
//}

$verified = false;
if ((isset($_POST['password'])) && (isset($_POST['user']))) {
	if ($_POST['user'] == $user1) {
		if (sha1($_POST['password']) == $pass1) {
			$verified = true;
			$username = $user1;
		}
	}
    elseif ($_POST['user'] == $user2) {
		if (sha1($_POST['password']) == $pass2) {
			$verified = true;
		}
    }
    else {
        die ('Incorrect password');
    }
    
    if ($verified) {
		$_SESSION['loggedIn'] = true;
		echo "loggedInValue=". $_SESSION['loggedIn'];
		$HTTP_SESSION_VARS ["loggedin"] = true;
		$HTTP_SESSION_VARS ["username"] = $username;
    }
} 

if (!$_SESSION['loggedIn']) {
//if ($HTTP_SESSION_VARS['loggedin'] == false) {
	if (session_id() == "") {
		session_start();
		echo "sessionid value equals to nothing";
		echo $_SESSION['loggedIn'];
	}
	session_register("loggedin");
	session_register("username");
	
?>

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
exit(); }

// logout?
if(isset($_GET['logout'])) {
	//session_start();
    $_SESSION['loggedIn'] = false;
	
	echo "<font color=\"red\">You have successfully been logged out!</font>";
	include("menuebar.php");
  exit();
}
?>