<?php
	include '../class_lib/authenticate.php';
	
	if (isset($_SESSION['admin'])) {
	header("location:viewall.php");
	}
			
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Plateau Farmers</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<script language="JavaScript" src="../js/jquery.js"></script>
			<link href="../css/bootstrap.min.css" rel="stylesheet">
			<!-- <link rel="stylesheet" href="./style.css" type="text/css"> -->
			<link href="../css/lightbox.css" rel="stylesheet">
	</head>
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
	<body>
		<div class="row head">
			<div class="col-md-2 "><img src="../images/logo.jpg" style="width:70px; height:70px; "></div>
			<div class="col-md-6 ">				    
      			<a class="navbar-brand logo" href="index.php">Plateau State Farmers</a>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4"></div>
			<div class="col-md-4 logbody" style="">
			<?php
				if(isset($_POST['logAdmin']))		//checks if the submit button has been click
				{
					$username = $_POST['username'];		//initialize the username with username collected from the form input
					$password =$_POST['password'];		//initialize the password with password collected from the form input
					$login = new Authentications;		//creating an object of the class
				?>
					<h4 style="color:red;"><?php $login->AdminLogin($username, $password);		//use the object to call the Login function with arguments as username and password
			}
			?></h4>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
				
					<h1><b>Admin Login</b></h1>	

					<label>Username:</label><input type="text" name="username" placeholder="Enter Username" value="" class="form-control" /><br />
					<label>Password:</label><input type="password" name="password" placeholder="Enter Password" value="" class="form-control" />
					<br />
					<input type="submit" name="logAdmin" value="Login" class="form-control btn btn-primary" />
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="col-md-12">
			<center><?php include '../includes/footer.php';?></center>
		</div>
	</body>
</html>