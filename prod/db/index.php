<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=encoding">
<title>DB Management</title>
<?php 
include("../login.php");
?>
</head>
    <body>
    <center><h1>Database Management</h1></center>
<input style="color: blue; font-weight: bold" type=button onclick="document.location.href='../admin.php'" value="Admin Tools">
    <br>Select which action to run:
    <ul>
	    <li><a href="createTable.php?referralStatus">Create Referral Status Table</a> </li>
	    <li><a href="createTable.php?referrals">Create Referrals Table</a>
	    <ul> <li><a href="loadData.php">Load Data into Referrals Table</a></li> </ul> </li>
    </ul>
    </body>
</html>