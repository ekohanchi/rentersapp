<html>
<head>
<title>Manage Renter Referrals</title>
</head>
<body>

<?php

/*
 * last modified: 10/11/09
 *
 * this script will display 3 different categories, only the uniqueid of the referral
 * 1. submitted referrals (subref) - the uniqueid of all the submitted referral. referrals that have come
 * 		through the renterreferral application
 * 2. successful referrals (sucref) - these are the the submitted referrals that eneded up in a successful lead
 * 		as well as a sale in renters insurance. there needs to be a method for moving selected submitted referrals
 * 		to successful referrals section
 * 3. compensated referrals (comref) - these are referrals that i have been compensated for. they will no longer be on the
 * 		successful referrals list but on the compenated on. this action can only be done by me.
 *
 * the combination of all referrals in all the above categories will be the list of all referrals that have gone through
 * the rentersreferral application.
 *
 * DB fields: uniqueid, timestampvalue, referralid, status (1,2,3)
 * General Notes: data needs to be uploaded to the DB in the begining so that past transactions have a starting point
 * 			in the subref section. look into uploading this data via excel. the list of referral ids in the subref section
 * 			should have check boxes next to them, and allow checked items to be moved to the sucref section. this ultimately
 * 			means the status field of the record changes from 1 to 2 in the DB. once the referralids are in the sucref section
 * 			they are removed from the subref section. upon payment or compensation for the referrals, some or all of the
 * 			referral ids are moved to the final stage/status of a referral which is the comref stage. only the admin
 * 			can change the status of a referralid to 3, which means they have been compensated.
 *
 * refstatus
 * 0: deleted referrals (no text file availble on server)
 * 10: test referral
 * 100: submitted referrals
 * 200: successful referrals
 * 300: unsuccessful referrals
 * 400: closed referrals
 * 500: compensated referrals
 *
 */

include("login.php");
?>
<center>
<h1>Manage Referrals</h1>
</center>
<?php
include("include/configs.php");
include("menuebar.php");

function runQuery($stmt, $option) {
	//option=values: displays values for sql statment
	//option=count: displays count for sql statement
	$query = $stmt;
	$result = mysql_query($query);
	$num=mysql_numrows($result);
	$i=0;
	while ($i < $num) {
		//$id=mysql_result($result,$i,"id");
		$referralid=mysql_result($result,$i,"referral_id");
		if ($option == "values") {
			echo "<a href=\"viewReferral.php?refid=$referralid\">$referralid</a><br>";
			//echo "<input type=\"radio\" name=\"referral\" value=\"$referralid\"/> <a href=\"viewReferral.php?refid=$referralid\">$referralid</a><br>";
		}
		$i++;
	}
	if ($option == "count") {
		echo "$i";
	}
}
function changeRefstatus($newrefstatus, $referralid, $referrals_table) {
	$query="Select refstatus from $referrals_table where referral_id='$referralid'";
	$result=mysql_query($query);
	//$row=mysql_fetch_row($result);
	$org_refstatus=mysql_result($result,0,"refstatus");
	//echo "orginal ref status: $org_refstatus";
	
		//check if referral id exists, if not exit
	$query="Select referral_id from $referrals_table where referral_id='$referralid' limit 1";
	$result=mysql_query($query);
	$num_rows=mysql_numrows($result);
//		echo "<br>num rows value: $num_rows<br>";
//		echo "Query: $query<br>";
	
	if ($num_rows == 1) {
		if ($org_refstatus != $newrefstatus) {
			if ($newrefstatus == 400 && $org_refstatus == 100) {
				$query="Update $referrals_table set refstatus='$newrefstatus' where referral_id='$referralid'";
				mysql_query($query);
				echo "<font color=\"green\">Update completed! The status of $referralid has been changed from $org_refstatus to $newrefstatus</font>";
			}
			else {
				echo "<font color=\"red\">ERROR In order for a referralid's status to be changed to closed, its current status must be submitted.</font>";
			}
			
		}
		else {
			echo "<font color=\"red\">ERROR new refstatus is the same as current one. No change was done.</font>";
		}
	}
	else {
		echo "<font color=\"red\">ERROR referralid '$referralid' does not exist.</font>";
	}
}

include("db/opendb.php");

$query_all = "Select referral_id from $referrals_table;";
$query_deleted = "Select referral_id from $referrals_table where refstatus=0";
$query_test = "Select referral_id from $referrals_table where refstatus=10";
$query_submitted = "Select referral_id from $referrals_table where refstatus=100";
$query_successful = "Select referral_id from $referrals_table where refstatus=200";
$query_closed = "Select referral_id from $referrals_table where refstatus=400";
$query_compensated = "Select referral_id from $referrals_table where refstatus=500";

?>
<form name="refstatusChangeForm" method="post" action="manageReferrals.php">
	Enter the referralid of the referral you wish to change its status to <b>closed</b>:
	<input type="text" name="txt_referralid" size="25" maxlength="20">
	<input type="hidden" name="hdn_status" value="statusToclosed">
	<input type="submit" value="Submit"><br>
</form>
<?php
if (isset($_REQUEST['hdn_status'])) {
	if (isset($_REQUEST['txt_referralid']))  {
		$refid=trim($_REQUEST['txt_referralid']);
	//		echo "Referralid value: [$refid]";
		if ($refid == '') {
			echo "<font color=\"red\">ERROR A referralid must be entered, before it can be processed. No referralid status was changed.</font>";
		}
		else {
			changeRefstatus(400, $refid, $referrals_table);
		}
	}
}

include("monthlyReport.php");
?>

<table width="100%" align="center" border="1" cellpadding="2" cellspacing="2">
	<tr>
		<td bgcolor="#cccccc" width="180" align="center"><b>All referrals (<?php runQuery("$query_all", "count"); ?>)</b></td>
		<td bgcolor="#cccccc" width="180" align="center"><b>Deleted referrals (<?php runQuery("$query_deleted", "count"); ?>)</b></td>
		<td bgcolor="#cccccc" width="180" align="center"><b>Test referrals (<?php runQuery("$query_test", "count"); ?>)</b></td>
		<td bgcolor="#cccccc" width="180" align="center"><b>Submitted referrals (<?php runQuery("$query_submitted", "count"); ?>)</b></td>
		<td bgcolor="#cccccc" width="180" align="center"><b>Closed referrals (<?php runQuery("$query_closed", "count"); ?>)</b></td>
		<td bgcolor="#cccccc" width="180" align="center"><b>Compensated referrals (<?php runQuery("$query_compensated", "count"); ?>)</b></td>
	</tr>
	<tr>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_all", "values"); ?></td>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_deleted", "values"); ?></td>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_test", "values"); ?></td>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_submitted", "values"); ?></td>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_closed", "values"); ?></td>
		<td valign="top" align="center">&nbsp;<?php runQuery("$query_compensated", "values"); ?></td>
	</tr>
</table>

<?php
include("db/closedb.php");
?>
</body>
</html>
