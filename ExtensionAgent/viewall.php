<?php
	include "../includes/db_connect.php";
	include '../class_lib/extensionAgent.php';
	if (!isset($_SESSION['extension_agent_id'])) {
		header("location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Plateau Farmers</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../js/dataTables.foundation.min.js"></script> <!-- works -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables_themeroller.css">
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
							<li><a href="../farmer/register.php" class="page-scroll">Register Farmer</a></li>
							<li><a href="registeragent.php" class="page-scroll">Add Agent</a></li>
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
				<h2 class="text-center features-text" style="color">All Extension Agents</h2>
			</div>
			<div>
	<table id="myTable" class="table" width="100%">
		<thead>
			<th>S/N</th>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>LGA</th>
			<th>WARD</th>
			<th>OPERATION</th>
		</thead>
		<tbody>
			<?php
				$sn=1;
				$register = new extensionAgent;		//creating an object of the class
	        	$query=$register->Viewall();
				while($row = mysql_fetch_array($query))
				{
			?>
					<tr>
						<td><?php echo $sn; ?></td>
				        <td><?php echo $row['name']; ?></td>
				        <td><?php echo $row['email']; ?></td>
						<?php
							$lga_id=$row['LGA_id'];
							$query2= mysql_query("SELECT l.lga_name FROM localgovtArea l, extension_agent e WHERE l.id = '$lga_id'") or die(mysql_error());
							$row2=mysql_fetch_array($query2) or die(mysql_error());
						?>

						<td><?php echo $row2['lga_name']?></td>
						<?php
							$ward_id=$row['ward_id'];
							$query2= mysql_query("SELECT w.ward_name FROM ward w, extension_agent e WHERE w.id = '$ward_id'") or die(mysql_error());
							$row2=mysql_fetch_array($query2) or die(mysql_error());
						?>

						<td><?php echo $row2['ward_name']?></td>
						<td><a href="../delete.php?agent=<?php echo $row['id']; ?>">[DELETE AGENT]</a> &nbsp;|&nbsp; <a href="editagent.php?agent=<?php echo $row['id']; ?>">[UPDATE AGENT]</a></td>
					</tr>
			<?php
				$sn++;
				}
			?>
		</tbody>
	</table>
</div>	
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
<script type="text/javascript">
		$('#myTable').DataTable();
		
	</script>
</html>
	