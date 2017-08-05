<?php
	
	// include "includes/db_connect.php";

	class Farmer{

		public function keygen($length = 5) {
		    $token = '';
		    list($end, $start) = explode(' ', microtime());
		    mt_srand((float) $start + ((float) $end * 100000));

		    $inputs = array_merge(range(0, 9), range('A', 'Z'));

		    for ($i = 0; $i < $length; $i++) {

		        $token .= $inputs{mt_rand(0, 35)};
		    }
		    return $token;
		}


		//defining register function
		public function registerFarmer($surname, $othername, $newName, $address, $number, $email, $soil_type, $plot, $yield, $geolocation, $earning, $challenges, $farm_method, $LGA, $ward, $category, $farm_type, $status, $fertilizer_quantity_requested, $fertilizer_quantity_collected, $amount_paid, $barcode, $agent, $reg_time, $collected_time) {
			$check=mysql_query("SELECT * FROM farmers WHERE phone_number='$number' AND surname='$surname' AND othernames='$othername'") or die(mysql_error());
			if (mysql_num_rows($check) != 0) {
				$fetch=mysql_fetch_array($check) or die(mysql_error());
				// die('what');
				$_SESSION['barcode_val']=$fetch['barcode_info'];
				// die($_SESSION['barcode_val']);
				unlink('../uploads/'.$newName);
				$response="<script>alert('Farmer with phone number: " .$number." and name: ".$surname." ".$othername. " already exist');
				window.location.href='printid.php';
				</script>";
			}else{
				$query=mysql_query("INSERT INTO farmers VALUES(NULL, '$surname', '$othername', '$newName', '$address', '$number', '$email', '$soil_type', '$plot', '$yield','$geolocation', '$earning', '$challenges', '$farm_method', '$LGA', '$ward', '$category', '$farm_type', '$status', '$fertilizer_quantity_requested', '$fertilizer_quantity_collected', '$amount_paid', '0', '$barcode', '$agent', '$reg_time', '$collected_time')") or die(mysql_error());
				
				if ($query) {
					$response="<script>alert('Farmer ".$surname.' '.$othername.' with phone number ' .$number. " is successfully registered!');</script>";
				}else{
					$response="<script>alert('Registeration Failed!!!');</script>";
				}
			}
			echo $response;
		}
		//end register Function

		//get farmer
		public function getFarmer($barcode_){
			$query=mysql_query("SELECT * FROM farmers WHERE barcode_info='$barcode_'") or die(mysql_error());
			return $query;
		}
		//end get farmer function

		//get LGA
		public function getLGA($id){
			$query=mysql_query("SELECT * FROM localgovtArea WHERE id='$id'") or die(mysql_error());
			return $query;
		}
		//end LGA function

		//get ward
		public function getWard($id){
			$query=mysql_query("SELECT * FROM ward WHERE id='$id'") or die(mysql_error());
			return $query;
		}
		//end ward function

		//calculateBal
		public function calculateBal($barcode_){
			$query=mysql_query("SELECT amount FROM fertilizer_charge") or die(mysql_error());
			$sql=mysql_fetch_array($query) or die(mysql_error());
			$charge=$sql['amount'];
			$farmer=self::getFarmer($barcode_);
			$sql=mysql_fetch_array($farmer) or die(mysql_error());
			$quantity_requested=$sql['fertilizer_quantity_requested'];
			$amount_paid=$sql['amount_paid'];
			$total_charge=$charge*$quantity_requested;
			$balance=$total_charge-$amount_paid;
			// echo $balance;
			return $balance;
		}
		//end calculateBal function

		//update balance column function
		public function updatebalance($barcode_){
			$balance=self::calculateBal($barcode_);
			$query=mysql_query("UPDATE farmers SET balance='$balance' WHERE barcode_info='$barcode_'") or die(mysql_error());
			// return $balance;
		}
		//end update function

		//getbalance column function
		public function getbalance($barcode_){
			$balance=self::calculateBal($barcode_);
			$query=mysql_query("SELECT balance FROM farmers WHERE barcode_info='$barcode_'") or die(mysql_error());
			return $query;
		}
		//end getbalance function

		//update fertilizer collected column function
		public function updatefertilizer($fertilizer, $collected_time, $balance, $barcode_){
			$query=mysql_query("UPDATE farmers SET fertilizer_quantity_collected='$fertilizer', balance='$balance', fertilizer_collected_time='$collected_time' WHERE barcode_info='$barcode_'") or die(mysql_error());
			// return $balance;
		}
		//end update fertilizer collected function



	}
?>