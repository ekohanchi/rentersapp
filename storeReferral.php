<?php
/*
 * Created on Aug 26, 2008
 */
 
 if (isset($_REQUEST['aciflname'])) {
 	include("logip.php");
 	include("include/configs.php");
 	
 	$Unixtime = time();
	$uniqueid = date("YmdHis", $Unixtime + -3.00 * 3600);	//new method of uniqueid
	$refid = "${uniqueid}_01";

		
		// old method of storing the inserted date into the inserted field
	//$inserted = date("Y-m-d H:i:s", time() + -3.00 * 3600);
	//$sql_values = "$sql_values'$inserted',";
	
	$sql_values = "'',";		
	$sql_values = "$sql_values now(),";
	
	// if aciflname or fname1 contains "test" then set refstatus to 100, else to 200
	if (((strlen(strstr(strtolower($_REQUEST['aciflname']),"test"))>0)) || (((strlen(strstr(strtolower($_REQUEST['fname1']),"test"))>0))))  {
		$refstatus=10;
		$refstatus_msg="Test";
	} else {
		$refstatus=100;
		$refstatus_msg="";
	}

	$sql_values = "$sql_values'$refstatus',";
	$sql_values = "$sql_values'$refid',";
		//error statement
	//$sql_values = "$sql_values$refid',";
	
	
	foreach (array_keys($_REQUEST) as $k) {
//	       if ($k == "fname1" || $k == "istreet" || $k == "areacode" || $k == "caryear1" || $k =="effweekday" || $k =="ppc" || $k =="cctype"){
////	       	fwrite($out, "\r\n");
//	       }
	       
	       $v = $_REQUEST[$k];
	       if($k == "carmake1" || $k == "carmake2" || $k == "carmake3") {
	       	$value = "$carmakeArray[$v]";
	       }
	       else if ($v == "ppc1") { $value = "$30,000"; }
	       else if ($v == "ppc2") { $value = "$50,000"; }
	       else if ($v == "po1a") { $value = "$39 first month's downpayment, $21.50 monthly"; }
	       else if ($v == "po1b") { $value = "$222 annually"; }
	       else if ($v == "po2a") { $value = "$50.34 first month's downpayment, $27.17 monthly"; }
	       else if ($v == "po2b") { $value = "$290 annually"; }
	       else {
	       	$value = $v;
	       }
	       $key = $k;
	       	       
	       //Varialbe for filling out the COI_TEMPLATE
			if ($k == "fname1") { $ph_fname1 = $_REQUEST[$k]; }
			else if ($k == "lname1") { $ph_lname1 = $_REQUEST[$k]; }
			else if ($k == "fname2") { $ph_fname2 = $_REQUEST[$k]; }
			else if ($k == "lname2") { $ph_lname2 = $_REQUEST[$k]; }
			else if ($k == "mstreet") { $phm_address = $_REQUEST[$k]; }
			else if ($k == "mcity") { $phm_city = $_REQUEST[$k]; }
			else if ($k == "mstate") { $phm_state = $_REQUEST[$k]; }
			else if ($k == "mzip") { $phm_zip = $_REQUEST[$k]; }
			else if ($k == "istreet") { $phi_address = $_REQUEST[$k]; }
			else if ($k == "icity") { $phi_city = $_REQUEST[$k]; }
			else if ($k == "istate") { $phi_state = $_REQUEST[$k]; }
			else if ($k == "izip") { $phi_zip = $_REQUEST[$k]; }
			else if ($k == "aciacn") { $ch_name = $_REQUEST[$k]; }
			else if ($k == "acistreet") { $ch_address = $_REQUEST[$k]; }
			else if ($k == "acicity") { $ch_city = $_REQUEST[$k]; }
			else if ($k == "acistate") { $ch_state = $_REQUEST[$k]; }
			else if ($k == "acizip") { $ch_zip = $_REQUEST[$k]; }
			else if ($k == "effmonth") { $effm = $_REQUEST[$k]; }
			else if ($k == "effmday") { $effmd = $_REQUEST[$k]; }
			else if ($k == "effyear") { $effy = $_REQUEST[$k]; }
			// END Varibles for filling out the COI_TEMPLATE
	       
			
			$esc_value = mysql_escape_string($value);
			if ($k == "po") {
				$sql_values = "$sql_values'$esc_value'";
				break;
			} else {
				$sql_values = "$sql_values'$esc_value',";
			}	       
	       //$keyvaluepair = "$key: $value\r\n";
	}
	//echo "sql_values Value: [$sql_values] <br>";
	
		// initilizing DB connectivity
	include("db/opendb.php");

	$insertquery = "INSERT INTO $referrals_table VALUES ($sql_values)";
	/********************************
		// Test code dealing with inserting query issues
//		$insertstatus = mysql_query($insertquery) or die("<b>A MySQL error occured for referral id: $refid</b><br><b>Query:</b> " . $insertquery . " <br /> <b>Error:</b> (" . mysql_errno() . ") " . mysql_error());
//		echo "<br><b>A MySQL error occured for referral id: $refid</b><br><br><b>Query:</b> $insertquery<br><br><b>Error:</b> (" . mysql_errno();
//		echo ")" . mysql_error();
//		echo "<br>";
//		$insert_errmsg=("<b>A MySQL error occured for referral id: $refid</b><br><br><b>Query:</b> " . $insertquery . " <br><br><b>Error:</b> (" . mysql_errno() . ") " . mysql_error() . "<br>");
	***********************************/
	
		//$insertstatus value equals 1 when the query is successfull
	$insertstatus = mysql_query($insertquery);
	$insert_errmsg=("<b>A MySQL error occured for referral id: $refid</b><br><br><b>Query:</b> " . $insertquery . " <br><br><b>Error:</b> (" . mysql_errno() . ") " . mysql_error() . "<br><br><br>");
	$insert_errmsg_fileformatted=("A MySQL error occured for referral id: $refid\nQuery: " . $insertquery . " \nError: (" . mysql_errno() . ") " . mysql_error() . "\n***********************\n");
	
	if ($insertstatus != 1) {
		$sqlerrors_hndlr = fopen($sqlerrors, 'a');
		fwrite($sqlerrors_hndlr, $insert_errmsg_fileformatted);
		fclose($sqlerrors_hndlr);
	}
	
	//refstatus statistics
	$query_all = "Select count(*) from $referrals_table;";
	$query_deleted = "Select count(*) from $referrals_table where refstatus=0";
	$query_test = "Select count(*) from $referrals_table where refstatus=10";
	$query_submitted = "Select count(*) from $referrals_table where refstatus=100";
	$query_successful = "Select count(*) from $referrals_table where refstatus=200";
	$query_closed = "Select count(*) from $referrals_table where refstatus=400";
	$query_compensated = "Select count(*) from $referrals_table where refstatus=500";
	
	$all_count=mysql_result(mysql_query($query_all),0);
	$deleted_count=mysql_result(mysql_query($query_deleted),0);
	$test_count=mysql_result(mysql_query($query_test),0);
	$submitted_count=mysql_result(mysql_query($query_submitted),0);
	$successful_count=mysql_result(mysql_query($query_successful),0);
	$closed_count=mysql_result(mysql_query($query_closed),0);
	$compensated_count=mysql_result(mysql_query($query_compensated),0);

	include("db/closedb.php");
	
	// Filling in the COI_TEMPLATE
//	$template = "coi_files/COI_TEMPLATE.html";
//	$coi = "coi_files/${refid}.html";
	$tmplt_hndlr = fopen($template, 'r');
	$tmplt_contents = file_get_contents($template);
	
	$coi = "${coi_dir}/${refid}.html";
	$coi_hndlr = fopen($coi, 'w');
	
	if ($ph_fname2 != "") {	$policyholder = "$ph_fname1 $ph_lname1 & $ph_fname2 $ph_lname2"; }
	else { $policyholder = "$ph_fname1 $ph_lname1"; }
	
	if ($phm_address != "") { $add_of_ph = "$phm_address, $phm_city, $phm_state, $phm_zip";	}
	else { $add_of_ph = "$phi_address, $phi_city, $phi_state, $phi_zip"; }
	
	$loc_of_operations = "$phi_address, $phi_city, $phi_state, $phi_zip";
	
	//$date = "<script language=\"JavaScript\">now=new Date(); document.write(now.toLocaleString()); </script>";
	$date = "<script language=\"JavaScript\">var d=new Date(); var cd=d.getDate(); var cm=d.getMonth(); cm++; var cy=d.getFullYear(); document.write(cm + \"/\" + cd + \"/\" + cy); </script>";
	
	$efd = "$effm/$effmd/$effy";
	$end_effy = $effy + 1;
	$exd = "$effm/$effmd/$end_effy";

	$fillinfields = array('POLICY_HOLDER' => $policyholder,
							'ADD_OF_PH' => $add_of_ph,
							'LOC_OF_OPERATIONS' => $loc_of_operations,
							'POLICY_NUM' => $refid,
							'EFD' => $efd,
							'EXD' => $exd,
							'CH_NAME' => $ch_name,
							'CH_ADDRESS' => $ch_address,
							'CH_CITY' => $ch_city,
							'CH_STATE' => $ch_state,
							'CH_ZIP' => $ch_zip);
							//'DATE' => $date);
	$newvalue = $tmplt_contents;
	foreach($fillinfields as $key=>$value) {
		$search = "%%$key%%";
		$newvalue = str_replace($search, $value, $newvalue);	
	}
	fwrite($coi_hndlr, $newvalue);
	
	fclose($tmplt_hndlr);
	fclose($coi_hndlr);
	
	if (file_exists($coi) && file_exists($template)) {
		$flsize1 = filesize($coi);
		$flsize2 = filesize($template);
		if ($flsize1 <= $flsize2) {
			@unlink($coi);
		}
	}
	
	// Emailing referralid notification START
	$ip = getenv('REMOTE_ADDR');					// get ip address 
	$to = "ekohanchi@gmail.com,kevin.kane.sbk9@statefarm.com";
	//$to = "ekohanchi@gmail.com";
	$subject = "Renter's App Processed";
	if ($insertstatus != 1) {
		$message = "A $refstatus_msg referral has been processed WITH ERRORS<br>";
		$message .= "User's IP Address: $ip<br>";
		$message .= "Referralid NOT stored: $refid<br>";
		$message .= "Mysql Insert ERROR message stored in: $sqlerrors";
	} else {
		$message = "A $refstatus_msg referral has been processed<br>";
		$message .= "User's IP Address: $ip<br>";
		$message .= "Referralid stored:<a href=\"www.fastform.biz/viewReferral.php?refid=$refid\"> $refid</a>";
		$message .= "<br><br><u>Referral Status Summary</u><br>";
		$message .= "Total referrals: $all_count<br>";
		$message .= "Deleted referrals: $deleted_count<br>";
		$message .= "Test referrals: $test_count<br>";
		$message .= "Submitted referrals: $submitted_count<br>";
		$message .= "Closed referrals: $closed_count<br>";
		$message .= "Compensated referrals: $compensated_count";
				
		//$message .= "Referralid stored: $refid";
	}
	$headers = "From: rentersreferral@noreply.com\r\n";
	$headers .= "Reply-To: rentersreferral@noreply.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail( $to, $subject, $message, $headers );
	//Emailing referralid notification DONE
	
	echo "<h1> Thank you!! </h1>";
	echo "<h4> Your Unique ID for this referral is: $refid </h4>";
	if ($insertstatus != 1) {
		echo "<font color=\"red\"><b>There was an error processing your referrals. Please try again later.<br>A report of this error message has been recorded</b></font>";
		//echo "$insert_errmsg";
	}
	
	echo "<h3><A HREF=\"javascript:void(0)\" onclick=\"window.open('$coi','COI','width=800,height=600,menubar=yes,scrollbars=yes')\">Certificate of Insurance</A></h3>";
?>
<html>
<body>
<form>
<input style="color: blue; font-weight: bold" type=button onclick="document.location.href='renterreferral.php'" value="Process New Application">
</form>
</body>
</html>
<?php
 }
 ?>
