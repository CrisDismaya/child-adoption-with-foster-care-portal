<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/reviewMessage.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	
	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Foster Parent Report </h1>
				</div>
			</div>
			<?php
				include'../../security/connection.php';
				$fosterparent_id = $_GET['fosterparent_id'];
				$children_id = $_GET['children_id'];
				$parent_report_id = $_GET['parent_report_id'];

				$getData = "SELECT * FROM fosterparent 
					JOIN children ON fosterparent.fpChild = children.childrenId
					JOIN children_adopt_by_parent ON fosterparent.fosterparentId = children_adopt_by_parent.adopt_parent_id
					JOIN parent_report ON fosterparent.fosterparentId = parent_report.prFosterparentId
					WHERE fosterparentId = '$fosterparent_id' AND adopt_children_id = '$children_id' AND parent_report_id = '$parent_report_id'";
				$disData = $con->query($getData);
				if ($disData->num_rows > 0) {
					while($rowData = $disData->fetch_assoc()) {
						$foster_parent_id = $rowData['fosterparentId'];
						$foster_parent_photo = $rowData['fpPtoho'];
						$foster_parent_name = $rowData['fpFname']." ".$rowData['fpMname']." ".$rowData['fpLname'];
						$foster_parent_contact = $rowData['fpContact'];
						$foster_parent_address = $rowData['fpAddress'];

						$foster_parent_status = "";
						if ($rowData['fpStatusAdopt'] == 1) {
							$foster_parent_status = "Temporary";
						} else {
							$foster_parent_status = "Permanent";
						}

						$children_photo = "";
						$getPicChildren = "SELECT chPhoto FROM children WHERE childrenId = '$children_id'";
						$disPicChildren = $con->query($getPicChildren);
						if ($disPicChildren->num_rows > 0) {
							while($rowpic = $disPicChildren->fetch_assoc()) {
								$children_photo = $rowpic['chPhoto'];
							}
						}

						
						$children_name = $rowData['adopt_children_name'];
						// $children_name = $rowData['chFname']." ".$rowData['chMname']." ".$rowData['chLname'];

						$bday = $rowData['adopt_children_bday'];
						$birthday = date("F d, Y", strtotime($bday));

						$parent_report_id = $rowData['parent_report_id'];
						$parent_report_photoname = $rowData['prPhotoname'];
						$parent_report_date = $rowData['prCreated'];
						$new_parent_report_date = date("M d, Y", strtotime($parent_report_date));
						$parent_report_description = $rowData['prDescription'];
					}
				}
			?>
			<div class="panel panel-default">
				<div class="panel-body">

					<a href="reviewReports_list.php" class="btn btn-primary" style="margin-bottom: 10px;">
						<span class="fa fa-arrow-left"></span> Back
					</a>
					
					<table class="table table-bordered">
						<tr><td colspan="2"><b>Foster Parent Information</b></td></tr>
						<tr>
							<td width="15%">
								<center><img src="<?php echo $foster_parent_photo; ?>" width=120 height=120></center>
							</td>
							<td>
								<span><b>Name : </b><i><?php echo $foster_parent_name; ?></i></span><br>
								<span><b>Contact No. : </b><i><?php echo $foster_parent_contact; ?></i></span><br>
								<span><b>Address : </b><i><?php echo $foster_parent_address; ?></i></span><br>
								<span><b>Status : </b><i><?php echo $foster_parent_status; ?></i></span><br>
								<a href="#myMessage<?php echo $foster_parent_id; ?>" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top: 10px;">
									Message
								</a>
								<?php include('reviewReports_message.php'); ?>
							</td>
						</tr>
						<tr><td colspan="2"><b>Children Information</b></td></tr>
						<tr>
							<td width="15%">
								<center><img src="<?php echo $children_photo; ?>" width=120 height=120></center>
							</td>
							<td>
								<br><br><br><br>
								<span><b>Name : </b><i><?php echo $children_name; ?></i></span><br>
								<span><b>Birthday : </b><i><?php echo $birthday; ?></i></span><br>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="table table-borderless">
									<tr>
										<td width="35%">
											<center>
											<?php
												include'../../security/connection.php';
												$getImage = mysqli_query($con, "SELECT * FROM parent_report WHERE parent_report_id = '$parent_report_id'");
												$image_display = mysqli_fetch_array($getImage);
												$file = $image_display['prPhotoname'];
												$ext = pathinfo($file, PATHINFO_EXTENSION);
												if ($ext == 'mp4' || $ext == 'mov' || $ext == 'vob' || $ext == 'mpeg' || $ext == '3gp' || $ext == 'avi' || $ext == 'wmv' || $ext == 'mov' || $ext == 'amv' || $ext == 'svi' || $ext == 'flv' || $ext == 'mkv' || $ext == 'webm' || $ext == 'gif' || $ext == 'asf') {
													echo '<video width="500" autoplay controls style="margin-top: 10px;">';
														echo'<source src="image/ParentReport/'.$image_display['prPhotoname'].'" type="video/mp4">';
													echo "</video>";
												}else{
													echo'<img src="image/ParentReport/'.$image_display['prPhotoname'].'"  width=300>';
												}
											?>
											</center>
											<?php include('reviewReports_popup.php'); ?>
										</td>
										<td>
											<div class="panel panel-default">
												<div class="panel-body">
													<div class="container-fluid">
														<span><b>Date : </b><i><?php echo $new_parent_report_date; ?></i></span><br>
														<span><b>Description </b><br><i><?php echo $parent_report_description; ?></i></span><br>
													</div>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

				</div>
			</div>

		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
	<style>
		.table-borderless > tbody > tr > td,
		.table-borderless > tbody > tr > th,
		.table-borderless > tfoot > tr > td,
		.table-borderless > tfoot > tr > th,
		.table-borderless > thead > tr > td,
		.table-borderless > thead > tr > th {
			border: none;
		}
	</style>
</body>
</html>