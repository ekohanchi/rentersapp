<?php
/*
 * Created on Oct 23, 2008
 *
 */
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
	  		?>
	  		<form>
				<input style="color: green; font-weight: bold" type=button onclick="document.location.href='viewreferrals.php'" value="View Submitted Referrals">
			</form>
	  		<?php
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
