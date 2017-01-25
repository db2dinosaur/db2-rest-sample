<?php
// The following two parameters are mandatory
//   mgr = CHAR(3)
//   dept = numeric & CHAR(6)
$okay = true;
if (!isset($_POST['mgr'])) {
	echo json_encode(array("StatusCode" => 400,
						   "StatusDescription" => "'mgr' not supplied"));
	$okay = false;
}
if ((strlen($_POST['mgr']) != 6) & $okay) {
	echo json_encode(array("StatusCode" => 400,
						   "StatusDescription" => "'mgr' must be CHAR(6)"));
	$okay = false;
}
if ((!isset($_POST['dept'])) & $okay) {
	echo json_encode(array("StatusCode" => 400,
						   "StatusDescription" => "'dept' not supplied"));
	$okay = false;
}
if ((strlen($_POST['dept']) != 3) & $okay) {
	echo json_encode(array("StatusCode" => 400,
						   "StatusDescription" => "'dept' must be CHAR(3)"));
	$okay = false;
}

if ($okay) {
	$url = 'http://s0w1.local.zpdt:2046/services/GILLJSRV/GetEmployeesByDepartment';

	$postdata = array(
		'mgr'  => $_POST['mgr'],
		'dept' => $_POST['dept']
	);
	$data = json_encode($postdata);

	$userid = 'MYUSER';
	$pwd    = 'xxxxxxxx';
	$auth   = base64_encode($userid . ':' . $pwd);
	$hdrs = array(
		'Authorization: Basic ' . $auth,
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data)
		);

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrs);

	$response = curl_exec($ch);

	curl_close($ch);
	echo $response;
}
?>