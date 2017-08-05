<?php
	session_start();
	// include "includes/db_connect.php";
	
	class extensionAgent{

		//defining register function
		public function RegisterAgent($name, $email, $lga, $ward_id, $username, $password){
			$check=mysql_query("SELECT * FROM extension_agent WHERE email='$email'") or die(mysql_error());
			if (mysql_num_rows($check) != 0) {
				$response="<script>alert('Extension Agent with email: " .$email. " already exist');</script>";
			}else{
				$query=mysql_query("INSERT INTO extension_agent VALUES(NULL,'$name', '$email', '$username', '$password', '$lga', '$ward_id')") or die(mysql_error());
				$test_id=mysql_insert_id();
				
				if ($query) {
					$response="<script>alert('Extension Agent".$name.'	with email ' .$email. " is successfully registered!');</script>";
				}else{
					$response="<script>alert('Registeration Failed!!!');</script>";
				}
			}
			echo $response;
		}
		//end register Function

		//defining viewall function
		public function Viewall(){
			$query=mysql_query("SELECT * FROM extension_agent ORDER BY id DESC") or die(mysql_error());
			return $query;
		}
		//end viewall Function

		//defining edit function
		public function EditAgent($agent_id){
			$query=mysql_query("SELECT * FROM extension_agent WHERE id='$agent_id'") or die(mysql_error());
			$sql=mysql_fetch_array($query) or die(mysql_error());
			return $sql;
		}
		//end edit Function

		//defining UpdateEdit function
		public function UpdateEdit($Agent, $name, $email, $lga, $ward_id, $username, $password){
			$query=mysql_query("UPDATE extension_agent SET name='$name', email='$email', username='$username', password='$password', LGA_id='$lga', ward_id='$ward_id' WHERE id='$Agent'") or die(mysql_error());
			if ($query) {
				$response="<script>alert('Update is successful!'); window.location.href='viewall.php';</script>";
			}else{
				$response="<script>alert('Update Failed!'); window.location.href='viewall.php';</script>";
			}
			echo $response;

		}
		//end UpdateEdit Function
	}
?>