<?php include '../includes/header.php'; 
	if (!isset($_SESSION['extension_agent_id']) && !isset($_SESSION['admin'])) {
		header("location:../index.php");
	}
?> 

			<div class="col-md-7">
				<nav class="collapse navbar-collapse" id="myNavbar" role="navigation">
					<ul class="nav navbar-nav navbar-right menu">
							<li><a href="home.php" class="page-scroll active">Home</a></li>
							<li><a href="register.php">Registeration</a></li>
							<li><a href="view.php" class="page-scroll">View Farmer</a></li>
							<?php
								if (isset($_SESSION['admin'])) {
								?>
								<li><a href="../sms/sendnotification.php" class="page-scroll">Send notification</a></li>
								<li><a href="../ExtensionAgent/viewall.php" class="page-scroll">View Agent</a></li>
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

<div class="container-fluid main" id="page-top">
	<div class="row">
		<div class="col-md-12 backg">
			<div class="col-md-4 col-md-offset-4 inner col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
				<div class="text-box">
                	<p class="intro">Collecting</p>
                    <h2>Plateau State Farmers Records</h2>
                    <p>By <span><a href="#">Plateau state Government</a></span></p>
                    <p><a href="#" class="link-button">Making Farmers Grow</a></p>
				</div>
  			</div>
		</div>
		<div class="col-md-12 some-notes">
			<div class="title">
                <h2>Welcome To Plateau State Farmers Registration Portal</h2>
            </div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<a href="register.php"><button type="button" class="btn btn-default btneff">Add Farmer</button></a>
			</div>
			<div class="col-md-6">
				<a href="view.php"><button type="button" class="btn btn-default btneff">View Farmer's Record</button></a>
			</div>

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
