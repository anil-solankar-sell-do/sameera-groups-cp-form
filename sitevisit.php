<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// echo "<pre>";
// print_r($_POST);
// die;

  $sdate = explode(" ", $_POST['scheduledon']);
  $dateofvisit = $_POST['scheduledon'] . " " . $_POST['in_time_hour'];
  $dateofvisit = $sdate[0] . " " . date('h:i', strtotime('-6 hour 30 minute', strtotime($sdate[1]))); //die;
  $dateofvisitaa = date('g:i', strtotime('-6 hour 30 minute', strtotime($sdate[1])));
  $conducteddate = $sdate[0] . " " . date('h:i', strtotime('+30 minutes', strtotime($dateofvisitaa))); //die;

// client ID 
  $client_id = "61b1d605a6bbc9630d36b7fd";

//API details 
  $enquiry_enable_api  = '4cef7125030662d65ca9232773ab12df'; 
  $enquiry_disable_api = '109e0cdf7206ca11634d41545e812df0';

// Condition to Check which API to use 
$api = (isset($_POST['re_enagamenent']) && $_POST['re_enagamenent'] === "yes") ? $enquiry_enable_api : $enquiry_disable_api;


// Get the project details from the POST request
  $project_details = explode("--", $_POST['project_lists']);
// sales details
  $sales = explode("--", $_POST['sales']);
  $salesid = $sales[0];
  $salesname = $sales[1]; 

// Extract the project_id and project_name
  $project_id = $project_details[0];
  $project_name = $project_details[1];


  $srd = "673b0656735daf551e0f9710";  

// LEAD DETAILS AND API 
// Create an array named `$data` to hold all the form data and additional information.
  $lead_data = array(
    "sell_do" => array(
        "analytics" => array("utm_content" => '', "utm_term" => ''),
        "campaign" => array("srd" => $srd),
        "form" => array(
            "custom" => array(
                "custom_cp_name" => $_POST['cpname'],
                "custom_cp_code" => $_POST['cpcode']
            ),
            "lead" => array(
                "project_id" => $project_id,
                "salutation" => $_POST['salutation'],
                "name" => $_POST['name'],
                "phone" => $_POST['dial_code'] . "" . $_POST['phone'],
                "email" => $_POST['mail_id'],
                "sub_source" => $_POST['cpnamecpcode'],
                "sales" => $salesid
            ),
            "note" => array(
                "content" => $_POST['remarks'],
            ),
        )
    ),
    "api_key" => $api,
  );

// Convert the `$data` array into a JSON string to prepare it for sending in an API request.
  $leadPayload = json_encode($lead_data); // The payload specifically for lead creation.

// Define the API endpoint URL for creating a lead.
  $leadApiEndpoint = 'https://app.sell.do/api/leads/create.json';

// Initialize a cURL session for the lead creation API.
  $leadCurlSession = curl_init($leadApiEndpoint);

// Set cURL options for the lead creation request.
  curl_setopt($leadCurlSession, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($leadCurlSession, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($leadCurlSession, CURLOPT_POST, 1);
  curl_setopt($leadCurlSession, CURLOPT_POSTFIELDS, $leadPayload); // Attach the JSON-encoded data to the POST request body.
  curl_setopt($leadCurlSession, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($leadCurlSession, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($leadCurlSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

  $leadResponseJson = curl_exec($leadCurlSession); // Execute the cURL request and store the response in `$leadResponseJson`.

  curl_close($leadCurlSession); // Close the cURL session for lead creation.

// Decode the JSON response for the lead creation into an associative array.
  $leadResponseData = json_decode($leadResponseJson, true);
// echo $leadResponseData

// Process the lead response, e.g., extracting the lead ID.
  $selldo_lead_crm_id = $leadResponseData['sell_do_lead_id']; // Extract the Sell.Do lead ID from the response array.

//COMMETING SITE VISIT CODE START

// // SITE VISIT
// // Define the API endpoint URL for creating a site visit.
//     $siteVisitApiEndpoint = 'https://app.sell.do/client/leads/x/site_visits.json';
//     $siteVisitCurlSession = curl_init($siteVisitApiEndpoint); // Initialize a cURL session for the site visit API.

// // Prepare the data array for the site visit request.
//     $siteVisitData = array(
//       "api_key" => "6312c662c52f45e8d2f03be35d184ee5",
//       "client_id" => $client_id,
//       "site_visit" => array(
//           "project_id" => $project_id,
//           "scheduled_on" => $dateofvisit,
//           "ends_on" => $conducteddate,
//           "conducted_on" => $conducteddate,
//           "timezone" => "Asia/Calcutta",
//           "status" => "conducted",
//           "agenda" => "Walkin Form",
//           "confirmed" => "true",
//           "custom_attended_by_channel_partner" => $_POST['cpname'] . "--" . $_POST['cpphone'],
//           "lead_crm_id" => $selldo_lead_crm_id
//       ),
//     );
//     $siteVisitPayload = json_encode($siteVisitData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); // Convert the data array into a JSON string to use in the API request.
    
//     //echo  $siteVisitPayload;
//     //die;
//     // Set cURL options explicitly for the site visit API request.
//     curl_setopt($siteVisitCurlSession, CURLOPT_SSL_VERIFYHOST, 0); // Disable SSL host verification (for testing).
//     curl_setopt($siteVisitCurlSession, CURLOPT_SSL_VERIFYPEER, 0); // Disable SSL certificate verification (for testing).
//     curl_setopt($siteVisitCurlSession, CURLOPT_POST, 1); // Specify that this is a POST request.
//     curl_setopt($siteVisitCurlSession, CURLOPT_POSTFIELDS, $siteVisitPayload); // Attach the JSON-encoded data to the POST request body.
//     curl_setopt($siteVisitCurlSession, CURLOPT_RETURNTRANSFER, 1); // Ensure the response is returned as a string.
//     curl_setopt($siteVisitCurlSession, CURLOPT_FOLLOWLOCATION, 1); // Follow redirects, if any.
//     curl_setopt($siteVisitCurlSession, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set JSON content type.

//     // Execute the cURL request and capture the response for the site visit.
//     $siteVisitResponseJson = curl_exec($siteVisitCurlSession); 

//     curl_close($siteVisitCurlSession); // Close the cURL session for the site visit.
//     $siteVisitResponseData = json_decode($siteVisitResponseJson, true); // Decode the JSON response for the site visit into an associative array.

//     //echo $siteVisitResponseData

//COMMETING SITE VISIT CODE END   

    if ($_POST['re_enagamenent'] === "yes") {
      // echo 'https://app.sell.do/client/leads/' . $selldo_lead_crm_id . '/reassign.json';
      // echo '{
      //     "api_key": "6312c662c52f45e8d2f03be35d184ee5",
      //     "client_id": "61b1d605a6bbc9630d36b7fd",
      //     "sales_id": "' . $salesid  . '"
      //   }';
      // salse person update api
      $curl1 = curl_init();
      curl_setopt_array($curl1, array(
        CURLOPT_URL => 'https://app.sell.do/client/leads/' . $selldo_lead_crm_id . '/reassign.json',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => '{
          "api_key": "6312c662c52f45e8d2f03be35d184ee5",
          "client_id": "61b1d605a6bbc9630d36b7fd",
          "sales_id": "' . $salesid  . '"
        }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
        ),
      ));
      $response1 = curl_exec($curl1);
      curl_close($curl1);
      // echo "\n" . $response1 . "\n";
    }
    
  //printing this in response  
  echo $selldo_lead_crm_id;
die;
