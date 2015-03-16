<html>
<head>
</head>
<body>
<?php
include("include/configs.php");
//include("db/opendb.php");

function getMonthlyCount ($table, $lrange, $hrange) {
	$query = "select * from $table where inserted >= '$lrange' and inserted < '$hrange'";
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	echo "$num";
}

function displaySingleYear ($table, $year) {
	$next_year = $year + 1;
	echo "<tr><td>Janurary $year:</td><td>"; getMonthlyCount($table,"$year-01","$year-02"); echo "</td></tr>";
	echo "<tr><td>February $year:</td><td>"; getMonthlyCount($table,"$year-02","$year-03"); echo "</td></tr>";
	echo "<tr><td>March $year:</td><td>"; getMonthlyCount($table,"$year-03","$year-04"); echo "</td></tr>";
	echo "<tr><td>April $year:</td><td>"; getMonthlyCount($table,"$year-04","$year-05"); echo "</td></tr>";
	echo "<tr><td>May $year:</td><td>"; getMonthlyCount($table,"$year-05","$year-06"); echo "</td></tr>";
	echo "<tr><td>June $year:</td><td>"; getMonthlyCount($table,"$year-06","$year-07"); echo "</td></tr>";
	echo "<tr><td>July $year:</td><td>"; getMonthlyCount($table,"$year-07","$year-08"); echo "</td></tr>";
	echo "<tr><td>August $year:</td><td>"; getMonthlyCount($table,"$year-08","$year-9"); echo "</td></tr>";
	echo "<tr><td>September $year:</td><td>"; getMonthlyCount($table,"$year-09","$year-10"); echo "</td></tr>";
	echo "<tr><td>October $year:</td><td>"; getMonthlyCount($table,"$year-10","$year-11"); echo "</td></tr>";
	echo "<tr><td>November $year:</td><td>"; getMonthlyCount($table,"$year-11","$year-12"); echo "</td></tr>";
	echo "<tr><td>December $year:</td><td>"; getMonthlyCount($table,"$year-12","$next_year-01"); echo "</td></tr>";
}

$sdate = "2009-01";
$edate = date("Y-m");

?>

<table border="0" width="100%">
	<tr><td>
	Count of referrals processed for each month:
	<table border="1" cellpadding="2" cellspacing="2">
	<?php displaySingleYear ($referrals_table, 2009); ?>
	
	<!-- 	<tr><td>Janurary 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-01","2009-02"); ?></td></tr>
		<tr><td>February 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-02","2009-03"); ?></td></tr>
		<tr><td>March 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-03","2009-04"); ?></td></tr>
		<tr><td>April 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-04","2009-05"); ?></td></tr>
		<tr><td>May 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-05","2009-06"); ?></td></tr>
		<tr><td>June 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-06","2009-07"); ?></td></tr>
		<tr><td>July 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-07","2009-08"); ?></td></tr>
		<tr><td>August 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-08","2009-9"); ?></td></tr>
		<tr><td>September 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-09","2009-10"); ?></td></tr>
		<tr><td>October 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-10","2009-11"); ?></td></tr>
		<tr><td>November 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-11","2009-12"); ?></td></tr>
		<tr><td>December 2009:</td><td> <?php getMonthlyCount($referrals_table,"2009-12","2010-01"); ?></td></tr> -->
	</table>
	</td>
	<td align="left">
		<table border="1" cellpadding="2" cellspacing="2">
			<?php displaySingleYear ($referrals_table, 2010); ?>
		</table>
	</td>
	<!--
	<td align="left">
		<table border="1" cellpadding="2" cellspacing="2">
			<?php displaySingleYear ($referrals_table, 2011); ?>
		</table>
	</td>
	-->
	</tr>
</table>


<br>
<?php
//include("db/closedb.php");
?>
</body>
</html>

