<?php
include("./includes/db.php");
ob_start();

// upload to database
if(isset($_POST['postbtn'])){
$upload = $_POST['uploadpost'];
$insert_username = $_POST['username'];
$insert_image = $_POST['image'];
$insert_email = $_POST['email'];
$insert_upload = $upload;


$get_user_data = "select * from user where email='$insert_email'";
$run_user_data = mysqli_query($con, $get_user_data);
$row_user_data= mysqli_fetch_array($run_user_data);

$id = $row_user_data['id'];
$username = $row_user_data['username'];
$image = $row_user_data['image'];
$email = $row_user_data['email'];
$upload = $row_user_data['upload'];
$upload_update = $upload++;

	//Update if same as input
	if(mysqli_num_rows($run_user_data) > 0) {
		$update_query = "
		UPDATE user SET 
		username='$insert_username', 
		image='$insert_image', 
		email='$insert_email', 
		upload='$upload_update',
		last_upload=NOW()
		WHERE id='$id'
		";
		
		$update_query_run = mysqli_query($con, $update_query);
		if($update_query_run){
			$_SESSION['success'] = "Successfully Uploaded with existing record";
			header('Location: ./panel/index.php');
			exit;
		}
		else{
		$_SESSION['success'] = "Unable to upload as existing record";
			header('Location: ./panel/index.php');
			exit;
		}
		
		
	}elseif(mysqli_num_rows($run_user_data) == 0) {
		$insert_query = "
		INSERT INTO user (
		username,
		image,
		email,
		upload,
		last_upload,
		download,
		last_download) VALUES (
		'$insert_username',
		'$insert_image',
		'$insert_email',
		'$insert_upload',
		NOW(),
		'',
		''
		)
		";
		
		$insert_query_run = mysqli_query($con, $insert_query);
		if($insert_query_run){
			$_SESSION['success'] = "Successfully Uploaded as new record";
			header('Location: ./panel/index.php');
			exit;
		}
		else{
			$_SESSION['success'] = "Unable to upload as new record";
			header('Location: ./panel/index.php');
			exit;
		}
	}
}

?>