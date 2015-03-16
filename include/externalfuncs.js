function ShowOptions(num, menu, max) {
	var disp = menu + num;
	document.getElementById(disp).style.display = 'block';
	for(i=1; i<=max; i++) {
		if(i!=num){
			disp2=menu+i;
			document.getElementById(disp2).style.display = 'none';
		}
	}
}
function PopulateACI(n) {
	if(n==0) {
		document.appform.aciflname.value="";
		document.appform.aciacn.value="";
		document.appform.acistreet.value="";
		document.appform.acicity.value="";
		document.appform.acizip.value="";
		
		document.appform.aciflname.style.backgroundColor="";
		document.appform.aciacn.style.backgroundColor="";
		document.appform.acistreet.style.backgroundColor="";
		document.appform.acicity.style.backgroundColor="";
		document.appform.acizip.style.backgroundColor="";
		
		document.appform.aciflname.readOnly = false;
		document.appform.aciacn.readOnly = false;
		document.appform.acistreet.readOnly = false;
		document.appform.acicity.readOnly = false;
		document.appform.acizip.readOnly = false;
	}
	else {
		if(n==1) {
			document.appform.aciflname.value="Melroy Property Management";
			document.appform.aciacn.value="A Melroy Managed Property";
			document.appform.acistreet.value="4241 Jutland Drive, #201";
			document.appform.acicity.value="San Diego";
			document.appform.acizip.value="92117";
		}
		
		document.appform.aciflname.style.backgroundColor="#d3d3d3";
		document.appform.aciacn.style.backgroundColor="#d3d3d3";
		document.appform.acistreet.style.backgroundColor="#d3d3d3";
		document.appform.acicity.style.backgroundColor="#d3d3d3";
		document.appform.acizip.style.backgroundColor="#d3d3d3";
		
		document.appform.aciflname.readOnly = true;
		document.appform.aciacn.readOnly = true;
		document.appform.acistreet.readOnly = true;
		document.appform.acicity.readOnly = true;
		document.appform.acizip.readOnly = true;
	}
}
function isalldigits(id){
   inputval=document.getElementById(id).value;
   if(isNaN(inputval)){
   	alert('Value must be all digits');
   }
}
function validatezip(id){
   inputval=document.getElementById(id).value;
   if(isNaN(inputval) || inputval.length!=5){
   	if(inputval!=""){
   		alert('Zip must be a 5 DIGIT number');
   	}
   }
}
function getDayOfWeek(monthin, dayin, yearin) {
	/*	testdate = new Date(yearin, monthin, dayin);
	//testdate = new Date(2009,1,2);
	weekday = testdate.getDay();
	alert("weekday value calculated: " + weekday);*/
	
	monthinM1=monthin-1;
	d=new Date();
	d.setDate(1);
	d.setYear(yearin);
	d.setMonth(monthinM1);
	d.setDate(dayin);
	d.setHours(12);
	dayofweek=d.getDay();
	//alert("weekday2 value calculated: " + dayofweek);
	return dayofweek;
	
	/*
	* 0 = Sunday
    * 1 = Monday
    * 2 = Tuesday
    * 3 = Wednesday
    * 4 = Thursday
    * 5 = Friday
    * 6 = Saturday
	*/
}
function getDayOfWeekOld(monthin, dayin, yearin) {
	curdate = new Date();
	//currentyear = curdate.getFullYear();
	year = parseInt(yearin);
	month = parseInt(monthin);
	day = parseInt(dayin);
	CalendarSystem = 1;	//for Gregorian Calendar, 0 for Julian Calendar
	dayofweek = 0;
	
	if (month < 3) {
		month = month + 12;
		year = year - 1;
	}
	//dayofweek = (day + (2*month) + parseInt(6*(month+1)/10) + year + parseInt(year/4) - parseInt(year/100) + parseInt(year/400) + CalendarSystem) % 7;
	dayofweek = (day + (2*month) + Math.round((0.6*month)+0.6) + year + Math.round(year*0.25) - Math.round(year*0.01) + Math.round(year*0.0025) + CalendarSystem) % 7;
	//alert("year: " + year + " month: " + month + " day: " +day);
	
	return dayofweek-1;
	//return dayofweek;
	/*
	* 0 = Sunday
    * 1 = Monday
    * 2 = Tuesday
    * 3 = Wednesday
    * 4 = Thursday
    * 5 = Friday
    * 6 = Saturday
	*/
}
function validateForm (appform) {
	valid = true;
	zipRegex = /^\d{5}$/;
	twonumRegex = /^\d{2}$/;
	threenumRegex = /^\d{3}$/;
	fournumRegex = /^\d{4}$/;
	emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	ccRegex = /^\d{16}$/;
	spaceRegex = /^\s*$/;
	singRegex = /^\d{1}$/;
	curdate = new Date();
	currentyear = curdate.getFullYear();
	currentmonth = curdate.getMonth() + 1;
	currentdayofmonth = curdate.getDate();
	
	//document.appform.write("ppacn value: " + document.appform.prepopulatedACN.value + " flname: " + document.appform.aciflname.value);
	if((document.appform.prepopulatedACN.value == "0") && (null != spaceRegex.exec(document.appform.aciflname.value)) ||
	(null != spaceRegex.exec(document.appform.aciacn.value)) ||
	(null != spaceRegex.exec(document.appform.acistreet.value)) ||
	(null != spaceRegex.exec(document.appform.acicity.value)) ||
	(null != spaceRegex.exec(document.appform.acizip.value)) ||
	(null == zipRegex.exec(document.appform.acizip.value))) {
		alert("Please make sure the following fields are filled in correctly:\n\n" +
				"Leasing Manager's full name\n" +
				"Apartment complex name\n" +
				"Business address");
		document.appform.aciflname.focus();
		valid = false;
	}		//Occupant 1
	else if ((null != spaceRegex.exec(document.appform.fname1.value)) ||
	(null != spaceRegex.exec(document.appform.lname1.value)) ||
	(document.appform.dobmonth1.value == "0") ||
	(document.appform.dobday1.value == "DD") ||
	(null != spaceRegex.exec(document.appform.dobday1.value)) ||
	(null == twonumRegex.exec(document.appform.dobday1.value)) ||
	(document.appform.dobyear1.value == "YYYY") ||
	(null != spaceRegex.exec(document.appform.dobyear1.value)) ||
	(null == fournumRegex.exec(document.appform.dobyear1.value)) ||
	(null != spaceRegex.exec(document.appform.dlnum1.value)) ||
	(document.appform.dlstate1.value == "00") ||
	((document.appform.sex1[0].checked == false) && (document.appform.sex1[1].checked == false))){
		alert("Please make sure all of the fields for Occupant 1 are filled in correctly.");
		document.appform.fname1.focus();
		valid = false;
	}		//Insured location address
	else if ((null != spaceRegex.exec(document.appform.istreet.value)) ||
	(null != spaceRegex.exec(document.appform.icity.value)) ||
	(null != spaceRegex.exec(document.appform.izip.value)) ||
	(null == zipRegex.exec(document.appform.izip.value))) {
		alert("Please make sure all of the fields for Insured location address are filled in correctly.");
		document.appform.istreet.focus();
		valid = false;
	}		//Occupant contact info
	else if ((null != spaceRegex.exec(document.appform.areacode.value)) ||
	(null == threenumRegex.exec(document.appform.areacode.value)) ||
	(null != spaceRegex.exec(document.appform.cell3.value)) ||
	(null == threenumRegex.exec(document.appform.cell3.value)) ||
	(null != spaceRegex.exec(document.appform.cell4.value)) ||
	(null == fournumRegex.exec(document.appform.cell4.value)) ||
	(null != spaceRegex.exec(document.appform.email.value)) ||
	(null == emailRegex.exec(document.appform.email.value))) {
		alert("Please make sure all of the fields for Occupant Contact Info are filled in correctly.");
		document.appform.areacode.focus();
		valid = false;
	}		//Occupant auto info
	else if ((null != spaceRegex.exec(document.appform.caryear1.value)) ||
	(null == fournumRegex.exec(document.appform.caryear1.value)) ||
	(document.appform.carmake1.value == "0") ||
	(null != spaceRegex.exec(document.appform.carmodel1.value))) {
		alert("Please make sure all of the fields for Occupant Car/Motorcycle Infomation are filled in correctly.");
		document.appform.caryear1.focus();
		valid = false;
	}		//Effective Date
	else if ((document.appform.effmonth.value == "0") ||
	(document.appform.effmday.value == "0")) {
		alert("Please make sure the Effective Date is filled");
		document.appform.effweekday.focus();
		valid = false;
	}
	else if (((document.appform.effmonth.value < currentmonth) && (document.appform.effyear.value < currentyear))   ||
	((document.appform.effmonth.value == currentmonth) && (document.appform.effmday.value <= currentdayofmonth)) ||
	(document.appform.effyear.value < currentyear)) {

/*	else if (((document.appform.effmonth.value < currentmonth)&& (document.appform.effyear.value == currentyear)) ||
	(((document.appform.effmonth.value == currentmonth) && (document.appform.effmday.value <= currentdayofmonth) && (document.appform.effyear.value == currentyear))) || 
	(document.appform.effyear.value < currentyear)) { */
	
		alert("Please make sure the Effective Date is at least one business day in the future");
		document.appform.effweekday.focus();
		valid = false;
	}
	else if (getDayOfWeek(document.appform.effmonth.value, document.appform.effmday.value, document.appform.effyear.value) != document.appform.effweekday.value) {
		alert("Please make sure the Effective Date is a valid one.\nApplications may only be processed Monday - Friday");
		//alert("day of week: " + getDayOfWeek(document.appform.effmonth.value, document.appform.effmday.value, document.appform.effyear.value) + " effweekday: " + document.appform.effweekday.value);
		document.appform.effweekday.focus();
		valid = false;
	}		//Personal property coverage
	else if ((document.appform.po[0].checked == false) &&
	(document.appform.po[1].checked == false) &&
	(document.appform.po[2].checked == false) &&
	(document.appform.po[3].checked == false)) {
		alert("Please make sure one of the Personal Property Coverage options is selected.");
		document.appform.ppc[0].focus();
		valid = false;
	}		//Payment Info
/*	else if ((null != spaceRegex.exec(document.appform.ccnum.value)) ||
	(null == ccRegex.exec(document.appform.ccnum.value)) ||
	(document.appform.ccexpmonth.value == "0") ||
	(null != spaceRegex.exec(document.appform.ccexpyear.value)) ||
	(null == fournumRegex.exec(document.appform.ccexpyear.value)) ||
	(null != spaceRegex.exec(document.appform.ccbillzip.value)) ||
	(null == zipRegex.exec(document.appform.ccbillzip.value))) {
		alert("Please make sure all of the Payment Info fields are filled in correctly.");
		document.appform.cctype.focus();
		valid = false;
	}
	else if(((document.appform.cctype.value == "visa") && (document.appform.ccnum.value.charAt(0) != "4" )) ||
	((document.appform.cctype.value == "mastercard") && (document.appform.ccnum.value.charAt(0) != "5" ))) {
		alert("Please make sure the credit card type matches the credit card number");
		document.appform.ccnum.focus();
		valid = false;
	}
	else if((document.appform.ccexpyear.value < currentyear) ||
	((document.appform.ccexpyear.value == currentyear) && (document.appform.ccexpmonth.value <= currentmonth))) {
		alert("It seems that this credit card is expired, please enter a different one");
		document.appform.ccexpmonth.focus();
		valid = false
	}*/
	
	return valid;
}