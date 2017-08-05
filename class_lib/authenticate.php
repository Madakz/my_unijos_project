<?php
	session_start();
	/**
	* Title: Authentication class
	* Purpose: project
	* Author: Madaki Fatsen
	* Created: 1/01/2017
	*/

	

	class Authentications{
		private $username;
		private $password;

		//defining AgentLogin function
		public function AgentLogin($username, $password){
			$this->username=$username;
			$this->password=$password;
			
			$get_user = mysql_query("SELECT * FROM extension_agent WHERE username='$username' AND password ='$password'") or die(mysql_error());

			if(mysql_num_rows($get_user) > '0') {		//condition to check if a record is gotten from the database
			 	$get_user = mysql_fetch_array($get_user);  //fetches the record  and keeps it in $get_user
				$_SESSION['extension_agent_id'] = $get_user['id'];	//picks the extension_agent_id value from $get_user array and stores it in the firstname key
				$_SESSION['extension_agent_name'] = $get_user['name'];	//picks the name value from $get_user array and stores it in the lastname key
				// $_SESSION['lecturerid'] = $get_user['lecturer_id'];
				
			    header("location:farmer/home.php");
			}elseif ($username == 'madakifatsen@gmail.com' && $password == 'leegreen') {
				$_SESSION['admin'] = $username;	//picks the username value and stores it in the admin key
				header('location:farmer/home.php');
			}
			else{
				return "Invalid Login Details!!!";
			}
		}
		//end AgentLogin Function

		public function AdminLogin($username, $password){
			if ($username == 'madakifatsen@gmail.com' && $password == 'leegreen') {
				$_SESSION['admin'] = $username;	//picks the username value and stores it in the admin key
				header('location:registeragent.php');
			}else{
				echo "Invalid Login Details!!!";
			}
		}



		//defining Logout function
		public function Logout(){
			if (isset($_SESSION['admin'])) {
				$_SESSION = array();
				session_destroy();
				header("location:ExtensionAgent/index.php");
			}elseif (isset($_SESSION['extension_agent_name'])) {
				$_SESSION = array();
				session_destroy();
				header("location:index.php");
			}
			
			
		}
		//end Logout function

		//begin delete
		public function delete($tablename, $del){
			$query = mysql_query("DELETE FROM $tablename WHERE id='$del'") or die(mysql_error());
			if ($query) {
				$response="<script>alert('Record is successfully deleted!'); window.location.href='./ExtensionAgent/viewall.php';</script>";
			}else{
				$response="<script>alert('Deletion of record Failed!'); window.location.href='./ExtensionAgent/viewall.php';</script>";
			}
			echo $response;
		}
		//end delete
	}


?>

