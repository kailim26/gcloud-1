<?php 
 
 // Host Name
$dbhost = 'localhost';

// Database Name
$dbname = 'gcloud';

// Database Username
$dbuser = 'root';

// Database Password
$dbpass = '';

//: MYSQL
$con = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbname"); 

//  $connection = mysqli_connect("localhost","ebox2625_ebox2625_ecommerceweb","Dmshksmsnk_89@","ebox2625_ecommerceweb");


try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}


?>