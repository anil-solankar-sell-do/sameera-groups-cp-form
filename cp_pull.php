<?php


// print_r($_POST);
// die;
error_reporting(0);
$curl = curl_init();

if($_POST['query']){
  $query = $_POST['query'];
}else{
  $query = '';
}
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.sell.do/client/channel_partners/autocomplete?api_key=6312c662c52f45e8d2f03be35d184ee5&client_id=61b1d605a6bbc9630d36b7fd&query='.$query,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: X-Mapping-fjhppofk=F96F449873F41F7215AA1DCA93EDC0D8'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

//https://app.sell.do/client/channel_partners/autocomplete?api_key=14348e18bc20f040bdd4e18fac8680c6&client_id=5c46e492923d4a6596ebff06&query=