<html>
<head>
</head>
<body>

<?php
/*
 * last modified: 9/15/09
 */
include("../include/configs.php");
include("../login.php");

$refstatus_array = array(
	'0' => 'deleted referrals (no text file availble on server)',
	'10' => 'test referrals',
	'100' => 'submitted referrals',
	'200' => 'successful referrals',
	'300' => 'unsuccessful referrals',
	'400' => 'closed referrals',
	'500' => 'compensated referrals'
);
$createquery="CREATE TABLE $refstatus_table
(
	refstatus int(3),
	description varchar(150)
);";

if (isset($_POST['confirm'])) {
	mysql_connect($dbhost,$user,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	$dropquery="DROP TABLE IF EXISTS $refstatus_table;";

	mysql_query($dropquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $dropquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
	mysql_query($createquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $createquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
	
		// Populating the table with values

	foreach($refstatus_array as $key => $value) {
		$insertquery="INSERT INTO $refstatus_table VALUES ('$key','$value')";
		mysql_query($insertquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $insertquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());;
	}
	
	echo "<br><br>Done creating and populating Table with the following credentials...<br>";
	echo "<b>tablename:</b> $refstatus_table <br>";
	echo "<b>DB:</b> $database <br>";
	mysql_close();
}
else {
?>
	<form method="post" action="createReferralStatusTable.php">
	<br>This script will create the Referrals Status Table with the following credentials:<br>
	<?php
		echo "<li>Database Host: $dbhost</li>";
		echo "<li>Database Name: $database</li>";
		echo "<li>Database Table: $refstatus_table</li>";
		echo "<li>Create Query: <pre>$createquery</pre></li>";
		echo "<li>Table values:<pre>";
			foreach($refstatus_array as $k => $v) {
				echo "$k: $v<br>";
			}
			echo "</pre></li>"; 		
	?>
	<p><input type="submit" name="confirm" value="OK">
	</form> 
  <?php
  } 
  ?>

</body>
</html>