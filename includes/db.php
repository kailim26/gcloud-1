<?php

$con= new PDO("mysql:host=localhost;dbname=gcloud", "root", "root");

if($con)
{
    echo "";
}
else 
{
    die("Connection failed because ".mysqli_connect_error());
}


?>
