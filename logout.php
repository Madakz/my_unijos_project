<?php
	include "./class_lib/authenticate.php";

	$logout=new Authentications;
	$logout->Logout();
	header('location:index.php');

?>
