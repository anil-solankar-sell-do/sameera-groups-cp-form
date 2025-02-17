<?php
//echo "<pre>";print_r($_POST);die;
if ($_POST['inputvalue']) {
	//echo $_GET[projectname];die;
	if (filter_var($_POST['inputvalue'], FILTER_VALIDATE_EMAIL)) {
		$apiurl = 'https://app.sell.do/api/leads/email/retrieve_lead?api_key=6312c662c52f45e8d2f03be35d184ee5&campaign_responses=true&value=' . $_POST['inputvalue']; //full access apikey
	} else {
		$apiurl = 'https://app.sell.do/api/leads/phone/retrieve_lead?api_key=6312c662c52f45e8d2f03be35d184ee5&campaign_responses=true&value=' . $_POST['inputvalue'];
	}

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $apiurl,
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

	$existleadresponseresult = curl_exec($curl);
	curl_close($curl);
	
	$existleadresponse = json_decode($existleadresponseresult, true);   
	echo json_encode($existleadresponse, JSON_PRETTY_PRINT);

} else {
	// echo 'Something went wrong';
}

die;
