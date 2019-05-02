<?php
	include 'security/connection.php';
	if(isset($_POST['res'])){

	$children_details_id = $_POST['children_details_id'];
				
	$sqls = "SELECT * FROM children_adopt_by_parent
		JOIN children ON children_adopt_by_parent.adopt_children_id = children.childrenId
		WHERE adopt_id = '$children_details_id'";
	$results = $con->query($sqls);																			
?>
<table class="table table-borderless">
<?php
	if ($results->num_rows > 0) {
		while($rowM = $results->fetch_assoc()) {
			$children_photo_details = $rowM['chPhoto'];
			$adopt_parent_id_details = $rowM['adopt_parent_id'];
			$adopt_children_id_details = $rowM['adopt_children_id'];
			$adopt_children_name_details = $rowM['adopt_children_name'];
			$adopt_children_bday_details = $rowM['adopt_children_bday'];
			$new_adopt_children_bday_details = date("F d, Y", strtotime($adopt_children_bday_details));
			?>
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
					<input type="text" name="parent_id_report" id="parent_id_report" value="<?php echo $adopt_parent_id_details; ?>">
					<input type="text" name="children_id_report" id="children_id_report" value="<?php echo $adopt_children_id_details; ?>">
				</td>
			</tr>
			<?php
		}
	}
	else {
		echo "
			<tr>
				<td colspan='2' style='text-align: center;'>
					<h1>No Children Details</h1>
				</td>
			</tr>
		";
	}
	
?>
</table>
<?php }
	else {
		echo "
			<h1>No Children Details</h1>
		";
	}
?>
<!-- <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#reportSend').on('click', function(){
		var file = $('#file');
		var file_length = file[0].files.length;
		var file_data = file.prop('files')[0];
		$('#result').css('display', '');
		if(file_length > 0){
			var form_data = new FormData();
			form_data.append('file', file_data);
			$.ajax({
				url: 'report_send.php',
				type: 'post',
				processData: false,
				contentType: false,
				data: form_data,
				success: function(data){
					if(data == "success"){
						$("#result").attr('class', 'alert alert-success');
						$("#result").html("File uploaded");
					}
				}
			});
		}else{
			$("#result").attr('class', 'alert alert-danger');
			$("#result").html("Please select a file first");
		}
		
	});
</script> -->