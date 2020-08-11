<?php
include("./includes/db.php");
// upload to database
if(isset($_POST['oAuthTokenup'])){
$tokenup = $_POST['oAuthTokenup'];
$_POST = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$tokenup), true);
var_dump($_POST);

$insert_username = $_POST['name'];
$insert_image = $_POST['picture'];
$insert_email = $_POST['email'];



//fetch data and check
$get_user_data = "select * from user where email='$insert_email'";
$run_user_data = mysqli_query($con, $get_user_data);
$row_user_data = mysqli_fetch_array($run_user_data);

//fetch data and check for user uploaded data
$get_upload_data = "select * from old_upload where email='$insert_email'";
$run_upload_data = mysqli_query($con, $get_upload_data);
$row_upload_data = mysqli_fetch_array($run_upload_data);

//User profile fetch
$id = $row_user_data['id'];
$username = $row_user_data['username'];
$image = $row_user_data['image'];
$email = $row_user_data['email'];

//Upload history fetch
$upload_id = $row_upload_data['id'];
$upload_email = $row_upload_data['email'];
$upload_count = $row_upload_data['count'];
$upload_latest_time = $row_upload_data['time'];




	//Update history downloaded data if existed email
	if(mysqli_num_rows($run_user_data) > 0) {
		if(mysqli_num_rows($run_upload_data) == 0 ){
			$upload_query = "
			INSERT INTO old_upload(
			email,
			count,
			time
			) VALUES(
			'$insert_email',
			'1',
			NOW()
			)
			";
			
			$run_upload_query = mysqli_query($con, $upload_query);
			echo mysqli_error($con);
			echo "insert upload record";
				
		}else{
			$upload_update_query = "
			UPDATE old_upload SET
			count = '$upload_count' + 1 ,
			time = NOW()
			WHERE email = '$insert_email'
			";
			echo "update upload record";
			$upload_update_query_run = mysqli_query($con, $upload_update_query);
			echo mysqli_error($con);
			}
	
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
	
		$insert_query_run = mysqli_query($con, $insert_query);
		echo "user added to database";
		echo mysqli_error($con);
		
		$upload_query = "
			INSERT INTO old_upload(
			email,
			count,
			time
			) VALUES(
			'$insert_email',
			'1',
			NOW()
			)
			";
			
			$run_upload_query = mysqli_query($con, $upload_query);
			echo mysqli_error($con);
			echo "insert upload record";
	}
	
}

// download to database
if(isset($_POST['oAuthTokendown'])){
$tokendown = $_POST['oAuthTokendown'];
$_POST = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$tokendown), true);
var_dump($_POST);
$insert_username = $_POST['name'];
$insert_image = $_POST['picture'];
$insert_email = $_POST['email'];

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

//Upload history fetch
$download_id = $row_download_data['id'];
$download_email = $row_download_data['email'];
$download_count = $row_download_data['count'];
$download_latest_time = $row_download_data['time'];

//check

	//Update history downloaded data if exist email
	if(mysqli_num_rows($run_user_data) > 0) {
		if(mysqli_num_rows($run_download_data) == 0 ){
			$download_query = "
			INSERT INTO old_download(
			email,
			count,
			time
			) VALUES(
			'$insert_email',
			'1',
			NOW()
			)
			";
			
			$run_download_query = mysqli_query($con, $download_query);
			echo mysqli_error($con);
			echo "inserted download record";
				
		}else{
			$download_update_query = "
			UPDATE old_download SET
			count = '$download_count' + 1 ,
			time = NOW()
			WHERE email = '$insert_email'
			";
			$download_update_query_run = mysqli_query($con, $download_update_query);
			echo mysqli_error($con);
			echo "updated download record";
			}
		
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
		$insert_query_run = mysqli_query($con, $insert_query);
		echo mysqli_error($con);
		$download_query = "
			INSERT INTO old_download(
			email,
			count,
			time
			) VALUES(
			'$insert_email',
			'1',
			NOW()
			)
			";
			
			$run_download_query = mysqli_query($con, $download_query);
			echo mysqli_error($con);
			echo "inserted download record";
	}
	
}

