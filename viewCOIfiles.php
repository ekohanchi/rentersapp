<html>
<head>
<title>Renter Referral View COI Files</title>
<?php 
include("login.php");
?>

<SCRIPT LANGUAGE="JavaScript">
function CheckBoxes() {
	var a=document.form1['coi_files[]'];
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
</script>
</head>

<?php
/*
 * Created on Oct 16, 2009
 */
 
 function viewFiles ($directory, $option) {
	 $dir = "$directory/";
	 $filelist="";
	 $filecount=0;
	 $filelist_array = array();
	 if (is_dir($dir)) {
	 	if ($dh = opendir($dir)) {
	 		while (($rec = readdir($dh)) != false) {
	 			//if ($rec != "." && $rec != ".." && $rec != "archive" && $rec != "COI_TEMPLATE.html" && $rec != "Thumbs.db") {
	 			if (preg_match("/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/", $rec)) {
	 				$fullpath = "$dir$rec";
	 				$line = $filecount + 1;
// 	 				$filelist .= '<input type="checkbox" name="'.$directory.'[]" value="'.$fullpath.'"> <a href="'.$fullpath.'">'.$rec.'</a><br>';
 	 				$filelist_array[] = '<input type="checkbox" name="'.$directory.'[]" value="'.$fullpath.'"> <a href="'.$fullpath.'">'.$rec.'</a><br>';	 				
	 				$filecount++;
	 			}
	 		}
	 		closedir($dh);
	 		if($option == "count") {
	 			echo "$filecount";
	 		}
	 		elseif($option == "filelist") {
	 			$totalcoi=count($filelist_array);
	 			$coipercol=$totalcoi/5;
	 			$coipercol_rounded=round($coipercol);
	 			for($i=0; $i<=$totalcoi; $i++) {
	 				if(($i%$coipercol_rounded)==0) { echo "<td valign=\"top\">"; }
	 				if($i==count($filelist_array)) { echo "</td>"; }
	 				echo "$filelist_array[$i]";
	 			}
	 		}
	 	}
	 }
 }
?>

<body onload="document.form1.reset();">
<center><h1>View Receipts / Certificate of Insurance Files</h1></center>

<?php
include("menuebar.php");
?>
<h3>Use this page to view a list of receipts...</h3>

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
			header('Location: viewCOIfiles.php');
  		}
  	}
  	else {
  		 header('Location: viewCOIfiles.php');
  	}
  }
  ?>
<!-- Delete Code Ends -->
<form name="form1" method="post" action="viewCOIfiles.php">
<table width="100%" border="3" align="center" cellspacing="2" cellpadding="2">
  <tr>
    <td valign="top" colspan="100%" align="center">
    	<input type="button" name="Check_All" value="Check All" onClick="CheckBoxes()">
    	<input type="submit" value="Delete Selected">
    	<input type="hidden" name="dirname" value="coi_files"/>
    	<br>List of referral receipts returned so far (<?php viewFiles("coi_files", "count"); ?>)
    </td>
  </tr>
  <tr>
    <?php viewFiles("coi_files", "filelist"); ?>
  </tr>
</table>
</form>


</body>

</html>