<?php
	if (!isset($_SESSION['extension_agent_id']) && !isset($_SESSION['admin'])) {
		// header("location:../index.php");
	}
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
				<h2 class="text-center features-text" style="color">Search For Farmer</h2>
			</div>
			<div class="col-md-12">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div style="color:red; font-size:20px;">
						<?php 
						 if(isset($_GET['error']))
						 {
						 	echo "Farmer record not found";
						 }
						?>
					</div>
					<form action="display.php" method="GET">
						<!-- <label style="font-size:20px;">Search:</label> -->
						<input type="text" name="barcode" value="" placeholder="Search Farmer..." class="form-control" autofocus>
					</form>
					
				</div>
				<div class="col-md-4"></div>
			</div>
			<form>
			
		</div>
	</div>
</div>

<div class="container-fluid work" id="work">
	<div class="container">
		<div class="row" id="starts">
			<div class="col-md-12 col-sm-12 col-xs-12 work-list">
				<h2 class="text-center portfolio-text">Gallery</h2>
				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="#" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="../images/bg2.jpg"/>
                		</div>
                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>
                		<h3>Plateau Amazing Beauty</h3>
                	</a>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="#" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="../images/farm7.jpg"/>
                		</div>
                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>
                		<h3>Plateau potatos Farming</h3>
                	</a>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="#" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="../images/farm3.jpg"/>
                		</div>
                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>
                		<h3>Greenish Plateau</h3>
                	</a>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="#" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="../images/farm4.jpg"/>
                		</div>
                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>
                		<h3>Plateau Poultry Farming</h3>
                	</a>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="#" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="../images/farm5.jpg"/>
                		</div>
                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>
                		<h3>Plateau Beautiful Fish Farming</h3>
                	</a>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 work-space">
					<a href="#" data-lightbox="image-1">
                		<div class="featured-img">
                			<img src="../images/farm6.jpg"/>
                		</div>
                		<div class="image-hover">
                			<i class="glyphicon glyphicon-eye-open"></i>
						 </div>
                		<h3>Plateau Cattle rearing</h3>
                	</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include '../includes/footer.php'; ?>