<?php
//echo "<pre>";print_r($_POST);die;
if( $_POST['fullname'] && $_POST['email'] && $_POST['phone']){
	$name=$_POST['fullname'];
	$email=$_POST['email'];
	$countrycode=$_POST['dial_code'];
	$countryname=$_POST['country'];
	$phone=$_POST['phone'];

	$url = 'https://app.sell.do/api/leads/create.json';
	
		$data = array ("sell_do" => array(
					"analytics" => array("utm_content" => $utm_content, "utm_term" =>$utm_term),
					"campaign" => array("srd" => ''),
					"form" => array(
						"requirement" => array("property_type" => "flat"), 
						"custom" => array("custom_email_id" =>$email,"custom_countrycode"=>$countrycode, "custom_country"=>$countrynam), 
						"lead" => array ("name" =>$name,  "phone" =>$countrycode."".$phone,"email"=>$email,'source'=>'','sub_source'=>''))),
						// "api_key" =>'7191aae0e69ec97feeeb9718ed5085da'
						"api_key" => '6312c662c52f45e8d2f03be35d184ee5'
					);

		$postdata = json_encode($data);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$result = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($result, true);
		echo 'newuser-';
		//echo "<pre>";print_r($response);echo "</pre>";
} else {
	echo 'Something Went Wrong!';
}
die;
?>
