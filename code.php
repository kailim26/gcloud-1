<?php
include("./includes/db.php");

// upload to database
if(isset($_POST['is_upload'])){
$upload = $_POST['is_upload'];
$insert_username = $_POST['username'];
$insert_image = $_POST['image'];
$insert_email = $_POST['email'];
$insert_upload = $upload;

//fetch data and check
$get_user_data = "select * from user where email='$insert_email'";
$run_user_data = mysqli_query($con, $get_user_data);
$row_user_data = mysqli_fetch_array($run_user_data);

//fetch data and check for user uploaded data
$get_upload_data = "select * from old_upload where email='$insert_email'";
$run_upload_data = mysqli_query($con, $get_upload_data);
$row_upload_data = mysqli_fetch_array($run_upload_data);

$id = $row_user_data['id'];
$username = $row_user_data['username'];
$image = $row_user_data['image'];
$email = $row_user_data['email'];


	//Update history downloaded data if existed email
	if(mysqli_num_rows($run_user_data) > 0) {
		$upload_query = "
		INSERT INTO old_upload(
		email,
		time
		) VALUES(
		'$insert_email',
		NOW()
		)
		";
		$run_upload_query = mysqli_query($con, $upload_query);
		echo mysqli_error($con);
	
	//No email exist then insert to database 
	}elseif(mysqli_num_rows($run_user_data) == 0) {
		$insert_query = "
		INSERT INTO user (
		username,
		image,
		email,
		created_at
		) VALUES (
		'$insert_username',
		'$insert_image',
		'$insert_email',
		NOW()
		)
		";
		$upload_query = "
		INSERT INTO old_upload(
		email,
		time
		) VALUES(
		'$insert_email',
		NOW()
		)
		";
		$insert_query_run = mysqli_query($con, $insert_query);
		$run_upload_query = mysqli_query($con, $upload_query);
		echo mysqli_error($con);
	}
	

}

// download to database
if(isset($_POST['is_download'])){
$download = $_POST['is_download'];
$insert_username = $_POST['username'];
$insert_image = $_POST['image'];
$insert_email = $_POST['email'];
$insert_upload = $upload;

//fetch data and check for user profile
$get_user_data = "select * from user where email='$insert_email'";
$run_user_data = mysqli_query($con, $get_user_data);
$row_user_data = mysqli_fetch_array($run_user_data);

//fetch data and check for user downloaded data
$get_download_data = "select * from old_download where email='$insert_email'";
$run_download_data = mysqli_query($con, $get_download_data);
$row_download_data = mysqli_fetch_array($run_download_data);

//Checked data from user profile table
$id = $row_user_data['id'];
$username = $row_user_data['username'];
$image = $row_user_data['image'];
$email = $row_user_data['email'];

//check

	//Update history downloaded data if exist email
	if(mysqli_num_rows($run_user_data) > 0) {
		//Update history downloaded data
	$download_query = "
		INSERT INTO old_download(
		email,
		time
		) VALUES(
		'$insert_email',
		NOW()
		)
		";
	$run_download_query = mysqli_query($con, $download_query);
	echo mysqli_error($con);
		
	//Insert to database if no exist email	
	}elseif(mysqli_num_rows($run_user_data) == 0) {
		$insert_query = "
		INSERT INTO user (
		username,
		image,
		email
		) VALUES (
		'$insert_username',
		'$insert_image',
		'$insert_email'
		)
		";
		$download_query = "
		INSERT INTO old_download(
		email,
		time
		) VALUES(
		'$insert_email',
		NOW()
		)
		";
		$run_download_query = mysqli_query($con, $download_query);
		$insert_query_run = mysqli_query($con, $insert_query);
		echo mysqli_error($con);
	}
	
}

