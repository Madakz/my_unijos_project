<?php
$latitude='9.2994';
$longitude='8.9949';
$key = "89ad93bbc5fa1872b77b9e59c36fe3f7"; 
	$url = "https://api.darksky.net/forecast/" . $key . "/" . $latitude . "," . $longitude."?exclude=currently,minutely,hourly,flags";
	echo $url;

	$date=date_create();
	echo '<br/>'.date_timestamp_get($date);		//convert current time to unix timestamp

	$date1=date('d-M-Y H:i:s',1490918400);		//convert from unix timestamp to normal format
	echo '<br/>'.$date1;
	$date2=date('d-M-Y H:i:s',1490400000);
	echo '<br/>'.$date2;
	// die();
	// echo date_diff($date1,$date2);
	// $diff=1489968000+518400;		//20-03-2017 + 6 days
	$diff=1491001200-1490396400;		
	echo '<br/>'.$diff;
?>