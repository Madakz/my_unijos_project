<?php
	session_start();
	include "../includes/db_connect.php";
	include '../class_lib/farmer.php';

	$getFarmerInstance= new Farmer;
	if (!isset($_SESSION['barcode_val'])) {
		$barcode_=$_GET['barcode_val'];
	}else{
		$barcode_=$_SESSION['barcode_val'];
	}
	
	$fetch_farmer=$getFarmerInstance->getFarmer($barcode_);
	$row=mysql_fetch_array($fetch_farmer) or die(mysql_error());
?>

<!DOCTYPE html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Plateau State Ministry of Agriculture</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script language="JavaScript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/qrcode.js"></script>
	    <script language="JavaScript" src="../js/functionslw.js"></script>
	    <script type="text/javascript" src="../js/dropdown.js"></script>
	    <script language="JavaScript" src="../js/functionfarm.js"></script>
	    <script type="text/javascript" src="../js/farmcatdrop.js"></script>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../style.css" type="text/css">
		<link href="../css/lightbox.css" rel="stylesheet">
	</head>
	<body>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="row printhead">
	      			<h1><img src="../images/logo.jpg" style="width:70px; height:65px; "> Plateau State Farmers</h1>
	      			<h3>Fertilizer Distribution ID Card</h3>
				</div>
				<div class="row detail">
					<table class="table table-hover alert-success move">
	                    <tbody><tr><td><strong>Fullname:</strong></td><td><b><?php echo $row['surname'].'</b> <i>&nbsp;'.$row['othernames'];?></i></td><td><img style="margin-top:0px; height:180px; width:180px;" src="../uploads/<?php echo $row['picture'];?>"></td></tr>
		                    <tr><td><strong>Phone Number:</strong></td><td><i><?php echo $row['phone_number'];?></i></td></tr>
		                    <?php 
			                    $lga_id=$row['LGA_id'];
									$lga=mysql_query("SELECT * FROM farmers, localgovtArea WHERE localgovtArea.id= '$lga_id'") or die(mysql_error());
								$getLga=mysql_fetch_array($lga) or die(mysql_error());
							?>
		                    <tr><td><strong>Local Government Area:</strong></td><td><i><?php echo $getLga['lga_name'];?></i></td></tr>
		                    <?php 
			                    $ward_id=$row['ward_id'];
								$ward=mysql_query("SELECT * FROM farmers, ward WHERE ward.id= '$ward_id'") or die(mysql_error());
								$getward=mysql_fetch_array($ward) or die(mysql_error());
							?>
		                    <tr><td><strong>Ward:</strong></td><td><i><?php echo $getward['ward_name'];?></i></td></tr>
		                    <!-- <tr><td>Programme:</td><td>M Phil/PhD Sociology</td></tr>
		                    <tr><td>Print Date:</td><td>19-Jan-2017</td></tr>
		                    <tr><td>Session:</td><td>2016/2017</td></tr> -->
		                    
	                	</tbody>
	               </table>
	               <input id="text" type="hidden" name="qrvalue" value="<?php echo $barcode_; ?>"/>
					<div id="qrcode" style="margin-left:250px;"></div><br/>
			
	 
					<script type="text/javascript">
								var qrcode = new QRCode(document.getElementById("qrcode"), {
								width : 150,
								height : 150
							});
							var elText = document.getElementById("text");
							
							qrcode.makeCode(elText.value);

					</script>
					<div class="found">
						<p style="padding-left:15px;">If Found, please return to the above name or the Plateau State Ministry of Agriculture</p>
						<p style="text-align:center;">Authorized Signature:.........................</p>
					</div>
					<div class="col-md-12">
						<div class="col-md-2" style="margin-top:10px;"><button type="button" class="btn btn-primary" onclick="window.history.back(-1);"><?php echo '<< Back';?></button></div>
						<div class="col-md-2" style="margin-top:10px;"><button type="button" class="btn btn-success " onclick="window.print();">PRINT ID</button></div>
						<div class="col-md-8"></div>
					</div>
					
	            </div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</body>
</html>