<?php
	require (__DIR__ . '/vendor/autoload.php');
	
	use Kreait\Firebase\Factory;
	use Kreait\Firebase\ServiceAccount;
	
	$serviceAccount = ServiceAccount::fromJSONfile(__DIR__ . '/gcloud-e4793-firebase-adminsdk-adskz-4e0d8ab394.json');
	$firebase = (new Factory)
	->withServiceAccount($serviceAccount)
	->withDatabaseUrI('https://gcloud-e4793.firebaseio.com/')
	->create();
	
	
	$database = $firebase->getDatabase();
	
?>