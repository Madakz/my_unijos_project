<?php
	$number='0813694334';
	if(!preg_match("/^[0-9]\d{10}$/",$number)){
        	echo "please enter a valid phone number";
        }else{
        	echo 'good';
        }
?>