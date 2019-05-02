<!DOCTYPE html>
<html>
<head>
	<?php include'includes/head.php'; ?>
	<?php include'security/secure.php'; ?>
	<link rel="stylesheet" type="text/css" href="css/chat.css">
</head>
	<?php include'report_send.php'; ?>
	
	<style type="text/css">
		.magis { display: none; }
	</style>
<body class="homepage">
	<?php include'_header.php'; ?>
	<?php
		$fosterID= "";
		include'security/connection.php';
		$sessionId = $_SESSION['credenIds'];
		$sessionName = $_SESSION['credenUsers'];

		$getFosterparent = "SELECT * FROM credentials 
			JOIN fosterparent ON credentials.credenAnyid = fosterparent.fosterparentId
			JOIN fosterhome ON fosterparent.fpFosterparentId = fosterhome.fosterhomeId
			WHERE credenId = '$sessionId' AND credenLevel = 3";
		$displayData = $con->query($getFosterparent);
		if ($displayData->num_rows > 0) {
			while($rowDetails = $displayData->fetch_assoc()) {
				$fosterID = $rowDetails['fosterparentId'];
				$fpPtoho = $rowDetails['fpPtoho'];
				$fpName = $rowDetails['fpFname']." ".$rowDetails['fpMname']." ".$rowDetails['fpLname'];
				$fpContact = $rowDetails['fpContact'];
				$fpAddress = $rowDetails['fpAddress'];

				$fpStatusAdopt = "";
				if ($rowDetails['fpStatusAdopt'] == 1) {
					$fpStatusAdopt = "Temporary";
				} else {
					$fpStatusAdopt = "Permanent";
				}

				$fpCreadenId = $rowDetails['fhName'];

			}
		}
	?>
	<section class="pricing-page">
		<div class="container">
			<div class="center" style="text-align: left; padding-bottom: 0;	">  
				<h2>My Account</h2>
			</div>

			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
								<center>
									<img class="img-responsive" src="account/_fostercare/<?php echo $fpPtoho; ?>" width="150" style="margin-bottom: 5px; margin-top: 5px;"/>
								</center>
							</div>
							<div class="col-lg-10 col-md-4 col-sm-4 col-xs-6" style="padding: 13px 15px;">
								<label>Name : <i><?php echo $fpName; ?></i></label><br>
								<label>Contact No. : <i><?php echo $fpContact; ?></i></label><br>
								<label>Address : <i><?php echo $fpAddress; ?></i></label><br>
								<label>Status : <i><?php echo $fpStatusAdopt; ?></i></label><br>
								<label>Foster Home : <i><?php echo $fpCreadenId; ?></i></label><br>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12">
				<br>
				<ul class="portfolio-filter">
					<li>
						<button class="btn btn-primary" id="tab1" style="background-color: #428bca;">
							SEND REPORT
						</button>
					</li>
					<li>
						<button class="btn btn-primary" id="tab2" style="background-color: #428bca;">
							MESSAGE
						</button>
					</li>
				</ul>

				<div class="col-lg-12">
					<div class="row">

						<div class="col-lg-12" style="padding: 0; margin: 0;">
							<div id="tab1Container">

								<div class="col-lg-4">
									<div class="panel panel-primary" style="border: 2px solid #428bca;">
										<div class="panel-heading text-center">
											<b>List of Children</b>
											<input type="hidden" name="children_list_id" id="children_list_id" value="<?php echo $fosterID; ?>">
										</div>
										<div class="panel-body"  style="background-color: #fff; height: 430px; overflow-y: auto;">
											<!-- <div class="col-lg-12">
												<div id="children_list_table"></div>
											</div> -->
											<table class="table table-bordered">
												<thead style="background-color: #DCDCDC;">
													<th width="70%">Children Name</th>
													<th width="30%">Action</th>
												</thead>
												<tbody>
													<?php
													include 'security/connection.php';
													$sql = "SELECT * FROM children_adopt_by_parent WHERE adopt_parent_id = '$fosterID' AND NOT adopt_children_status = 4";
													$result = $con->query($sql);
														if ($result->num_rows > 0) {
															// output data of each row
															while($row = $result->fetch_assoc()) {
																$adopt_id = $row['adopt_id'];
																$adopt_parent_id = $row['adopt_parent_id'];
																$adopt_children_id = $row['adopt_children_id'];
																$adopt_children_name = $row['adopt_children_name'];
																$adopt_children_bday = $row['adopt_children_bday'];
																?>
																<tr>
																	<td><label><?php echo $adopt_children_name; ?></label></td>
																	<td id="child_id<?php echo $adopt_id; ?>" class="hide"><?php echo $adopt_id; ?></td>
																	<td>
																		<center>
																			<!-- <button type='button' id='<?php echo $adopt_id; ?>' class='btn btn-warning' onclick='pass(this.id)'>
																				<span class='fa fa-arrow-right'></span>
																			</button> -->
																			<a href="report.php?children_Id=<?php echo $adopt_id; ?>" class='btn btn-warning'>
																				<span class='fa fa-arrow-right'></span>
																			</a>
																		</center>
																	</td>
																</tr>
																<?php
															}
														}
														else {
															echo "
																<tr>
																	<td colspan='2' style='text-align: center;'>
																	<h3>No Data</h3>
																	</td>
																</tr>
															";
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<div class="col-lg-8">
									<div class="panel panel-primary" style="border: 2px solid #428bca;">
										<div class="panel-heading text-center">
											<b>Children Details</b>
											<!-- <input type="hidden" name="children_details_id" id="children_details_id"> -->
										</div>
										<div class="panel-body" style="background-color: #fff; height: 430px; overflow-y: auto;">
											<!-- <div class="col-lg-12">
												<div id="children_details_table"></div>
											</div> -->
											<?php
												include 'security/connection.php';

												// if(isset($_POST['res'])){
												// $children_details_id = $_POST['children_details_id'];

												$children_details_id = $_GET['children_Id'];
												$sqls = "SELECT * FROM children_adopt_by_parent
													JOIN children ON children_adopt_by_parent.adopt_children_id = children.childrenId
													WHERE adopt_id = '$children_details_id'";
												$results = $con->query($sqls);			
												if ($results->num_rows > 0) {
													while($rowM = $results->fetch_assoc()) {
														$children_photo_details = $rowM['chPhoto'];
														$adopt_parent_id_details = $rowM['adopt_parent_id'];
														$adopt_children_id_details = $rowM['adopt_children_id'];
														$adopt_children_name_details = $rowM['adopt_children_name'];
														$adopt_children_bday_details = $rowM['adopt_children_bday'];
														$new_adopt_children_bday_details = date("F d, Y", strtotime($adopt_children_bday_details));		
													}
												}														
											?>
											<form method="post" action="report.php" enctype="multipart/form-data">
											<table class="table table-borderless">
												<tr>
													<td width="10%">
														<img src="account/_fostercare/<?php echo $children_photo_details; ?>" width='100' height='100'>
													</td>
													<td>
														<label>Name : <i><?php echo $adopt_children_name_details; ?></i></label><br>
														<label>Birthday : <i><?php echo $new_adopt_children_bday_details; ?></i></label><br>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<input type="hidden" name="parent_id_report" id="parent_id_report" value="<?php echo $adopt_parent_id_details; ?>">
														<input type="hidden" name="children_id_report" id="children_id_report" value="<?php echo $adopt_children_id_details; ?>">
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<input type="file" name="report_file" id="report_file" class="form-control" accept="image/*|video/*" required>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<textarea name="report_description" id="report_description" rows="5" class="form-control" placeholder="Description" 
															style="resize: none;" required></textarea>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<button type="submit" name="reportSend" id="reportSend" class="btn btn-md btn-primary pull-right" style="background-color: #428bca;">
															Send Report
														</button>
														<!-- <input type="button" name="reportSend" id="reportSend" value="Send Report" class="btn btn-md btn-primary pull-right" style="background-color: #428bca;" />
 -->													</td>
												</tr>
											</table>
											</form>
										</div>
									</div>
								</div>

							</div>
						</div>
						

						<div id="tab2Container" class="magis">
				  		<form  method="POST" name="form" action="">
								<div class="col-lg-12 message_section" style="">
									<div class="row">
										<div class="new_message_head" style="background-color: #428bca;">
											<div class="pull-left">
												<button disabled style="color: #000;">
													<i class="fa fa-comments-o" aria-hidden="true"></i> Chat
												</button>
											</div>
										</div>

										<div class="chat_area scroll-class">
											<ul class="list-unstyled" id="comment">
												
											</ul>
										</div>

										<div class="message_write">
											<input type="hidden" name="creden_user_id" id="creden_user_id" value="<?php echo $sessionId; ?>">
											<input type="hidden" name="foster_user_id" id="foster_user_id" value="<?php echo $fosterID; ?>">
											<textarea id="msg_user_content" class="form-control" placeholder="type a message" style="resize: none;"></textarea>
											<div class="clearfix"></div>
											<div class="chat_bottom">
												<!-- <a href="#" class="pull-right btn btn-success">Send</a> -->
												<input type="button" value="submit" class="pull-right btn btn-success" name="sub" id="sub"/>
											</div>
										</div>
									</div>

									<div id="result" ></div>
									<div id="info">
										<ul id="comment"></ul>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<?php include'_footer.php'; ?>
	<?php include'includes/script.php'; ?>
	<script type="text/javascript">
		// $(function(){
		// 	$.get("report_childrent_list_table.php?children_list_id=" +$("#children_list_id").val(),function(data){
		// 		$("#children_list_table").html(data);
		// 	});	
		// });

		// function pass(id1){
		// 	document.getElementById("children_details_id").value = document.getElementById("child_id"+id1).innerHTML;
		// 	$.ajax({
		// 		type:'post',
		// 		async: false,
		// 		url:'report_childrent_details_table.php',
		// 		data: {
		// 			res:1,
		// 			children_details_id: id1,
		// 		},
		// 		success:function(data){
		// 			$("#children_details_table").html(data);
		// 		}
		// 	});
		// }



		$(document).ready(function(){
			$('#tab1').click(function(){
				$('#tab1Container').show();
				$('#tab2Container').hide();
			});

			$('#tab2').click(function(){
				$('#tab1Container').hide();
				$('#tab2Container').show();
			});
		});
	</script>

	<script type="text/javascript">
		var objDiv = $(".scroll-class");
		var h = objDiv.get(0).scrollHeight;
		objDiv.animate({scrollTop: h});
	</script>

	<script type = "text/javascript" >
		$(document).ready(function(){
			$creden_user_id = $("#creden_user_id").val();
			$foster_user_id = $("#foster_user_id").val();
			$msg_user_content = $("#msg_user_content").val();
			showComment();
			function showComment(){
				$.ajax({
					type:'post',
					async: false,
					url:'action.php',
					data: {
						res:1,
						creden_id: $creden_user_id,
						foster_id: $foster_user_id,
						msg_content: $msg_user_content,
					},
					success:function(data){
						$("#comment").html(data);
					}
				});
			}

			$('#sub').on('click', function(){
				$creden_user_id = $("#creden_user_id").val();
				$foster_user_id = $("#foster_user_id").val();
				$msg_user_content = $("#msg_user_content").val();
				if ($('#msg_user_content').val() == "") {
					alert('Please write message first');
				} else {
					$.ajax({
						type: 'POST',
						url:'action.php',
						async: false,
						data: {
							creden_user: $creden_user_id,
							foster_user: $foster_user_id,
							message_user: $msg_user_content,
						},
						success: function(){
							showComment();
							$('#msg_user_content').val("");
						}
					});
				}
			});


		});
	</script>
</body>
</html>