<?php
include("include/configs.php");

session_start();

function print_login_form() {
echo '	<html><head><title>User Verification</title></head>
		  <body>
		  <style>
			input { border: 1px solid black; }
		  </style>
		  <!--<div style="width:500px; margin-left:auto; margin-right:auto; text-align:center"> -->
			<center>
			<form method="post">
				<h3>Please enter your designated username & password<br>to access this page</h3>
			
			  User:<br><input type="input" name="user"></input> <br>
			  Password:<br><input type="password" name="password"> <br><br>
			  <input type="submit" name="submit" value="Login">
			</form>
			</center>
		  </body>
		</html>';
//exit();
}

if (!isset($_SESSION['loggedIn'])) {
	echo "session loggedin is not set";
	print_login_form();
}

$verified = false;
if ((isset($_POST['password'])) && (isset($_POST['user']))) {
	echo "password and user is set";
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

// logout?
if(isset($_GET['logout']) && isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
    unset($_SESSION['loggedIn']);
    session_destroy();
	
	echo "<font color=\"red\"><b>You have successfully been logged out!</b></font>";
	print_login_form();
	//include("menuebar.php");
}
?>
