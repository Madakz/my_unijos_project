<?php
	include "../includes/db_connect.php";
	include '../class_lib/extensionAgent.php';
	if (!isset($_SESSION['extension_agent_id'])) {
		header("location:../index.php");
	}
	$error="";
	if (isset($_POST['register'])) {
		$name=strip_tags($_POST['name']);
		$email=strip_tags($_POST['email']);
		if(empty($_POST['ward'])){
        	$error = "please select your Ward Name";
        }else{
        	$ward=strip_tags($_POST['ward']);
        }
        if(empty($_POST['LGA'])){
        	$error = "please enter your Local Government Area(LGA)";
        }else{
        	$LGA=strip_tags($_POST['LGA']);
        }
        if(empty($_POST['password']) || empty($_POST['cpassword']) || (($_POST['password'])!=$_POST['cpassword'])){
        	$error = "please re-enter password";
        }else{
        	$password=strip_tags(trim($_POST['password']));
        }
        $username=strip_tags(trim($_POST['username']));
        if(empty($username) || !preg_match("/[a-bA-Z]+[0-9]*/",$username)){
        	$error = "please enter your username and username should be alphanumeric";
        }
        if(empty($email)){
        	$error = "please enter your email";
        }
        if(empty($name) || !preg_match("/[a-bA-Z]+[0-9]*/",$name)){
        	$error = "please enter your Fullname";
        }
        if(empty($error)){
        	$register = new extensionAgent;		//creating an object of the class
        	$register->RegisterAgent($name, $email, $LGA, $ward, $username, $password);
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Plateau Farmers</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script language="JavaScript" src="../js/jquery.js"></script>
    <script language="JavaScript" src="../js/functionslw.js"></script>
    <script type="text/javascript" src="../js/dropdown.js"></script>
    <script language="JavaScript" src="../js/functionfarm.js"></script>
    <script type="text/javascript" src="../js/farmcatdrop.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../style.css" type="text/css">
	<link href="../css/lightbox.css" rel="stylesheet">
</head>
<body>
<header class="header">
	<div class="container">
		<div class="row">
			<div class="col-md-1 "><img src="../images/logo.jpg" style="width:70px; height:60px; "></div>
			<div class="col-md-4 ">
				<div class="navbar-header">
					    <button type="button" class="navbar-toggle menu-button" data-toggle="collapse" data-target="#myNavbar">
					        <span class="glyphicon glyphicon-align-justify"></span>
					    </button>
      					<a class="navbar-brand logo" href="index.php"> Plateau State Farmers</a>
    			</div>
			</div>
			<div class="col-md-6">
				<nav class="collapse navbar-collapse" id="myNavbar" role="navigation">
					<ul class="nav navbar-nav navbar-right menu">
							<li><a href="../farmer/home.php" class="page-scroll">Home</a></li>
							<li><a href="../farmer/view.php" class="page-scroll">View Farmer</a></li>
							<li><a href="viewall.php" class="page-scroll">View Agents</a></li>
							<?php
								if (isset($_SESSION['admin'])) {
								?>
								<li><a href="../sms/sendnotification.php" class="page-scroll">send notification</a></li>
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
				<h2 class="text-center features-text" style="color">Register Extension Agent</h2>
			</div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
						<div class="col-md-6">
							<label>Fullname:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
							<input type="text" name="name" value="<?php echo !empty($_POST['name']) ? $_POST['name'] : ""; ?>" placeholder="Enter Fullname" class="form-control" />
						</div>
						<div class="col-md-6">
							<label>Email:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
							<input type="email" name="email" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ""; ?>" placeholder="Email" class="form-control" /><br />
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-6">
							<label>L.G.A:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<select name="LGA" id="LGA" class="form-control">
									<option>Select LGA</option>
								</select>
						</div>
						<div class="col-md-6">
							<label>Ward:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<select name="ward" id="ward" disabled="disabled" class="form-control"></select>
						</div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Username:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
							<input type="text" name="username" value="<?php echo !empty($_POST['username']) ? $_POST['username'] : ""; ?>" placeholder="username" class="form-control" /><br />
						</div>
						<div class="col-md-6">
							<div class="row" style="margin:0px 2px 0px 2px;">
								<label>Password:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
								<input type="password" name="password" value="" placeholder="Password" class="form-control" /><br /><br />
							</div>
						</div>
					</div>
					<br/><br/>
					<div class="row">
						<div class="col-md-6">
							<label>Confirm Password:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
							<input type="password" name="cpassword" value="" placeholder="Confirm Password" class="form-control" /><br /><br />
						</div>
						<div class="col-md-6">
						</div>
					</div>
					<br/><br/>
					
					<br/>
					<div class="row">
						<div class="col-md-4">
							<input type="submit" name="register" value="Register" class="btn btn-success form-control" />
						</div>
						<div class="col-md-4">
							<input type="reset" name="reset" value="reset" class="btn btn-danger form-control" />
						</div>
						<div class="col-md-4"></div>
					</div>
					
				</div>

				<div class="col-md-1"></div>
					
			</div>
			</form>		
		</div>
	</div>
</div>
<div class="container-fluid footer">
	<div class="row">
		<div class="col-md-12">
			<p><p>Copyright &copy; 2017 <a href="#madaxx">Madaki Fatsen</a></p>
		</div>
	</div>
</div>
</body>
</html>