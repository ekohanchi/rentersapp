<?php
include("../include/configs.php");
    
session_start();
if (!isset($_SESSION['loggedIn'])) {
	echo "session loggedIn is NOT set";
    $_SESSION['loggedIn'] = false;
}
elseif (isset($_SESSION['loggedIn'])) {
	echo "session loggedIn is set";
}

$verified = false;
if ((isset($_POST['password'])) && (isset($_POST['user']))) {
	if ($_POST['user'] == $user1) {
		if (sha1($_POST['password']) == $pass1) {
			$verified = true;
		}
	}
    elseif ($_POST['user'] == $user2) {
		if (sha1($_POST['password']) == $pass2) {
			$verified = true;
		}
    } else {
        die ('Incorrect password');
    }
    
    if ($verified) {
		$_SESSION['loggedIn'] = true;
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
}
//exit();
// logout?
if(isset($_GET['logout'])) {
	//session_start();
    $_SESSION['loggedIn'] = false;
	
	echo "<font color=\"red\">You have successfully been logged out!</font>";
	include("menuebar.php");
  //exit();
}
?>
