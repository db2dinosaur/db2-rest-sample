<?php
$url = 'http://s0w1.local.zpdt:2046/services/GILLJSRV/GetDepartments';

$userid = 'MYUSER';
$pwd    = 'xxxxxx';
$auth   = base64_encode($userid . ':' . $pwd);
$hdrs = array(
	  'Authorization: Basic ' . $auth,
      'Content-Type: application/json'
	);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrs);

$response = curl_exec($ch);

curl_close($ch);
echo $response;
?>