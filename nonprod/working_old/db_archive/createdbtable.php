<?php
/*
 * last modified: 8/9/09
 */
include("configs.php");

mysql_connect($dbhost,$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
//$query="CREATE TABLE contacts (id int(6) NOT NULL auto_increment,first varchar(15) NOT NULL,last varchar(15) NOT NULL,phone varchar(20) NOT NULL,mobile varchar(20) NOT NULL,fax varchar(20) NOT NULL,email varchar(30) NOT NULL,web varchar(30) NOT NULL,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
$dropquery="DROP TABLE IF EXISTS $table;";
//$createquery="CREATE TABLE $table (id int(6) NOT NULL auto_increment, datetimeupdated datetime NOT NULL, referralid varchar(20) NOT NULL, status int(1) NOT NULL default '1', UNIQUE KEY id (id));";
$createquery="CREATE TABLE $table (id int(6) NOT NULL auto_increment, referralid varchar(20) NOT NULL, modifieddatetime datetime NOT NULL, statusid int(1) NOT NULL default '1', UNIQUE KEY id (id));";

mysql_query($dropquery);
mysql_query($createquery);
echo "done creating DB with the following credentials...<br>";
echo "<b>tablename:</b> $table <br>";
echo "<b>DB:</b> $database <br>";
mysql_close();

?>