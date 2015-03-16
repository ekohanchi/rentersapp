<html>
<head>
<title>View Referral</title>
<script language="javascript">
function printpage()
 {
  window.print();
 }
</script>
</head>
<body>

<?php
include("login.php");
?>
<center>
<h1>View Referral</h1>
</center>
<?php
include("include/configs.php");
//include("menuebar.php");
?>
<input style="color: Chocolate; font-weight: bold" type=button
	onclick="document.location.href='manageReferrals.php'"
	value="Manage Referrals">
<input type="button" value="Print" onclick="printpage();">
<?php
$referralsField_array = array(
	'0' => "id",
	'1' => "inserted",
	'2' => "refstatus",
	'3' => "referral_id",
	'4' => "prepopulatedACN",
	'5' => "aciflname",
	'6' => "aciacn",
	'7' => "acistreet",
	'8' => "acicity",
	'9' => "acistate",
	'10' => "acizip",
	'11' => "fname1",
	'12' => "lname1",
	'13' => "dobmonth1",
	'14' => "dobday1",
	'15' => "dobyear1",
	'16' => "dlnum1",
	'17' => "dlstate1",
	'18' => "sex1",
	'19' => "fname2",
	'20' => "lname2",
	'21' => "dobmonth2",
	'22' => "dobday2",
	'23' => "dobyear2",
	'24' => "dlnum2",
	'25' => "dlstate2",
	'26' => "sex2",
	'27' => "istreet",
	'28' => "icity",
	'29' => "istate",
	'30' => "izip",
	'31' => "mstreet",
	'32' => "mcity",
	'33' => "mstate",
	'34' => "mzip",
	'35' => "areacode",
	'36' => "cell3",
	'37' => "cell4",
	'38' => "email",
	'39' => "caryear1",
	'40' => "carmake1",
	'41' => "carmodel1",
	'42' => "caryear2",
	'43' => "carmake2",
	'44' => "carmodel2",
	'45' => "caryear3",
	'46' => "carmake3",
	'47' => "carmodel3",
	'48' => "motocyear1",
	'49' => "motocmake1",
	'50' => "motocmodel1",
	'51' => "motocengs1",
	'52' => "effweekday",
	'53' => "effmonth",
	'54' => "effmday",
	'55' => "effyear",
	'56' => "ppc",
	'57' => "po"
);

if(isset($_GET['refid'])) {
	$refID = $_GET['refid'];

	include("db/opendb.php");
	//echo "<br>";

	$selectQuery = "select * from $referrals_table where referral_id='$refID'";
	$result = mysql_query($selectQuery);
	$num = mysql_num_fields($result);

	$i=0;
	$db_field = mysql_fetch_assoc($result);
	if($db_field != '') {
		?>
		<pre>
		<table border="0" width="100%">
		<tr>
		<td>
		<table border="1">
		<?php
		while ($i < $num) { ?>
			<tr>
			<?php
			$field = $referralsField_array[$i];
			$value = $db_field[$field];
			//	echo "$field: $value<br>";
			echo "<td>$field</td>";
			echo "<td>$value&nbsp;</td>";
			?>
			</tr>
			<?php
			$i++;
		}
		?>
		</table>
		</td>
		<td>
		</td>
		<?php
		
		// Displaying refstatus table
		$selectQuery = "select * from $refstatus_table";
		$result = mysql_query($selectQuery);
		$num = mysql_num_rows($result);

		$j=0;
		?>
		<td valign="top" align="right">
		<table border="1" >
		<tr>
		<td>refstatus</td>
		<td>description</td>
		</tr>

		<?php
		while ($j < $num) {
			$rval = mysql_result($result, $j, 'refstatus');
			$dval = mysql_result($result, $j, 'description');
			?>
			<tr>
			<?php
			echo "<td>$rval</td>";
			echo "<td>$dval</td>";
			?>
			</tr>
			<?php
			$j++;
		}
		?>
		</table>
		</td>
		</tr>
		</table>
		</pre>
		<?php
	}
	else {
		echo "<font color=\"red\">ERROR referral id: $refID not found.</font>";
	}

	include("db/closedb.php");
}
else {
	echo "<font color=\"red\">ERROR referral id not specified</font>";
}

?>


</body>
</html>
