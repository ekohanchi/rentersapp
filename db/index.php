<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=encoding">
<title>DB Management</title>
</head>
    <body>
<?php 
include("../login.php");
?>
    <center><h1>Database Management</h1></center>
<input style="color: blue; font-weight: bold" type=button onclick="document.location.href='../admin.php'" value="Admin Tools">
<?php
$warn_msg="<font color=\"red\"> - WARNING this script has already been ran and it should NOT be ran again</font>"; 
?>
    <br>Select which action to run:
    <ul>
	    <li><a href="createTable.php?referralStatus">Create Referral Status Table</a><?php echo "$warn_msg"; ?></li>
	    <li><a href="createTable.php?referrals">Create Referrals Table</a><?php echo "$warn_msg"; ?>
	    <ul> <li><a href="loadData.php">Load Data into Referrals Table</a><?php echo "$warn_msg"; ?></li> </ul> </li>
    </ul>
    </body>
</html>