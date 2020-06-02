<?php





$date_from_server = date("Y-m-dTH:m:s");
//echo $date_from_server. "<br />";

echo '<span style="color:#FFFFFF;">'. $date_from_server .'</span>';


echo "<br>";

   
$api_key = "8120832c-6e13-4fb1-a692-abc901074e44";   
$password = "36ebccbc-54dc-4cf0-aae9-abca010f118e";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.motionmailapp.com/tokens/datetime/",
  CURLOPT_RETURNTRANSFER => true,
  curl_setopt($curl, CURLOPT_USERPWD, $api_key.':'.$password),
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  // CURLOPT_POSTFIELDS =>"
  //           {\n    \"datetime\": \"$date\"
         
  //           }",
   CURLOPT_POSTFIELDS =>"datetime=$date_from_server",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);

$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo $statusCode;echo'<br/>';


curl_close($curl);
//echo $response;

echo '<span style="color:#FFFFFF;">'. $response .'</span>';

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="robots" content="noindex">
  <title></title>
</head>
<body style="background-color:#061946">

</body>
</html>