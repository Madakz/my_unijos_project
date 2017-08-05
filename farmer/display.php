<?php
	include "../includes/db_connect.php";
	include '../class_lib/farmer.php';
	if (!isset($_SESSION['extension_agent_id']) && !isset($_SESSION['admin'])) {
		// header("location:../index.php");
	}
	$getFarmerInstance= new Farmer;
	
	$bar= $_GET['barcode'];
	$_SESSION['barcode_val']=$bar;

	$sql=$getFarmerInstance->getFarmer($bar);
	// die($bar);
	if(mysql_num_rows($sql)>= 1)
	{
		$g=mysql_fetch_array($sql);
	}elseif (mysql_num_rows($sql)< 1) {
		header("location:view.php?error=1");
	}

	$balance=$getFarmerInstance->getbalance($bar);
	$bal=mysql_fetch_array($balance) or die(mysql_error());
	

	
		                       
	$error="";
	if (isset($_POST['give'])) {
		$bal=strip_tags($_POST['balance']);
		$collected_time=date('d m Y h:i:s');
		$barcode=strip_tags($_POST['bar']);
		$balance=$getFarmerInstance->getbalance($bar);
		$lg=mysql_fetch_array($balance) or die(mysql_error());
		$bal=$bal-$lg['balance'];
		$fertilizer=strip_tags($_POST['fertilizer']);
		if ($fertilizer < 0 || empty($fertilizer)|| !preg_match("/[0-9]+$/",$fertilizer)) {
			$error="Please enter a valid value";
		}
		if (empty($error)) {
			$getFarmerInstance->updatefertilizer($fertilizer, $collected_time, $bal, $barcode);
		}
	}

	
	//die(print_r($g));
?>
<?php include '../includes/header.php'; ?> 
			<div class="col-md-6">
				<nav class="collapse navbar-collapse" id="myNavbar" role="navigation">
					<ul class="nav navbar-nav navbar-right menu">
							<li><a href="home.php" class="page-scroll active">Home</a></li>
							<li><a href="register.php" class="page-scroll">Registration</a></li>
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
				<h2 class="text-center features-text" style="color">Farmer's Record</h2>
			</div>
			<div class="col-md-12" id="formfont">
				<div class="col-md-1"></div>

				<div class="col-md-10">



					<div class="panel-body">
		                <table class="table table-hover alert-success">
                            <tbody>
                            	<tr><td><strong>Passport:</strong></td><td><p><img src="../uploads/<?php echo $g['picture']?>"  width="130px" height="120px"></p></td></tr>
		                        <tr><td><strong>Fullname:</strong></td><td><?php echo $g['surname'].' '.$g['othernames'];?></td></tr>
		                        <tr><td><strong>Address:</strong></td><td><?php echo $g['address']?></td></tr>
		                        <tr><td><strong>Phone Number:</strong></td><td><?php echo $g['phone_number']?></td></tr>
									<?php
										$id=$g['LGA_id'];
										$qwery=$getFarmerInstance->getLGA($id);
										$lg=mysql_fetch_array($qwery) or die(mysql_error());
									?>
		                        <tr><td><strong>Local Government Area:</strong></td><td><?php echo $lg['lga_name']?></td></tr>
									<?php
										$id=$g['ward_id'];
										$qwery=$getFarmerInstance->getWard($id);
										$lg=mysql_fetch_array($qwery) or die(mysql_error());
									?>
		                        <tr><td><strong>Ward:</strong></td><td><?php echo $lg['ward_name']?></td></tr>
		                        <tr><td><strong>Farming Method:</strong></td><td><?php echo $g['farming_method'];?></td></tr>
		                        <tr><td><strong>Fertilizer Quantity Requested:</strong></td><td><?php echo $g['fertilizer_quantity_requested']?>&nbsp;bags</td></tr>
		                       	<tr><td><strong>Fertilizer Quantity Collected:</strong></td><td><?php echo $g['fertilizer_quantity_collected']?>&nbsp;bags</td></tr>
		                       	<tr><td><strong>Amount Paid:</strong></td><td>N<?php echo $g['amount_paid']?></td></tr>
		                       	<?php
		                       		// if ($bal['balance']==0) {
		                       		// 	$balances=0;
		                       		// }else{
		                       		// 	$balances=$bal['balance'];
		                       		// }
		                       	?>
		                       	<tr><td><strong>Balance to be Paid:</strong></td><td>N<?php echo $bal['balance'];?></td></tr>
		                       	<tr><td><strong>Fertilizer Collected Time:</strong></td><td><?php echo $g['fertilizer_collected_time']?></td></tr>
		                       	
		                       	<!-- <tr><td><strong>Department:</strong></td><td>Sociology</td></tr>
		                       	<tr><td><strong>Department:</strong></td><td>Sociology</td></tr> -->

                        </tbody></table>
                        <div class="col-md-4" style="margin-top:50px;">
							<a href="printid.php?barcode_val=<?php echo $bar;?>"><button class="btn btn-primary form-control">View ID card</button></a>
						</div>
						<?php
							// $collected=$g['fertilizer_quantity_collected'];
							if ($g['fertilizer_quantity_collected']==0) {
								// die($g['fertilizer_quantity_collected']);
						?>
							<div class="col-md-4" style="margin-top:50px;">
								<button id="flip" class="btn btn-warning form-control"><a href="#flip">Give Fertilizer</a></button>
							</div>
						<?php
							}
						?>
						
						<div class="col-sm-12 col-md-12">
							<div class="row alert-success" id="panel">
								<form action="display.php?barcode=<?php echo $bar;?>" method="POST">
									<div style="color:red; font-size:15px;"><?php echo $error;?></div>
									<label style="font-size:20px;">Number of Bag(s):&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
									<input type="text" name="fertilizer" value="<?php echo !empty($_POST['fertilizer']) ? $_POST['fertilizer'] : ""; ?>" placeholder="e.g 20" class="form-control"><br/><br/>
									<?php
										if ($bal['balance']!=0) {
									?>
										<label style="font-size:20px;">Balance:</label>
										<input type="text" name="balance" value="<?php echo !empty($_POST['balance']) ? $_POST['balance'] : ""; ?>" placeholder="e.g 200000" class="form-control"><br/><br/>
									<?php
										}else{
									?>
											<input type="hidden" name="balance" value="0">
									<?php
										}
									?>
									
									<input type="hidden" name="bar" value="<?php echo $bar;?>">
									<input type="submit" name="give" value="Submit" class="btn btn-warning">
								</form>
							</div>
							<script> 
								$(document).ready(function(){
								    $("#flip").click(function(){
								        $("#panel").fadeToggle(1500);
								    });
								    
								});
							</script>
								 
							<style> 
								 #flip a{
								    text-align: center;
								    color:#ffffff;
								    text-decoration: none;
								}
								#flip:hover{color:	#E67E00;}

								#panel {
								    margin-top:15px;
								    display: none;
								    background-color:  #8ab839;
								    /*text-align: center;*/
								    /*color: #ffffff;*/
								    padding-bottom: 15px;
								    margin-bottom: 15px;
								    font-size: 10px;

								}
								#panel label{
								    color: #ffffff;
								}
							</style>
						</div>
			        </div>
				</div>
				<div class="col-md-1"></div>
			</div>		
		</div>
	</div>
</div>

<?php include '../includes/footer.php'; ?>