<?php
	include "./class_lib/authenticate.php";			//adding the payrollclass file here
	include "./includes/db_connect.php";
	$remove = new Authentications;		//creating an object of the class DELETE_OFFICIAL
	

	if ($_GET['agent']) {			//check if the server variable official has been sent from the view single page for deleting
		$id = $_GET['agent'];		//pass the server variable to the is variable
		$remove->delete("extension_agent", $id);			//making use of the object to call the delete function by passing the table name and id
	}
?>