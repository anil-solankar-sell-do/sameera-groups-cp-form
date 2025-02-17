<?php
// echo "<pre>";print_r($_POST);die;

	// echo $_POST['flaga'];die;
if($_POST['flaga']== '1'){
	$result = [];
	$apiurl_project = 'https://app.sell.do/client/projects.json?client_id=61b1d605a6bbc9630d36b7fd&api_key=6312c662c52f45e8d2f03be35d184ee5';
	$curll_project = curl_init();
	curl_setopt_array($curll_project, array(
		CURLOPT_URL => $apiurl_project,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: X-Mapping-fjhppofk=3F8B5E02957E315BFC0D0D3F38F9B49C'
		),
	));

	$existleadresponseresult_porject = curl_exec($curll_project);
	curl_close($curll_project);
	$existleadresponse_porject = json_decode($existleadresponseresult_porject, true);
    $result['project'] =  $existleadresponseresult_porject;


	// uesrs
	$apiurl_users = 'https://app.sell.do/client/users.json?client_id=61b1d605a6bbc9630d36b7fd&api_key=6312c662c52f45e8d2f03be35d184ee5&status=true';
	$curl_users = curl_init();
	curl_setopt_array($curl_users, array(
		CURLOPT_URL => $apiurl_users,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: X-Mapping-fjhppofk=3F8B5E02957E315BFC0D0D3F38F9B49C'
		),
	));

	$existleadresponseresult_users = curl_exec($curl_users);
	curl_close($curl_users);
	$existleadresponse_users = json_decode($existleadresponseresult_users, true);
    $result['user']= $existleadresponseresult_users;
	echo json_encode($result);
}else{
    echo "error";
}
die;
