<?php 
	include '../includes/header.php';
	include "../includes/db_connect.php";
	include '../class_lib/farmer.php';

	if (!isset($_SESSION['extension_agent_id']) && !isset($_SESSION['admin'])) {
		header("location:../index.php");
	}
	if (!isset($_SESSION['extension_agent_id'])) {
		$admin=$_SESSION['admin'];
	}else{
		$agent_id=$_SESSION['extension_agent_id'];
	}

	$RegisterInstance= new Farmer;

	$error="";
	if (isset($_POST['submit'])) {
		$fileExtension = strrchr($_FILES['picture']['name'], ".");
		$surname=strip_tags(trim($_POST['surname']));
		$othername=strip_tags(trim($_POST['othername']));
		$email=strip_tags($_POST['email']);
		$address=strip_tags($_POST['address']);
		$plot=strip_tags($_POST['farm_size']);
		$soil_type=strip_tags($_POST['soil_type']);
		$farm_method=strip_tags($_POST['farm_method']);
		$yield=strip_tags($_POST['yield']);
		$geolocation=strip_tags($_POST['geolocation']);
		$earning=strip_tags($_POST['earning']);
		$challenges=strip_tags($_POST['challenges']);
		$fertilizer_quantity_requested=strip_tags(trim($_POST['fertilizer']));
		$amount_paid=strip_tags(trim($_POST['amount_paid']));
		$agent=strip_tags($_POST['agent_id']);
		$fertilizer_quantity_collected=0;
		$reg_time=date('d m Y h:i:s');
		$collected_time='00 00 0000 0:0:0';
		$status=0;

		if(empty($amount_paid) || !preg_match("/[0-9]+$/",$amount_paid)){
        	$error = "please enter a valid figure for amount collected";
        }
        if(empty($fertilizer_quantity_requested) || !preg_match("/[0-9]+$/",$fertilizer_quantity_requested)){
        	$error = "please enter a valid number for quantity of fertilizer";
        }
        if(empty($farm_method)){
        	$error = "please enter the farming method used";
        }
        if(empty($challenges)){
        	$error = "please enter the challenges faced";
        }
        if(empty($earning)){
        	$error = "please enter the earning value";
        }
        if(empty($geolocation)){
        	$error = "please enter the geolocation";
        }
        if(empty($yield)){
        	$error = "please enter the Total yield  value";
        }
        if(empty($soil_type)){
        	$error = "please enter the soil type";
        }
        if(empty($plot)){
        	$error = "please enter the size of the Land";
        }
        if(empty($_POST['farm_type'])){
        	$error = "please select the farm_type";
        }else{
        	$farm_type=strip_tags($_POST['farm_type']);
        }
        if(empty($_POST['category'])){
        	$error = "please select the farming category";
        }else{
        	$category=strip_tags($_POST['category']);
        }
        $number=strip_tags($_POST['number']);
        if(empty($number) || !preg_match("/^[0-9]\d{10}$/",$number)){
        	$error = "please enter a valid phone number";
        }

        $barcode=$RegisterInstance->keygen();
		$barcode.=$number;
		$_SESSION['barcode_val']=$barcode;


        if(empty($address)){
        	$error = "please enter your Address";
        }
        if(empty($_POST['ward'])){
        	$error = "please select your Ward Name";
        }else{
        	$ward=strip_tags($_POST['ward']);
        }
        if(empty($_POST['LGA'])){
        	$error = "please select your Local Government Area(LGA)";
        }else{
        	$LGA=strip_tags($_POST['LGA']);
        }
        if(empty($othername) || !preg_match("/[a-bA-Z]+[0-9]*/",$othername)){
        	$error = "please enter your valid othernames";
        }
        if(empty($surname) || !preg_match("/[a-bA-Z]+[0-9]*/",$surname)){
        	$error = "please enter your valid Surname";
        }
        if($_FILES['picture']['size']== 0){
        	$error = "please select a picture";
        }
        if (empty($error)) 
	        {
	        	$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
			    // get extension of the uploaded file
			    $fileExtension = strrchr($_FILES['picture']['name'], ".");
			    // get the extension of the file to be uploaded
			    // check if file Extension is on the list of allowed ones
			    if (in_array($fileExtension, $validExtensions)) 
			    {
			        
					$newName = time() . '_' . $_FILES['picture']['name'];
				        $destination = '../uploads/' . $newName;
					if (move_uploaded_file($_FILES['picture']['tmp_name'], $destination))
					{
						$RegisterInstance->registerFarmer($surname, $othername, $newName, $address, $number, $email, $soil_type, $plot, $yield, $geolocation, $earning, $challenges, $farm_method, $LGA, $ward, $category, $farm_type, $status, $fertilizer_quantity_requested, $fertilizer_quantity_collected, $amount_paid, $barcode, $agent, $reg_time, $collected_time);
						$RegisterInstance->updatebalance($barcode);
						echo "<script>window.location.href='printid.php?barcode=".$barcode."';
				</script>";
				    }
			    }
			}
	}
?>
        

			<div class="col-md-6">
				<nav class="collapse navbar-collapse" id="myNavbar" role="navigation">
					<ul class="nav navbar-nav navbar-right menu">
							<li><a href="home.php" class="page-scroll active">Home</a></li>
							<li><a href="view.php" class="page-scroll">View Farmer</a></li>
							<?php
								if (isset($_SESSION['admin'])) {
								?>
								<li><a href="../sms/sendnotification.php" class="page-scroll">Send notification</a></li>
								<?php
								}
							?>
							<li><a href="../logout.php" class="page-scroll">Logout</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>

<div class="container-fluid features" id="section2">		        
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center features-text" style="color">Registration Form</h2>
			</div>
			<form action="register.php" method="POST" enctype="multipart/form-data">
			<div class="col-md-12" id="formfont">
				<div class="col-md-1"></div>

				<div class="col-md-10">
					<div class="col-md-12">
						<div style="text-align:center;"><i>All fields marked with the&nbsp;<em style="color:red;" >*</em>&nbsp; symbol are compulsory fields</i></div><br/>
						<h3  style="text-align:center; font-size:30px;">Personal Information</h3>
						<div class="row" style="color:red; text-align: centre; font-size: 20px; margin-bottom:10px;"><?php echo $error; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>Picture:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="file" name="picture" value="">
						</div>
						<div class="col-md-8"></div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Surname:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="surname" value="<?php echo !empty($_POST['surname']) ? $_POST['surname'] : ""; ?>" Placeholder="surname" class="form-control">
						</div>
						<div class="col-md-6">
							<label>Other Names:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="othername" value="<?php echo !empty($_POST['othername']) ? $_POST['othername'] : ""; ?>" Placeholder="othernames" class="form-control"><br/>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-6">
							<label>L.G.A:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<select name="LGA" id="LGA" class="form-control">
									<option value="">select LGA</option>
								</select>
						</div>
						<div class="col-md-6">
							<label>Ward:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<select name="ward" id="ward" disabled="disabled" class="form-control">
									<option value="">select ward</option>
								</select>
						</div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Address:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<textarea cols="20" rows="6" name="address" value="<?php echo !empty($_POST['address']) ? $_POST['address'] : ""; ?>" Placeholder="address"  class="form-control"></textarea>
						</div>
						<div class="col-md-6">
							<div class="row" style="margin:0px 2px 0px 2px;">
								<label>Phone Number:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="number" value="<?php echo !empty($_POST['number']) ? $_POST['number'] : ""; ?>" Placeholder="Phone Number" class="form-control"><br/>
							</div>
							<div class="row" style="margin:15px 2px 0px 2px;">
								<label>Email:</label>
								<input type="text" name="email" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ""; ?>" Placeholder="email@example.com" class="form-control">
							</div>
						</div>
					</div>
					<br/><br/>
					<div class="col-md-12">
						<h3  style="text-align:center; font-size:30px;">Farm information</h3><br/>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<label>Farming category:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<select name="category" id="category"  class="form-control">
									<option value="">Select farm category</option>
								</select>
						</div>
						<div class="col-md-6">
							<label>Farming Type:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<select name="farm_type" id="farm_type" disabled="disabled" class="form-control">
									<option value="">Select farming fype</option>
								</select>
						</div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Farmland Size:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="farm_size" value="<?php echo !empty($_POST['farm_size']) ? $_POST['farm_size'] : ""; ?>" Placeholder="e.g. 3 plots" class="form-control">
						</div>
						<div class="col-md-6">
							<label>Soil Type:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="soil_type" value="<?php echo !empty($_POST['soil_type']) ? $_POST['soil_type'] : ""; ?>" Placeholder="e.g Sandy, clay or loamy" class="form-control">
						</div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Total Yield of product:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="yield" value="<?php echo !empty($_POST['yield']) ? $_POST['yield'] : ""; ?>" Placeholder="e.g 50 bags of maize" class="form-control">
						</div>
						<div class="col-md-6">
							<label>Geolocation:</label>
								<input type="text" name="geolocation" value="<?php echo !empty($_POST['geolocation']) ? $_POST['geolocation'] : ""; ?>" Placeholder="e.g north, east, west or south" class="form-control">
						</div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Earnings:</label>
								<input type="text" name="earning" value="<?php echo !empty($_POST['earning']) ? $_POST['earning'] : ""; ?>" Placeholder="e.g 500000" class="form-control">
						</div>
						<div class="col-md-6">
							<label>Challenges:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="challenges" value="<?php echo !empty($_POST['challenges']) ? $_POST['challenges'] : ""; ?>" Placeholder="e.g Inadequate Manpower, Insufficent Fertilizer" class="form-control">
						</div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Farming Method:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="farm_method" value="<?php echo !empty($_POST['farm_method']) ? $_POST['farm_method'] : ""; ?>" Placeholder="e.g mechanized or manual" class="form-control">
						</div>
					</div>
					<br/><br/>
					<div class="col-md-12">
						<h3  style="text-align:center; font-size:30px;">Fertilizer information</h3><br/>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Quantity of Fertilizer:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="fertilizer" value="<?php echo !empty($_POST['fertilizer']) ? $_POST['fertilizer'] : ""; ?>" Placeholder="e.g 20" class="form-control">
						</div>
						<div class="col-md-6">
							<label>Amount Collected:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="text" name="amount_paid" value="<?php echo !empty($_POST['amount_paid']) ? $_POST['amount_paid'] : ""; ?>" Placeholder="e.g 100000" class="form-control">
						</div>
					</div>
					<div>
						<input type="hidden" name="agent_id" value="<?php echo !isset($_SESSION['extension_agent_id'])? $admin : $agent_id; ?>">
					</div>
					<br/>
					<div class="row">
						<div class="col-md-3">
							<input id="submit" type="submit" name="submit" value="Submit" Placeholder="" class="btn btn-warning">
						</div>
						<div class="col-md-9"></div>
					</div>
					
				</div>

				<div class="col-md-1"></div>
					
			</div>
			</form>		
		</div>
	</div>
</div>


<?php include '../includes/footer.php'; ?>
