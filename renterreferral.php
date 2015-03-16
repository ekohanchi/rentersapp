<html>
<head>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="01 Jan 1970 00:00:00 GMT">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<title> Renter Referral Form</title>
<script language="javascript" src="include/externalfuncs.js"></script>
</head>
<body>

<?php
/*
 * Created on Aug 26, 2008
 * App Ver. 0.10
 * Last modified on 10.4.08
 */
/* $Unixtime = time();
$today = date("F j, Y, g:i:s a \P\S\T", $Unixtime + -3.00 * 3600);
$today = date("F j, Y, g:i:s a \P\S\T", $Unixtime); */

include("include/configs.php");

function createDropdown($array) {
	foreach($array as $key => $value) {
		echo "<option value=\"$key\">$value</option>\n";
	}
}

include("logip.php");

 ?>
<!--<body onload="document.appform.reset()"> -->
<body>
<table width="500" height="50" border="2" align="center" cellpadding="0" cellspacing="0" bordercolor="#555555" bgcolor="#CB1217" >
  <tr>
    <td><div align="center"> <span style="color: #FFFFFF; font-weight: bold; font-size: 28px;">Renter's Insurance Referral Form</span></div></td>
  </tr>
</table>

<form name="appform" method="post" action="storeReferral.php" onsubmit="return validateForm(appform);">
	<b>Current Date:</b> <script language="JavaScript">now=new Date(); document.write(now.toLocaleString()); </script>
	<br><font color="red">*</font> Indicates Required Fields

	<h2> Apartment Complex Information </h2>
	Select the Apartment Complex Name (if listed):
	  <select name="prepopulatedACN" onFocus="PopulateACI(this.value);" onChange="PopulateACI(this.value);" size="1">
	    <option value="0">Empty Fields</option>
	    <option value="1">A Melroy Managed Property</option>
	  </select><br><br>
	  
	  <font color="red">*</font>Leasing manager full name: <input name="aciflname" type="text" size="40"/><br>
	  <font color="red">*</font>Apartment complex name: <input name="aciacn" type="text" size="50"/><br>
	  Business address:<br>
	  <font color="red">*</font>Street: <input name="acistreet" type="text" size="25"/>
	  <font color="red">*</font>City: <input name="acicity" type="text" size="20"/>
	  State: <input name="acistate" type="text" value="California" size="10" style="background-color: #d3d3d3;" readonly/>
	  <!--State:<select name="acistate" size="1"><?php echo createDropdown($statesArray); ?> </select>-->
	  <font color="red">*</font>Zip: <input name="acizip" id="idacizip" type="text" size="5" maxlength="5" onclick="return false;" onblur="validatezip(this.id); return true;"/><br>

	<br>

	<h1> Renter's Insurance Info </h1>
	
	<h2> Occupant(s) Information </h2>
	<!-- Occupant 1 -->
	<font color="red">*</font>First Name: <input name="fname1" type="text" size="25"/>
	<font color="red">*</font>Last Name: <input name="lname1" type="text" size="25"/>
	<font color="red">*</font>DOB: <select name="dobmonth1" size="1"> <?php echo createDropdown($monthsArray); ?>  </select>
	<input name="dobday1" id="iddobday1" type="text" size="2" value="DD" maxlength="2" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<input name="dobyear1" id="iddobyear1" type="text" size="4" value="YYYY" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<br><font color="red">*</font>Driver's License# <input name="dlnum1" type="text" size="15" maxlength="15"/>
	<font color="red">*</font>Driver's License State: <select name="dlstate1" size="1"> <?php echo createDropdown($statesArray); ?> </select>
	<font color="red">*</font><input type="radio" name="sex1" value="male"> Male
	<input type="radio" name="sex1" value="female"> Female <br>
	
	<!-- Occupant 2 -->
	<p>First Name: <input name="fname2" type="text" size="25"/>
	Last Name: <input name="lname2" type="text" size="25"/>
	DOB: <select name="dobmonth2" size="1"> <?php echo createDropdown($monthsArray); ?> </select>
	<input name="dobday2" id="iddobday2" type="text" size="2" value="DD" maxlength="2" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<input name="dobyear2" id="iddobyear2" type="text" size="4" value="YYYY" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<br>Driver's License# <input name="dlnum2" type="text" size="15" maxlength="15"/>
	Driver's License State: <select name="dlstate2" size="1"> <?php echo createDropdown($statesArray); ?> </select>
	<input type="hidden" name="sex2" value="">
	<input type="radio" name="sex2" value="male"> Male
	<input type="radio" name="sex2" value="female"> Female <br>
	
	<!--
	 -- Occupant 3
	<p>First Name: <input name="fname3" type"text" size="25"/>
	Last Name: <input name="lname3" type"text size="25"/>
	DOB: <select name="dobmonth3" size="1"> <?php echo createDropdown($monthsArray); ?> </select>
	<input name="dobday3" id="iddobday3" type="text" size="2" value="DD" maxlength="2" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<input name="dobyear3" id="iddobyear3" type="text" size="4" value="YYYY" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<br>Driver's License# <input name="dlnum3" type="text" size="15" maxlength="15"/>
	Driver's License State: <select name="dlstate3" size="1"> <?php echo createDropdown($statesArray); ?> </select>
	<input type="radio" name="sex3" value="male"> Male
	<input type="radio" name="sex3" value="female"> Female <br>
	
	 -- Occupant 4
	<p>First Name: <input name="fname4" type"text" size="25"/>
	Last Name: <input name="lname4" type"text size="25"/>
	DOB: <select name="dobmonth4" size="1"> <?php echo createDropdown($monthsArray); ?> </select>
	<input name="dobday4" id="iddobday4" type="text" size="2" value="DD" maxlength="2" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<input name="dobyear4" id="dobyear4" type="text" size="4" value="YYYY" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
	<br>Driver's License# <input name="dlnum4" type="text" size="15" maxlength="15"/>
	Driver's License State: <select name="dlstate4" size="1"> <?php echo createDropdown($statesArray); ?> </select>
	<input type="radio" name="sex4" value="male"> Male
	<input type="radio" name="sex4" value="female"> Female <br>
  	-->
  	
  	<h2>Insured Location Address</h2>
  	<font color="red">*</font>Street: <input name="istreet" type="text" size="25"/>
  	<font color="red">*</font>City: <input name="icity" type="text" size="20"/>
  	State: <input name="istate" type="text" value="California" size="10" style="background-color: #d3d3d3;" readonly/>
  	<!--<select name="istate" size="1"><?php echo createDropdown($statesArray); ?> </select>-->
  	<font color="red">*</font>Zip: <input name="izip" id="idizip" type="text" size="5" maxlength="5" onclick="return false;" onblur="validatezip(this.id); return true;"/>
  	<br>
  	<h3> Mailing Address (if different from insured location) </h3>
  	Street: <input name="mstreet" type="text" size="25"/>
  	City: <input name="mcity" type="text" size="20"/>
  	State:
  	<select name="mstate" size="1"><?php echo createDropdown($statesArray); ?> </select>
  	Zip: <input name="mzip" id="idmzip" type="text" size="5" maxlength="5" onclick="return false;" onblur="validatezip(this.id); return true;"/> <br>
  	
  	<h2> Occupant Contact Info </h2>
  	<font color="red">*</font>Cell Phone #:
  	<input name="areacode" id="idareacode" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/>-
  	<input name="cell3" id="idcell3" type="text" size="3" maxlength="3" onclick="return false;" onblur="isalldigits(this.id); return true;"/>-
  	<input name="cell4" id="idcell4" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/> <br>
  	<font color="red">*</font>Email: <input name="email" type="text" size="35" /> <br>
  	
  	<h2> Occupant Car/Motorcycle Information </h2>
  	<font color="red">*</font>Car 1 -- Year: <input name="caryear1" id="idcaryear1" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
  	Make: <select name="carmake1"><?php echo createDropdown($carmakeArray); ?> </select>
  	Model: <input name="carmodel1" type="text" size="15"/> <br>
  	
  	Car 2 -- Year: <input name="caryear2" id="caryear2" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
  	Make: <select name="carmake2"><?php echo createDropdown($carmakeArray); ?> </select>
  	Model: <input name="carmodel2" type="text" size="15"/> <br>
  	
  	Car 3 -- Year: <input name="caryear3" id="caryear3" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
  	Make: <select name="carmake3"><?php echo createDropdown($carmakeArray); ?> </select>
  	Model: <input name="carmodel3" type="text" size="15"/> <br>
  	
  	Motorcycle 1 -- Year: <input name="motocyear1" id="motocyear1" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/>
  	Make: <input name="motocmake1" type="text" size="20"/>
  	Model: <input name="motocmodel1" type="text" size="20"/>
  	Engine Size (CC): <input name="motocengs1" type="text" size="5"/>
  	
  	<br>
  	<h2> <font color="red">*</font>Effective Date </h2>
  	<!--Applications may only be processed Monday - Friday<br>-->
  	Select a date one or more business days from today<br>
  	Current Date: <script language="JavaScript">now=new Date(); document.write(now.toLocaleString()); </script> <br>
  	<select name="effweekday"> <?php echo createDropdown($workweekdayArray); ?> </select>
  	<select name="effmonth"> <?php echo createDropdown($monthsArray); ?> </select>
  	<select name="effmday"> <?php echo createDropdown($monthdaysArray); ?> </select>
  	<select name="effyear"> <?php echo createDropdown($yearArray); ?> </select>	<br>

  	<h2> <font color="red">*</font>Personal Property Coverage </h2>
  	<input type="radio" name="ppc" value="ppc1" onClick ="ShowOptions(1,'paymentOpt',2);"> $30,000
  	<input type="radio" name="ppc" value="ppc2" onClick ="ShowOptions(2,'paymentOpt',2);"> $50,000<br>
  	<div id='paymentOpt1' style="display: none">
  	<br>$30,000 coverage<br>
  	<input type="radio" name="po" value="po1a">$39 first month's downpayment, $21.50 monthly<br>
  	<input type="radio" name="po" value="po1b">$222 annually
  	</div>
  	<div id='paymentOpt2' style="display: none">
  	<br>$50,000 coverage<br>
  	<input type="radio" name="po" value="po2a">$50.34 first month's downpayment, $27.17 monthly<br>
  	<input type="radio" name="po" value="po2b">$290 annually
  	</div>
  	
  	<!--
  	<h2> Payment Info </h2>
  	<font color="red">*</font>Credit Card: <select name="cctype"> <?php echo createDropdown($cctypeArray); ?> </select><br>
  	<font color="red">*</font>Credit Card#: <input name="ccnum" autocomplete="off" id="idccnum" type="text" size="16" maxlength="16" onclick="return false;" onblur="isalldigits(this.id); return true;"/><br>
  	<font color="red">*</font>Credit Card Exp Date: <select name="ccexpmonth"> <?php echo createDropdown($monthsArray); ?> </select>
  	<input name="ccexpyear" id="idccexpyear" type="text" size="4" maxlength="4" onclick="return false;" onblur="isalldigits(this.id); return true;"/><br>
  	<font color="red">*</font>Billing Zip Code: <input name="ccbillzip" id="idccbillzip" type="text" size="5" maxlength="5" onclick="return false;" onblur="validatezip(this.id); return true;"/><br>
  	-->
  	
  	<br>
	<input type="submit" value="Submit" />
	<input type="reset" value="Clear" />
</form>
<script language="JavaScript"><!--document.appform.reset();--></script>

<hr>
<b>Disclaimer:</b> Final policy approval is subject to telephone confirmation.  Please make sure applicant is available on telephone number provided.  If any changes in terms or conditions are required, applicant will be notified prior to issuance of final policy.<br>
<!--<b>Disclaimer:</b> Final policy approval is subject to underwriting review.  If any changes in terms or conditions are required, applicant will be notified prior to issuance of final policy.-->

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7650802-2");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>
