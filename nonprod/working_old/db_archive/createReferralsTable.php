<?php
/*
 * last modified: 9/15/09
 */
include("../include/configs.php");
include("../login.php");

$createquery="CREATE TABLE $referrals_table
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

if (isset($_POST['confirm'])) {
	
	mysql_connect($dbhost,$user,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	$dropquery="DROP TABLE IF EXISTS $referrals_table;";
	
	mysql_query($dropquery) or die("<b>A MySQL error occured</b><br><b>Query:</b> " . $dropquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
	mysql_query($createquery) or die("<b>A MySQL error occured</b><br><b>Query:</b> " . $createquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
	
	echo "done creating Table with the following credentials...<br>";
	echo "<b>tablename:</b> $referrals_table <br>";
	echo "<b>DB:</b> $database <br>";
	mysql_close();
}
else {
?>
	<form method="post" action="createReferralsTable.php">
	<br>This script will create the Referrals Table with the following credentials:<br>
	<?php
		echo "<li>Database Host: $dbhost</li>";
		echo "<li>Database Name: $database</li>";
		echo "<li>Database Table: $referrals_table</li>";
		echo "<li>Create Query: <pre>$createquery</pre></li>";		
	?>
	<p><input type="submit" name="confirm" value="OK">
	</form> 
  <?php
  } 
?>