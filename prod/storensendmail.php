<?php
/*
 * Created on Aug 26, 2008
 */
 
 if (isset($_REQUEST['aciflname'])) {
 	include("logip.php");
 	$Unixtime = time();
	//$uniqueid = date("mdYHis", $Unixtime + -3.00 * 3600);	//old method of  uniqueid
	$uniqueid = date("YmdHis", $Unixtime + -3.00 * 3600);	//new method of uniqueid
	$fileid = "${uniqueid}_01";
	
	// For Data file
	$file = "datafiles/${fileid}.txt";
	$out = fopen($file, 'w');
	
	$carmakeArray = array('0'=>"Select a Car",'1'=>"Acura",'2'=>"Aston Martin",'3'=>"Audi",'4'=>"BMW",'5'=>"Buick",'6'=>"Cadillac",'7'=>"Chevrolet",'8'=>"Chrysler",'9'=>"Dodge",'10'=>"Ferrari",'11'=>"Ford",'12'=>"GMC",'13'=>"Honda",'14'=>"HUMMER",'15'=>"Hyundai",'16'=>"Infiniti",'17'=>"Isuzu",'18'=>"Jaguar",'19'=>"Jeep",'20'=>"Kia",'21'=>"Land Rover",'22'=>"Lexus",'23'=>"Lincoln",'24'=>"Lotus",'25'=>"Maserati",'26'=>"Mazda",'27'=>"Mercedes-Benz",'28'=>"Mercury",'29'=>"MINI",'30'=>"Mitsubishi",'31'=>"Nissan",'32'=>"Pontiac",'33'=>"Porsche",'34'=>"Rolls-Royce",'35'=>"Saab",'36'=>"Saturn",'37'=>"Scion",'38'=>"Smart",'39'=>"Subaru",'40'=>"Suzuki",'41'=>"Toyota",'42'=>"Volkswagen",'43'=>"Volvo");
		
	// Record the referral id value
	$referralid_record = "referral_id: $fileid\r\n";
	fwrite($out, $referralid_record);

	foreach (array_keys($_REQUEST) as $k) {
	       if ($k == "fname1" || $k == "istreet" || $k == "areacode" || $k == "caryear1" || $k =="effweekday" || $k =="ppc" || $k =="cctype"){
	       	fwrite($out, "\r\n");
	       }
	       
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
	       
	       $keyvaluepair = "$key: $value\r\n";
	       fwrite($out, $keyvaluepair);
	}
	fclose($out);

	// Filling in the COI_TEMPLATE
	$template = "coi_files/COI_TEMPLATE.html";
	$tmplt_hndlr = fopen($template, 'r');
	$tmplt_contents = file_get_contents($template);
	
	$coi = "coi_files/${fileid}.html";
	$coi_hndlr = fopen($coi, 'w');

	foreach (array_keys($_REQUEST) as $k) {
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
	}
	
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
							'POLICY_NUM' => $fileid,
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

/*	function modifier($fillinfields, $docfile) {
		$xchange = array ('\\' => "\\\\", '{'  => "\{", '}'  => "\}");
		$document = file_get_contents($docfile);
		if(!$document) { return false; }
		foreach($fillinfields as $key=>$value) {
            $search = "%%".strtoupper($key)."%%";
            foreach($xchange as $orig => $replace) {
                $value = str_replace($orig, $replace, $value);
            }
            $document = str_replace($search, $value, $document);
        }
        return $document;
	} */
	
	// Remove any files that thier file size is 0, they are empty
	if (file_exists($file)) {
		$flsize = filesize($file);
		if ($flsize == "0") {
			@unlink($file);
		}
	}
	if (file_exists($coi) && file_exists($template)) {
		$flsize1 = filesize($coi);
		$flsize2 = filesize($template);
		if ($flsize1 <= $flsize2) {
			@unlink($coi);
		}
	}
	
	$ip = getenv('REMOTE_ADDR');					// get ip address 
	$to = "ekohanchi@gmail.com,kevin.kane.sbk9@statefarm.com";
	//$to = "ekohanchi@gmail.com";
	$subject = "Renter's App Processed";
	$message = "A referral has been processed\nUser's IP Address: $ip\nData File Created: $file";
	$headers = 'From: rentersreferral@noreply.com' . "\r\n" .
    'Reply-To: rentersreferral@noreply.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	mail( $to, $subject, $message, $headers );
	echo "<h1> Thank you!! </h1>";
	echo "<h4> Your Unique ID for this referral is: $fileid </h4>";
	//echo "<h3><a href=$coi target=\"_blank\">Certificate of Insurance</a></h3>";
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
