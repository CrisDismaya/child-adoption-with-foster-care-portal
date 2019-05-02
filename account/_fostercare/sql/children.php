<?php 
	if (isset($_POST['chSubmit'])) {
		include '../../security/connection.php';

		$fosterhomeId = $_POST['fosterhomeId'];

		$locations = "";
		if(!empty($_FILES['chPhoto']['tmp_name'])
			&& file_exists($_FILES['chPhoto']['tmp_name'])) {
			$image = addslashes(file_get_contents($_FILES['chPhoto']['tmp_name']));
			$image_name = addslashes($_FILES['chPhoto']['name']);
			move_uploaded_file($_FILES["chPhoto"]["tmp_name"], "image/children/" . $_FILES["chPhoto"]["name"]);
			$locations = "image/children/" . $_FILES["chPhoto"]["name"];
		}

		$chFname = $_POST['chFname'];
		$chMname = $_POST['chMname'];
		$chLname = $_POST['chLname'];
		$chAge = $_POST['chAge'];
		$chBirthday = $_POST['chBirthday'];
		$chPlace = $_POST['chPlace'];
		$chGender = $_POST['chGender'];
		$chNationality = $_POST['chNationality'];
		$chStatus = $_POST['chStatus'];
		$chAddress = $_POST['chAddress'];
		$chDescription = $_POST['chDescription'];
		$chHieght = $_POST['chHieght'];
		$chWeight = $_POST['chWeight'];
		$chHobbies = $_POST['chHobbies'];

		$child_query = "INSERT INTO children (chFosterhomeId, chPhoto, chFname, chMname, chLname, chAge, chBirthday, chPlace, chGender, chNationality, chStatus, chAddress, chDescription, chHieght, chWeight, chHobbies)
			VALUES ('$fosterhomeId', '$locations', '$chFname', '$chMname', '$chLname', '$chAge', '$chBirthday', '$chPlace', '$chGender', '$chNationality', '$chStatus', '$chAddress', '$chDescription', '$chHieght', '$chWeight', '$chHobbies')";

		if (!mysqli_query($con, $child_query)) {
			die('Error: ' . mysqli_error($con));
		}
			echo "<script>";
			echo "alert ('Added Data');";
			echo "</script>";
	}

	if (isset($_POST['children_update'])) {
		include '../../security/connection.php';

		$echildren_id =$_POST['echildren_id'];

		$elocations = "";
		if(!empty($_FILES['echildren_photo_new']['tmp_name'])
			&& file_exists($_FILES['echildren_photo_new']['tmp_name'])) {
			$eimage = addslashes(file_get_contents($_FILES['echildren_photo_new']['tmp_name']));
			$eimage_name = addslashes($_FILES['echildren_photo_new']['name']);
			move_uploaded_file($_FILES["echildren_photo_new"]["tmp_name"], "image/children/" . $_FILES["echildren_photo_new"]["name"]);
			$elocations = "image/children/" . $_FILES["echildren_photo_new"]["name"];
		} else {
			$elocations = $_POST['echildren_photo'];
		}

		$echildren_fname =$_POST['echildren_fname'];
		$echildren_mname =$_POST['echildren_mname'];
		$echildren_lname =$_POST['echildren_lname'];
		$echildren_age =$_POST['echildren_age'];

		$echildren_bday =$_POST['echildren_bday'];
		$newechildren_bday = date("Y-m-d", strtotime($echildren_bday));

		$echildren_place =$_POST['echildren_place'];
		$echildren_gender =$_POST['echildren_gender'];
		$echildren_national =$_POST['echildren_national'];
		$echildren_status =$_POST['echildren_status'];
		$echchildren_address =$_POST['echchildren_address'];
		$echchildren_description =$_POST['echchildren_description'];
		$echildren_height =$_POST['echildren_height'];
		$echildren_weight =$_POST['echildren_weight'];
		$echildren_hobbies =$_POST['echildren_hobbies'];

		$updateQuery = "UPDATE children SET chPhoto = '$elocations', chFname = '$echildren_fname', chMname = '$echildren_mname', chLname = '$echildren_lname', chAge = '$echildren_age', chBirthday = '$newechildren_bday', chPlace = '$echildren_place', chGender = '$echildren_gender', chNationality = '$echildren_national', chStatus = '$echildren_status', chAddress = '$echchildren_address', chDescription = '$echchildren_description', chHieght = '$echildren_height', chWeight = '$echildren_weight', chHobbies = '$echildren_hobbies' WHERE childrenId = '$echildren_id'";

		if (!mysqli_query($con, $updateQuery)) {
			die('Error: ' . mysqli_error($con));
		}
			$children_status = "UPDATE children SET chStatus = '$echildren_status', chChildAdopt = '0' WHERE childrenId = '$echildren_id'";
			mysqli_query($con, $children_status);

			$children_adopt_status = "UPDATE children_adopt_by_parent SET adopt_children_status = '$echildren_status' WHERE adopt_children_id = '$echildren_id'";
			mysqli_query($con, $children_adopt_status);
			echo "<script>";
			echo "alert ('The Data has been Updated');";
			echo "</script>";
    }

    

    if (isset($_POST['ajax_add'])) {
		require_once '../../../security/pdo.php';
        $parentId = $_POST['parentId'];
        $childId = $_POST['childId'];
        $childStatus = $_POST['childStatus'];

        $getChild = $db->prepare('SELECT * FROM children WHERE childrenId = ?');
        $getChild->execute([
            $childId
        ]);
        $child = $getChild->fetch();
        $childName = $child['chFname'] .' '. $child['chMname'] .' '. $child['chLname'];

        $addToChildAdoptByParent = $db->prepare('INSERT INTO children_adopt_by_parent
        (adopt_parent_id, adopt_children_id, adopt_children_name, adopt_children_bday, adopt_children_status)
        VALUES (?, ?, ?, ?, ?)');
        $addToChildAdoptByParent->execute([
            $parentId,
            $childId,
            $childName,
            $child['chBirthday'],
            $childStatus
        ]);

        $updateChildStatus = $db->prepare('UPDATE children SET chStatus = ?, chChildAdopt = ? WHERE childrenId = ?');
        $updateChildStatus->execute([
			$childStatus,
			$childStatus,
            $childId
        ]);

        echo 'Successfully added.';
    }
    
    if (isset($_POST['ajax_update'])) {
		require_once '../../../security/pdo.php';
        $id = $_POST['id'];
        $status = $_POST['status'];

        $updateChildren = $db->prepare('UPDATE children SET chStatus = ?, chChildAdopt = ? WHERE childrenId = ?');
        $updateChildren->execute([
            $status, $status, $id
        ]);

        $updateChildrenParent = $db->prepare('UPDATE children_adopt_by_parent SET adopt_children_status = ? WHERE adopt_children_id = ?');
        $updateChildrenParent->execute([
            $status, $id
        ]);

        echo 'Successfully updated.';
    }
?>