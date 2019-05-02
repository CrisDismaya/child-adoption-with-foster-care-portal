<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<?php include 'security/secure.php'; ?>
</head>

<body>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
		$credenUser = $_SESSION['credenUser'];

		$orphanage_query = "SELECT * FROM fosterhome 
			JOIN credentials ON fosterhome.fosterhomeId = credentials.credenAnyid
			WHERE fhUsername = '$credenUser' AND credenLevel = 2 ";
		$orphanage_display = $con->query($orphanage_query);
		if ($orphanage_display->num_rows > 0) {
			while($row_orpha = $orphanage_display->fetch_assoc()) {
				$orphanage_name = $row_orpha['fhName'];
			}
		}
	?>
<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<!-- Top Navigation: Right Menu -->
		<ul class="nav navbar-right navbar-top-links">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i> <?php echo $credenUser; ?> <b class="caret"></b>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li>
						<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
					</li>
				</ul>
			</li>
		</ul>

		<!-- Sidebar -->
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">

				<ul class="nav" id="side-menu">
					<li class="sidebar-search" style="text-align: center;">
						<h3><b><?php echo $orphanage_name; ?></b></h3>
					</li>
					<li>
						<a href="index.php" class="active" style="font-size: 13px;"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
					</li>
					<li>
						<a href="#" style="font-size: 13px;"><i class="fa fa-list-alt fa-fw"></i> Manage Foster Parent <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="fosterParent_add.php" style="font-size: 12px;"> Add Foster Parent </a>
							</li>
							<li>
								<a href="fosterParent_list.php" style="font-size: 12px;"> List of Foster Parent </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" style="font-size: 13px;"><i class="fa fa-list-alt fa-fw"></i> Manage Transaction <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="reviewReports_list.php" style="font-size: 12px;"> Review Reports </a>
							</li>
							<li>
								<a href="sendReport.php" style="font-size: 12px;"> Send Report to Dswd </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" style="font-size: 13px;"><i class="fa fa-list-alt fa-fw"></i> Manage Message <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="message_create.php" style="font-size: 12px;"> Create Messasge </a>
							</li>
							<li>
								<a href="message_view.php" style="font-size: 12px;"> View Message </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" style="font-size: 13px;"><i class="fa fa-list-alt fa-fw"></i> Manage News <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="news_add.php" style="font-size: 12px;"> Add News </a>
							</li>
							<li>
								<a href="news_list.php" style="font-size: 12px;"> List of News </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" style="font-size: 13px;"><i class="fa fa-list-alt fa-fw"></i> Manage Facility <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="facility_all.php" style="font-size: 12px;"> Add and View Facility </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" style="font-size: 13px;"><i class="fa fa-list-alt fa-fw"></i> Manage Children <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="children_add.php" style="font-size: 12px;"> Add Children </a>
							</li>
							<li>
								<a href="children_list.php" style="font-size: 12px;"> List of Children </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" style="font-size: 13px;"><i class="fa fa-list-alt fa-fw"></i> Analytics <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="analytics_civil_status.php" style="font-size: 12px;"> Civil Status </a>
							</li>
							<li>
								<a href="analytics_gender_foster_child_status.php" style="font-size: 12px;"> Gender of Foster Child </a>
							</li>
							<li>
								<a href="analytics_adopt_status.php" style="font-size: 12px;"> Adoption Status </a>
							</li>
							<li>
								<a href="analytics_foster_child.php" style="font-size: 12px;"> Foster Child </a>
							</li>
							<li>
								<a href="analytics_foster_parent.php" style="font-size: 12px;"> Foster Parent </a>
							</li>
						</ul>
					</li>
				</ul>

			</div>
		</div>
	</nav>

</div>
</body>
</html>
