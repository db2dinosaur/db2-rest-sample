<?php
// Test GetEmployeesByDepartment.php
	$url = 'http://localhost/GetEmployeesByDepartment.php';

	$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"mgr=000010&dept=A00");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);

	curl_close($ch);
	echo $response;
?>