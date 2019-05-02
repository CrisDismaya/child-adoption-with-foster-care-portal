<?php
	include'security/connection.php';

	if (isset($_POST['reportSend'])) {
		
		$parent_id = $_POST['parent_id_report'];
		$children_id = $_POST['children_id_report'];

		$file_path = "";
		if(!empty($_FILES['report_file']['tmp_name'])
			&& file_exists($_FILES['report_file']['tmp_name'])) {
			$file = addslashes(file_get_contents($_FILES['report_file']['tmp_name']));
			$file_name = addslashes($_FILES['report_file']['name']);
			move_uploaded_file($_FILES["report_file"]["tmp_name"], "account/_fostercare/image/ParentReport/" . $_FILES["report_file"]["name"]);
			$file_path = "account/_fostercare/image/ParentReport/" . $_FILES["report_file"]["name"];
		}

		$description = $_POST['report_description'];

		$save_query = "INSERT INTO parent_report (prFosterparentId, prChildrenId, prPath, prPhotoname, prDescription)
				VALUES ('$parent_id', '$children_id', '$file_path', '$file_name', '$description')";

		if (!mysqli_query($con, $save_query)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('File has been uploaded');";
			echo "</script>";
	}


	// try{
	// 	$file_name = $_FILES['file']['name'];
	// 	$file_temp = $_FILES['file']['tmp_name'];
	// 	$path = "upload/".$file_name;
	// 	$exp = explode(".", $_FILES['file']['name']);
	// 	$name = $exp[0];
		
	// 	if(move_uploaded_file($file_temp, $path)){
	// 		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 		$sql = "INSERT INTO parent_report (prFosterparentId, prChildrenId, 	prPath, prPhotoname, prDescription)
	//  			VALUES ('0', '0', '$name', '$path', '0')";
	// 		mysql_query($con, $sql);
	// 	}
		
	// }catch(PDOException $e){
	// 	echo $e->getMessage();
	// }	

	// try{
	// 	$parent_id = $_POST['parent_id'];
	// 	$children_id = $_POST['children_id'];
	// 	$description = $_POST['description'];

	// 	$file_name = $_FILES['file']['name'];
	// 	$file_temp = $_FILES['file']['tmp_name'];
	// 	$path = "upload/".$file_name;
	// 	$exp = explode(".", $_FILES['file']['name']);
	// 	$name = $exp[0];
		
	// 	if(move_uploaded_file($file_temp, $path)){
	// 		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 		$sql = "INSERT INTO parent_report (prFosterparentId, prChildrenId, 	prPath, prPhotoname, prDescription)
	// 			VALUES ('$parent_id', '$children_id', '$path', '$name', '$description')";
	// 		mysql_query($con, $sql);
	// 	}
		
	// }catch(PDOException $e){
	// 	echo $e->getMessage();
	// }

?>