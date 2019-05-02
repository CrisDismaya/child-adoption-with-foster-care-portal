<?php require_once '../../security/pdo.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
</head>
	<?php include 'sql/fosterParent.php'; ?>
<body>
	<?php include 'navigation.php'; ?>
	<?php 
		include '../../security/connection.php'; 
		$credenId = $_SESSION['credenId'];
		$getId = "SELECT * FROM credentials 
			JOIN fosterhome ON credentials.credenAnyid = fosterhome.fosterhomeId
			WHERE credenId = '$credenId'";
		$disId = $con->query($getId);
		if ($disId->num_rows > 0) {
			while($rowId = $disId->fetch_assoc()) {
				$fosterhomeId = $rowId['fosterhomeId'];
			}
		}
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"> Foster Parent List </h1>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Table
				</div>

				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<th width="20%">Photo</th>
								<th width="20%">Name</th>
								<th width="13%">Contact <NOFRAMES></NOFRAMES></th>
								<th width="25%">Address</th>
								<th width="14%">Account Status</th>
								<th width="25%">Action</th>
							</thead>

							<tbody>
							<?php
								include '../../security/connection.php';
								$getFosterParent = "SELECT * FROM fosterparent 
									JOIN children ON fosterparent.fpChild = children.childrenId
									WHERE fpCreadenId = '$credenId'";
								$disFosterParent = $con->query($getFosterParent);   
								if ($disFosterParent->num_rows > 0) {
									while($row = $disFosterParent->fetch_assoc()) {
										$fpPtoho = $row['fpPtoho'];
										$fpName = $row['fpFname']." ".$row['fpMname']." ".$row['fpLname'];
										$fpContact = $row['fpContact'];
										$fpAddress = $row['fpAddress'];
										$fpAccountStatus = "";
										if ($row['fpAccountStatus'] == 0) {
											$fpAccountStatus = "<span style='color: #12EF2C; font-size: 15px;'><b>Active</b></span>";
										} else{
											$fpAccountStatus = "<span style='color: #EC0E28; font-size: 15px;'><b>Inactive</b></span>";
										}
									?>
									<tr>
										<td>
											<center>
												<img src="<?php echo $fpPtoho; ?>" width=120 height=100>
											</center>
										</td>
										<td><?php echo $fpName; ?></td>
										<td><?php echo $fpContact; ?></td>
										<td><?php echo $fpAddress; ?></td>
										<td><center><?php echo $fpAccountStatus; ?></center></td>
										<td>
											<a href="#myEdit<?php echo $row['fosterparentId']; ?>" class="btn btn-warning" data-toggle="modal">
												<span class='fa fa-edit'></span> Edit
											</a>
											<?php include('fosterParent_edit.php'); ?>	
										</td>
									</tr>
									<?php
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>

		</div>
	</div>
	
	<?php include '../includes/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dataTables-example').DataTable({
				responsive: true
			});
		});
	</script>
	<script>
		// $(".delete").on('click', function() {
		// 	$('.case:checkbox:checked').parents("tr").remove();
		// });

		$(".remove").on("click", function () {
				$('.case:checkbox:checked').parents("tr").remove();
			});
        
        function addField(parentId) {
            var i=2;
            var rowTable = $('#myEdit'+ parentId +' .add_row_table');
            var addFieldButton = $('#myEdit'+ parentId +' .addmore');
            var data="<tr>";
            data +="<td colspan='2' class='td-child-id'><select id='Children_id"+i+"' name='Children_id_add' class='form-control new-child-select' style='width: 100%;' >";
            data +="<option hidden value='0'>Select Children</option>";
            data +="<?php include '../../security/connection.php'; ?>";
            data +="<?php $getChildren = "SELECT * FROM children JOIN childstatus ON children.chStatus = childstatus.childstatusId WHERE chStatus = 1 AND chChildAdopt = 0 AND chFosterhomeId = '$fosterhomeId'"; $disChildren = $con->query($getChildren); ?> ";
            data +="<?php if ($disChildren->num_rows > 0) { while($rowC = $disChildren->fetch_assoc()) { ?> ";
            data +="<?php $childrenId = $rowC['childrenId']; $children_name = $rowC['chFname']." ".$rowC['chMname']." ".$rowC['chLname']; ?> ";
            data +="<option value='<?php echo $childrenId; ?>'> <?php echo $children_name; ?> </option>";
            data +="<?php } } ?> ";
            data +="</select></td>";


            data +="<td class='td-child-status'><select name='children_status_id_add' id='children_status_id"+i+"' class='form-control new-child-status-select' style='width: 100%;'  required>";
            data +="<option hidden value='0'> Select Status Adopt </option>";
            data +="<option value='2'> Temporary </option>";
            data +="<option value='3'> Permanent </option>";
            data +="</select></td>";
            data +="<td>";
            data +="<button type='button' class='btn btn-primary btnAddChild' data-parentid='"+ parentId +"' data-childid='0' data-childstatus='0' disabled><span class='fa fa-plus'></span> Add</button>";
            data +="</td></tr>";

            rowTable.append(data);
            i++;

            // setTimeout(function() {
            //     $('#fosterParent .children_update_table [data-parentid="0"]').attr('data-parentid', $('#efosterparentId').val());
            // }, 500);

            addFieldButton.attr('disabled', 'disabled');
        }

        $(document).on('change','select.new-child-select',function(){
            var id = $(this).val();
            $(this).parent().parent().find('td:last-child button').attr('data-childid', id);

            var status = $(this).parent().parent().find('td.td-child-status select').val();

            if (id != 0 && status != 0) {
                $(this).parent().parent().find('td:last-child button').removeAttr('disabled'); 
            } else {
                $(this).parent().parent().find('td:last-child button').attr('disabled', 'disabled'); 
            }
        });

        $(document).on('change', 'select.new-child-status-select', function() {
            var status = $(this).val();
            $(this).parent().parent().find('td:last-child button').attr('data-childstatus', status);

            var childid = $(this).parent().parent().find('td.td-child-id select').val();

            if (status != 0 && childid != 0) {
                $(this).parent().parent().find('td:last-child button').removeAttr('disabled'); 
            } else {
                $(this).parent().parent().find('td:last-child button').attr('disabled', 'disabled');
            }
        });

        $(document).on('change', 'select.fpStatusAdopt', function() {
            var status = $(this).val();
            $(this).parent().parent().find('td:last-child button').attr('data-status', status);
        });
        
            
		function select_all() {
			$('input[class=case]:checkbox').each(function(){ 
				if($('input[class=check_all]:checkbox:checked').length == 0){ 
					$(this).prop("checked", false); 
				} else {
					$(this).prop("checked", true); 
				} 
			});
		}

        $(document).on('click', '.btnAddChild', function() {
            var parentId = $(this).data('parentid');
            var childId = $(this).data('childid');
            var childStatus = $(this).data('childstatus');

            $(this).attr('data-id', childId);
            $(this).attr('data-status', childStatus);
            $(this).removeClass('btnAddChild');
            $(this).addClass('btnUpdateChild');
            $(this).text('Update');
            $(this).parent().parent().find('td.td-child-id select').attr('disabled', 'disabled');

            if (childStatus == 3) {
                $(this).parent().parent().find('td.td-child-status select').attr('disabled', 'disabled');
                $(this).remove();
            }

            $.ajax({
                type: 'POST',
                url: './sql/children.php',
                data: {
                    'ajax_add': true,
                    'parentId': parentId,
                    'childId': childId,
                    'childStatus': childStatus
                },
                success: function(response) {
                    console.log('res', response);

                    $('.addmore').removeAttr('disabled');
                },
                error: function(xhr, thrownError) {
                    console.log('error', xhr.status, thrownError);
                }
            });
        });

        $(document).on('click', '.btnUpdateChild', function() {
            var childId = $(this).data('id');
            var childStatus = $(this).data('status');
            
            $(this).parent().parent().find('td.td-update-child select').attr('disabled', 'disabled');
            $(this).remove();

            $.ajax({
                type: 'POST',
                url: './sql/children.php',
                data: {
                    'ajax_update': true,
                    'id': childId,
                    'status': childStatus
                },
                success: function(response) {
                    console.log('res', response);
                },
                error: function(xhr, thrownError) {
                    console.log('error', xhr.status, thrownError);
                }
            });
        });
	</script>
	<!-- <script type="text/javascript">
		$(function () {
			$("#btnAdd").bind("click", function () {
				var div = $("<div />");
				div.html(GetDynamicTextBox(""));
				$("#TextBoxContainer").append(div);
			});
			$("#btnGet").bind("click", function () {
				var values = "";
				$("select[name=Children_id[]").each(function () {
					values += $(this).val() + "\n";
				});
				alert(values);
			});
			$("body").on("click", ".remove", function () {
				$(this).closest("div").remove();
			});
		});
		function GetDynamicTextBox(value) {
			return '<select name="Children_id[]" class="form-control" style="width: 90%; margin-bottom: 5px;">' +
			'<option hidden> Select Children </option>' +
			'<?php include "../../security/connection.php"; $getChildren = "SELECT * FROM children WHERE chStatus = 1 AND chChildAdopt = 0 AND chFosterhomeId = '$fosterhomeId'"; $disChildren = $con->query($getChildren); 
			if ($disChildren->num_rows > 0) { while($rowC = $disChildren->fetch_assoc()) { $childrenId = $rowC['childrenId']; $children_name = $rowC['chFname']." ".$rowC['chMname']." ".$rowC['chLname'];?> <option value="<?php echo $childrenId; ?>"><?php echo $children_name; ?></option> <?php }}?>' +
			'</select>' +
			'<button type="button" id="btnAdd" class="btn btn-xs btn-danger remove" style="margin-left: 3px;"><span class="fa fa-minus"></span></button>'
		}
	</script> -->
</body>
</html>