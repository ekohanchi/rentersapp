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
$createquery_rs="CREATE TABLE $refstatus_table
(
	refstatus int(3),
	description varchar(150)
);";

$createquery_r="CREATE TABLE $referrals_table
(
    id int NOT NULL AUTO_INCREMENT,
    inserted Datetime NOT NULL,
    refstatus int(3),
    referral_id varchar(25) NOT NULL,
    prepopulatedACN int(1),
    aciflname varchar(50),
    aciacn varchar(50),
    acistreet varchar(50),
    acicity varchar(50),
    acistate varchar(25),
    acizip varchar(20),
    fname1 varchar(50),
    lname1 varchar(50),
    dobmonth1 varchar(2),
    dobday1 varchar(2),
    dobyear1 varchar(4),
    dlnum1 varchar(10),
    dlstate1 varchar(2),
    sex1 varchar(10),
    fname2 varchar(50),
    lname2 varchar(50),
    dobmonth2 varchar(2),
    dobday2 varchar(2),
    dobyear2 varchar(4),
    dlnum2 varchar(10),
    dlstate2 varchar(2),
    sex2 varchar(10),
    istreet varchar(50),
    icity varchar(50),
    istate varchar(25),
    izip varchar(5),
    mstreet varchar(50),
    mcity varchar(50),
    mstate varchar(25),
    mzip varchar(5),
    areacode varchar(3),
    cell3 varchar(3),
    cell4 varchar(4),
    email varchar(40),
    caryear1 varchar(4),
    carmake1 varchar(25),
    carmodel1 varchar(15),
    caryear2 varchar(4),
    carmake2 varchar(25),
    carmodel2 varchar(15),
    caryear3 varchar(4),
    carmake3 varchar(25),
    carmodel3 varchar(15),
    motocyear1 varchar(4),
    motocmake1 varchar(20),
    motocmodel1 varchar(20),
    motocengs1 varchar(5),
    effweekday varchar(5),
    effmonth varchar(2),
    effmday varchar(2),
    effyear varchar(4),
    ppc varchar(10),
    po varchar(100),
    UNIQUE KEY id (id)
);";

if(isset($_GET['referralStatus']) || isset($_GET['referrals'])) {
	if(isset($_GET['referralStatus'])) {
		$table = $refstatus_table;
		$createquery = $createquery_rs;
		$param = referralStatus;
	}
	elseif(isset($_GET['referrals'])) {
		$table = $referrals_table;
		$createquery = $createquery_r;
		$param = referrals;
	}	
	
	if (isset($_POST['confirm'])) {
//		mysql_connect($dbhost,$dbuser,$dbpassword);
//		@mysql_select_db($database) or die( "<br>Unable to select database. MySQL ERROR Exception: " . mysql_error());
		include("opendb.php");
		$dropquery="DROP TABLE IF EXISTS $table;";
		
		mysql_query($dropquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $dropquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
		mysql_query($createquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $createquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
		
		if ($table == $refstatus_table) {
					// Populating the table with values
			foreach($refstatus_array as $key => $value) {
				$insertquery="INSERT INTO $refstatus_table VALUES ('$key','$value')";
				mysql_query($insertquery) or die("<br><b>A MySQL error occured</b><br><b>Query:</b> " . $insertquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());;
			}
		}
		echo "<br>Done creating (and populating) table with the following credentials...<br>";
		echo "<b>Table name:</b> $table <br>";
		echo "<b>DB:</b> $database <br>";
//		mysql_close();
		include("closedb.php");
		
		echo "<br>Back to <a href=\"index.php\">Database Management</a>";
	}
	else {
		$action_script = "createTable.php?$param";
		?>
		<form method="post" action="<?php $action_script ?>">
		<br>This script will create the Table with the following credentials:<br>
		<?php
			echo "<li>Database Host: $dbhost</li>";
			echo "<li>Database Username: $dbuser</li>";
			echo "<li>Database Name: $database</li>";
			echo "<li>Database Table: $table</li>";
			echo "<li>Create Query: <pre>$createquery</pre></li>";
			
			if ($table == $refstatus_table) {
				echo "<li>Table values:<pre>";
					foreach($refstatus_array as $k => $v) {
						echo "$k: $v<br>";
					}
					echo "</pre></li>";
			}	
		?>
		<p><input type="submit" name="confirm" value="OK">
		</form> 
	<?php
	}
}
else {
	echo "<br>Back to <a href=\"index.php\">Database Management</a>";
//	header('Location: index.php');
} ?>

</body>
</html>