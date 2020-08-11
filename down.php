<?php
$param = $_REQUEST;
$oAuthToken = $param['oAuthToken'];
$fileId = $param['fileId'];
$fileName = $param['name'];
$getUrl = 'https://www.googleapis.com/drive/v2/files/' . $fileId . '?alt=media';
$authHeader = 'Authorization: Bearer ' . $oAuthToken;
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $getUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$data = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);
$your_path = "./downloaded/";
file_put_contents($your_path . $fileName, $data);
echo json_encode($error);
?>