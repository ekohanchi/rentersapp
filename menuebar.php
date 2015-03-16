<?php
/*
 * Created on Oct 29, 2008
 *
 */
?>

<html>
<head>
</head>
<body>

<form>
<input style="color: blue; font-weight: bold" type=button onclick="document.location.href='admin.php'" value="Admin Tools">
<input style="color: green; font-weight: bold" type=button onclick="document.location.href='viewCOIfiles.php'" value="View Receipts">
<input style="color: Chocolate; font-weight: bold" type=button onclick="document.location.href='manageReferrals.php'" value="Manage Referrals">
<input style="color: black; font-weight: bold" type=button onclick="document.location.href='iplog.txt'" value="View IP Log - Viewed & Store Referral">
<?php
if ($_SESSION['user'] == "ekohanchi") { ?>
	<input style="color: Maroon; font-weight: bold" type=button onclick="document.location.href='db/index.php'" value="DB Management">
	<input style="color: Maroon; font-weight: bold" type=button onclick="document.location.href='sessionmanager.php'" value="Session Management">
	
<?php
}?>
<br>
<input style="color: red; font-weight: bold" type=button onclick="document.location.href='renterreferral.php'" value="Submit New Referral">

</form>

</body>
</html>