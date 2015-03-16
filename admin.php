<?php
/*
 * Created on Sep 22, 2008
 *
 */
?>
<html>
<head>
<title>Renter Referral Admin</title>
</head>
<body>
<?php
include("login.php");
?>
<center>
<h1>Administrator Tools</h1>
</center>

<?php
include("menuebar.php");
?>

<b>Description of tools available, their purposes and functionality:</b>
<br>
<br>

<table width="800" border="0" align="left" cellpadding="2">
	<tr>
		<td>
		<b>Submit New Referral - Referral application</b><br>
		This is the page were users to submit a new referral to the
		system which will then be stored into the DB, and an email that a referral has come through will be sent out. If the following fields:
		"Leasing manager full name" or "First Name" contain the term "test" (not case sensitive) it will be assumed that the referral is a test
		referral and therefore the 'refstatus' value in the DB will be 10. Otherwise it will always assume it is a real referral and will set the
		'refstatus' value to 100. The email that is sent out once a referral goes through the application will also reflect whether the referral
		was a test referral or an actual referral.<br><br>
		<b>View Receipts - Certificate of Insurance files</b><br>
		Use this tool to view a list of all the receipts or certificate of insurance (COI) that are on file on the server. You can also choose to remove
		any or all of the COI files. Clicking on any of the COI files will bring up a copy of that COI file as it was available to the client when first using
		the renters referral application. A confirmation of deletion page will be available upon choosing to remove any or all of the COI files.<br><br>
		<b>Manage Referrals</b><br>
		Use this tool to view the referrals that have been processed by the application. For now the referrals can only be viewed in which every refstatus
		they are at. To view what each refstatus value means, simply view any referral and a table of all refstatus values and their description will be
		shown.<br>
		<u>Future enhancements:</u> A method to allow logged in users to change the refstaus of a referral. Also a serial check box to allow logged in users
		to select referrals on what kind (which refstatus) they wish to see. 
		</td>
	</tr>
</table>




</body>
</html>
