<html>
<head>
<title>Renter Referral View Submitted Referrals</title>
<?php 
include("login.php");
?>
<h1><center>View Submitted Referrals &amp; Receipts</center></h1>
<SCRIPT LANGUAGE="JavaScript">
function CheckBoxes1() {
	var a=document.form1['datafiles[]'];
	if(document.form1.Check_All.value=="Check All"){
		for(i=0; i<a.length; i++) {
			a[i].checked = true;
		}
		document.form1.Check_All.value="UnCheck All";
	}
	else {
		for(i=0; i<a.length; i++) {
			a[i].checked = false;
		}
		document.form1.Check_All.value="Check All";
	}
	
}
function CheckBoxes2() {
	var a=document.form2['coi_files[]'];
	if(document.form2.Check_All.value=="Check All"){
		for(i=0; i<a.length; i++) {
			a[i].checked = true;
		}
		document.form2.Check_All.value="UnCheck All";
	}
	else {
		for(i=0; i<a.length; i++) {
			a[i].checked = false;
		}
		document.form2.Check_All.value="Check All";
	}
	
}
</script>
</head>

<?php
/*
 * Created on Sep 22, 2008
 */
 
 function viewFiles ($directory, $text1, $text2) {
	 $dir = "$directory/";
	 $filelist="";
	 $filecount=0;
	 if (is_dir($dir)) {
	 	if ($dh = opendir($dir)) {
	 		while (($rec = readdir($dh)) != false) {
	 			//if ($rec != "." && $rec != ".." && $rec != "archive" && $rec != "COI_TEMPLATE.html" && $rec != "Thumbs.db") {
	 			if (preg_match("/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/", $rec)) {
	 				$fullpath = "$dir$rec";
	 				$line = $filecount + 1;
	 				$filelist .= '<input type="checkbox" name="'.$directory.'[]" value="'.$fullpath.'"> <a href="'.$fullpath.'">'.$rec.'</a><br>';
	 				$filecount++;
	 			}
	 		}
	 		closedir($dh);
	 		echo "<h4>$text1: $filecount </h4>";
	 		echo "$text2:<br>";
	 		echo "$filelist";
	 	}
	 }
 }
?>

<body onload="document.form1.reset(); document.form2.reset();">
<?php
include("menuebar.php");
?>
<input style="color: black; font-weight: bold" type=button onclick="document.location.href='admin.php?logout=1'" value="Logout">

<h3>Use this page to view a list of processed files...</h3>

<!-- Delete Code Starts -->
<?php
  if (isset($_REQUEST['dirname'])) {
	  $directory = $_REQUEST['dirname'];
	  $filelist = array();
	  $filelist_string = "";
	  $i=0;
	  if (isset($_POST[$directory])){
		  foreach ($_POST[$directory] as $k=> $c) {
		  	//echo "$c<br>";
		  	$filelist[$i] = "$c ";
		  	$filelist_string = "$filelist_string $c ";
		  	$i++;
		  }
		  echo "Are you sure you want to remove the following file(s)?";
		  ?>
		  <form name="question" method="post">
		    <input type="hidden" name="dirname" value="<?=$_REQUEST['dirname']?>"/>
		    <input type="hidden" name="filelist" value="<?=$filelist_string?>"/>
		   	<input type="submit" name="doaction1" value="YES" />
		  	<input type="submit" name="doaction2" value="NO" />
		  </form>
		  <?php
		  echo "<ul>";
		  foreach ($filelist as $k => $v) {
		  	echo "<li>$v</li>";
		  }
		  echo "</ul>";
		  ?>
	<?php
	  }
	  else {
	  	if (! isset($_POST['doaction1']) && ! isset($_POST['doaction2'])) {
	  		echo "<font color=\"red\"><h4>No Files were selected for deletion!!<br>Please mark the checkbox for the files you want to delete.</h4></font>";
	  	}
	  }
  }
  if (isset($_POST['doaction1']) || isset($_POST['doaction2'])) {
  	if (isset($_POST['doaction1'])) {
  		if (isset($_REQUEST['filelist'])){
  			$filelist_string = $_REQUEST['filelist'];
  			$filelist = explode(" ", $filelist_string);
  			foreach ($filelist as $k => $v) {
		 	 	if (file_exists($v)) {
		 	 		@unlink($v);
		 	 	}
			}
			header('Location: viewreferrals.php');
  		}
  	}
  	else {
  		 header('Location: viewreferrals.php');
  	}
  }
  ?>
<!-- Delete Code Ends -->
<table width="600" border="3" align="center" cellspacing="2" cellpadding="2">
  <tr>
    <td valign="top">
    	<form name="form1" method="post" action="viewreferrals.php">
    	<input type="button" name="Check_All" value="Check All" onClick="CheckBoxes1()">
    	<input type="submit" value="Delete">
    	<input type="hidden" name="dirname" value="datafiles"/>
    	<?php viewFiles("datafiles", "Total referrals submitted so far", "List of referrals"); ?>
    	</form>
    </td>
    <td valign="top">
    	<form name="form2" method="post" action="viewreferrals.php">
    	<input type="button" name="Check_All" value="Check All" onClick="CheckBoxes2()">
    	<input type="submit" value="Delete">
    	<input type="hidden" name="dirname" value="coi_files"/>
    	<?php viewFiles("coi_files", "Total referral receipts returned so far", "List of referral receipts"); ?>
    	</form>
    </td>
  </tr>
</table>

</body>

</html>