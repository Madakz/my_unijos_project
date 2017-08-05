<?php
	include '../includes/header.php';
	include 'class-Clockwork.php';
	include '../includes/db_connect.php';
	if (!isset($_SESSION['admin'])) {
		header("location:../index.php");
	}

	if (isset($_GET['sendsms'])) {
		try
		{
		//     // Create a Clockwork object using your API key
		//     $clockwork = new Clockwork( $API_KEY );

		//     // Setup and send a message
		//     $message = array( 'to' => "$to", 'message' => "$message" );
		//     $result = $clockwork->send( $message );

		    // Check if the send was successful
		    // if($result['success']) {
		    //     echo 'Message sent - ID: ' . $result['id'];
		    // } else {
		    //     echo 'Message failed - Error: ' . $result['error_message'];
		    // }
		}
		catch (ClockworkException $e)
		{
		    echo 'Exception sending SMS: ' . $e->getMessage();
		}
	}
	
?>
	<style type="text/css">
	.head{
		background-color: green;
	}
	.head a{
		color:#ffffff;
		font-size: 50px;
		text-align: center;
	}
	.head a:hover{
		color:red;
	}
	.logbody{
		margin-top: 100px;
		/*background-image: url(./images/agriclogo.jpg);
		background-repeat: no-repeat;*/
	}
	</style>
	<div class="col-md-6">
				<nav class="collapse navbar-collapse" id="myNavbar" role="navigation">
					<ul class="nav navbar-nav navbar-right menu">
							<li><a href="../farmer/home.php" class="page-scroll active">Home</a></li>
							<li><a href="../farmer/view.php" class="page-scroll">View Farmer</a></li>
							<li><a href="../logout.php" class="page-scroll">Logout</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>
		<div class="col-md-12">
			<div class="col-md-4"></div>
			<div class="col-md-4 logbody" style="">
				<h1><b>Send Notification</b></h1>
				<form action="https://api.clockworksms.com/http/send.aspx" method="GET">
					<?php
						$numbers='';
						$query=mysql_query("SELECT phone_number FROM farmers") or die(mysql_error());
						while ($fetch=mysql_fetch_array($query)) {
							$numwitO=$fetch['phone_number'];
							$numwitO=substr($numwitO, 1);	//this is to remove the first zero in any number
							$numbers.='234'.$numwitO.',';
							
						}
						$numbers=substr($numbers, 0, -1);
						
					?>
					<input type="hidden" name="key" value="ea61673ede69877335d21258e425903b3526c4e4">
					<input type="hidden" name="from" value="2347032807741">
					<input type="hidden" name="long" value="1">
					<label>To:</label>
					<input type="text" name="to" value="<?php echo $numbers;?>" class="form-control">
					<br/>
					<label>Message:</label>
					<input type="text" name="content" value="" class="form-control">
					<br/>
					
					
					
					<input type="submit" name="sendsms" value="Send sms" class="form-control btn btn-primary">
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="col-md-12">
			<center><?php include '../includes/footer.php';?></center>
		</div>
	</body>
</html>

