<?php
$url = 'http://s0w1.local.zpdt:2046/services/DB2ServiceManager';
$postData = array(
 "requestType"  => "createService",
 "sqlStmt"      => "SELECT DEPTNO," .
						  "DEPTNAME," .
						  "MGRNO," .
						  "ADMRDEPT " .
				   "FROM DEPT " .
				   "ORDER BY DEPTNO",
 "collectionID" => "GILLJSRV",
 "qualifier"	=> "DSN81110",
 "serviceName"  => "GetDepartments",
 "description"  => "Retrieve department list ordered by department ID"
);
$data = json_encode($postData);

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
echo "------------------------------------------------\r\n";
echo $response . "\r\n";
echo "------------------------------------------------\r\n";
// Decode the response
$responseData = json_decode($response, TRUE);
printf("%s\r\n",print_r($responseData, true));
echo "------------------------------------------------\r\n";
?>