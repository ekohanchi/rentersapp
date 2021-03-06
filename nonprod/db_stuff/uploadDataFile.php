<html>
<head>
<title>Upload Data File to DB</title>
</head>
<body>
<?php
include("configs.php");

$databasehost = $dbhost;
$databasename = $database;
$databasetable = $referrals_table;
$databaseusername =$user;
$databasepassword = $password;
$fieldseparator = "|";
$lineseparator = "\n";
//$csvfile = "data.final.noheader.csv";
$uploadsdir = "uploads/";

  if (isset($_REQUEST['MAX_FILE_SIZE'])) {
	$uploadsdir = $uploadsdir . basename( $_FILES['form_data']['name']); 
  	
	echo "uploadsdir value: [$uploadsdir]";
	
  	$csvfile = $_REQUEST['form_data'];
  	
  	echo "form_data value: [$form_data] <br>";
  	
  	
  	// change value to 1 to have an empty field in the first field with its value
  		//incrementing, have value set to 0 for otherwise, 0 when unsure
  	$addauto = 0;
  	// set value to 1 to save the mysql entries in a file. Permissions on the file
  		//should be set to 777, and file should exist on server
  	$save = 1;
	$outputfile = "output.sql";
  	
	if(!file_exists($csvfile)) {
	echo "File not found. Make sure you specified the correct path.\n";
	exit;
	}
	
	$file = fopen($csvfile,"r");
	
	if(!$file) {
		echo "Error opening data file.\n";
		exit;
	}
	
	$size = filesize($csvfile);
	
	if(!$size) {
		echo "File is empty.\n";
		exit;
	}
	
	$csvcontent = fread($file,$size);
	
	fclose($file);
	
	$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
	@mysql_select_db($databasename) or die(mysql_error());
	
	$lines = 0;
	$queries = "";
	$linearray = array();
	
	foreach(split($lineseparator,$csvcontent) as $line) {
	
		$lines++;
		$line = trim($line," \t");
		$line = str_replace("\r","",$line);
		
		/************************************
		This line escapes the special character. remove it if entries are already escaped in the csv file
		************************************/
		$line = str_replace("'","\'",$line);
		/*************************************/
		
		$linearray = explode($fieldseparator,$line);
		$linemysql = implode("','",$linearray);
		if($addauto)
			$query = "insert into $databasetable values('','$linemysql');";
		else
			$query = "insert into $databasetable values('$linemysql');";
		$queries .= $query . "\n";
		@mysql_query($query);
	}
	@mysql_close($con);
	
	if($save) {
		if(!is_writable($outputfile)) {
			echo "File is not writable, check permissions.\n";
		}
		else {
			$file2 = fopen($outputfile,"w");
			
			if(!$file2) {
				echo "Error writing to the output file.\n";
			}
			else {
				fwrite($file2,$queries);
				fclose($file2);
			}
		}	
	}
	echo "Found a total of $lines records in this csv file.\n";
  	
//  	mysql_connect($dbhost,$user,$password);
//	@mysql_select_db($database) or die( "Unable to select database");
//  	
//	$data = addslashes(fread(fopen($form_data, "r"), filesize($form_data)));
//	$result=MYSQL_QUERY("INSERT INTO $referrals_table (description, data,filename,filesize,filetype) ". "VALUES ('$form_description','$data','$form_data_name','$form_data_size','$form_data_type')");
//	$id= mysql_insert_id();
//	print "<p>File ID: <b>$id</b><br>";
//	print "<p>File Name: <b>$form_data_name</b><br>";
//	print "<p>File Size: <b>$form_data_size</b><br>";
//	print "<p>File Type: <b>$form_data_type</b><p>";
//	print "To upload another file <a href=http://www.yoursite.com/yourpage.html> Click Here</a>"; 

  }
  else {
  ?>
	<form method="post" action="uploadDataFile.php" enctype="multipart/form-data">
<!--	Description:<br>-->
<!--	<input type="text" name="form_description" size="40">-->
	<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
	<br>File to upload:<br>
	<input type="file" name="form_data" size="40">
	<p><input type="submit" name="submit" value="submit">
	</form> 
  <?php
  } 
  ?>
	
</body>
</html>