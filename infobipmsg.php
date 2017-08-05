<?php
include './includes/db_connect.php';
header("POST /sms/1/text/single HTTP/1.1");
header("Host: api.infobip.com");
header("Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==");
// Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==

header("Content-Type: application/json");

$from="madaki";
$message='just trying my thing';
echo '{';  
   echo '"from"'.':'."\"$from\"".",\n";
   echo '"to"'.':[';
	$query=mysql_query("SELECT phone_number FROM farmers") or die(mysql_error());
	while ($fetch=mysql_fetch_array($query)) {
		$numwitO=$fetch['phone_number'];
		$numwitO=substr($numwitO, 1);	//this is to remove the first zero in any number
		$numbers="";
		$numbers.='234'.$numwitO;
		// $numbers=substr($numbers, 0, -1);
   echo  "\"$numbers\"".","."\n";
   }
   echo "],\n";
	
	
  echo '"text"'.':'."\"$message\"";
echo '}';
