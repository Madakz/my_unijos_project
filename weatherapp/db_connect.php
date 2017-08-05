<?php
	$hostname ="localhost";
	$username = "root";
	$passwd = "madivel@";
	$dbname ="plateau_farmers";
	$Php_image = mysql_connect($hostname,$username,$passwd) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
 ?>