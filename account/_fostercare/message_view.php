<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>

<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Message View </h1>
				</div>
			</div>
			
			<div class="col-lg-5">
				<div class="panel panel-default">
					<div class="panel-heading" > <!-- style="height: 85px;" -->
						<p>LIST OF PARENT</p>
						<input class="form-control" autocomplete="off" type="hidden" name="salary_name2" id="salary_name2" placeholder="Search..." value="<?php echo $credenId; ?>">
					</div>

					<div class="panel-body" id="result_table" style="padding: 0; height: 420px; overflow: auto;"></div>
				</div>
			</div>

			<div class="col-lg-7">
				<div class="chat-panel panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-comments fa-fw"></i>
						Chat
						<form method="post">
							<input type="hidden" name="parentIds" id="parentIds">
						</form>
					</div>

					<div class="panel-body scroll-class" id="results_table">
						
					</div>

					<div class="panel-footer">
						<form  method="POST" action="" enctype="multipart/form-data">

							<div class="input-group">
								<input type="hidden" name="credenIds" id="credenId" value="<?php echo $credenId; ?>"/>
								<input type="hidden" name="messageId" id="messageId"/>
								<input name="msgContents" id="msgContents" type="text" class="form-control input-sm" placeholder="Type your message here..." autocomplete="off" />
								<span class="input-group-btn">
									<input type="button" value="Send" class="btn btn-warning btn-sm" id="chat"/>
								</span>
							</div>
						</form>
					</div>

				</div>
			</div>
		
		</div>
	</div>

	<?php include '../includes/script.php'; ?>
	 <script type="text/javascript">
	     var objDiv = $(".scroll-class");
    	 var h = objDiv.get(0).scrollHeight;
    	 objDiv.animate({scrollTop: h});
    </script>
    
    <script type="text/javascript">
		 	$(function(){
				$.get("tables/newsample.php?salary_name2=" +$("#salary_name2").val(),function(data){
					$("#result_table").html(data);
				});	
			});

			function pass(id1){
				document.getElementById("parentIds").value = document.getElementById("p2"+id1).innerHTML;
				document.getElementById("messageId").value = document.getElementById("p2"+id1).innerHTML;
				$.ajax({
					type:'post',
					async: false,
					url:'message.php',
					data: {
						res:1,
						parent: id1,
					},
					success:function(data){
						$("#results_table").html(data);
					}
				});
			}

			$(document).ready(function(){
				$creden_Id = $("#credenId").val();
				$message_Id = $("#messageId").val();
				$msg_Contents = $("#msgContents").val();
				showComment();
				function showComment(){
					$.ajax({
						type:'post',
						async: false,
						url:'action_retrieve.php',
						data: {
							res:1,
							creden_Id: $creden_Id,
							message_Id: $message_Id,
							msg_Contents: $msg_Contents,
						},
						success:function(data){
							// $("#comment").html(data);
						}
					});
				}

				$('#chat').on('click', function(){
					$creden_Id = $("#credenId").val();
					$message_Id = $("#messageId").val();
					$msg_Contents = $("#msgContents").val();
					if ($('#msgContents').val() == "") {
						alert('Please write message first');
					} else {
						$.ajax({
							type: 'POST',
							url:'action_save_message.php',
							async: false,
							data: {
								creden_Id: $creden_Id,
								message_Id: $message_Id,
								msg_Contents: $msg_Contents,
							},
							success: function(){
								showComment();
								$('#msgContents').val("");
							}
						});
					}
				});
			});
    </script>
</body>
</html>