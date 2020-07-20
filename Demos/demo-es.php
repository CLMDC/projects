<?PHP

if(isset($_POST['submit'])) {


//********************** Starts creating data for CB **********************//
$url = 'https://api.pro.we.01.currentdesk.com:444/registration/lead';


$data = array(
    'lead-email' => $_POST['lead-email'],    
    'lead-residence-country-id' => $_POST['NewValueCountry'],
    //'lead-residence-country-id' => '87',
    'lead-language-id' => 1,
    'account-trading-platform-id' => 1,
    'account-category-id' => 1,
    'account-currency-id' => 5,
    'trading-average-deal-size-id' => 1,
    'account-preference-id' => 119,
    'lead-title-id' => 1,
    'financial-initial-deposit-id' => 81,
    'trading-experience-id' => 6,
    'lead-first-name' => $_POST['lead-first-name'],
    'lead-last-name' => $_POST['lead-last-name'],
    'lead-telephone' => '0000-0000',
    'account-demo-status' => true,
    'lead-client-number' => 0,
    'partner-assets-under-management' => 0,

    );

$postdata = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Basic YXBpQGNsbWZvcmV4LmNvbTp5NTRhamhhc2prYWE6MTQ0',
    'Content-Type: application/json',
    'Accept: application/json'
    //'Content-Length: ' . strlen($data)
));
// $result = curl_exec($ch);
// curl_close($ch);
// print_r ($result);

$result = curl_exec($ch);

$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);



//print_r($response);



//********************** Ends creating data for CB **********************//

if ($statusCode == 200) {
      // successful response - continue as planned.        
        //$thk = 'You have successfully signed up for a 30-day demo.<br/>ou will receive an email with the download links and instructions to access your new account. <br/>We thank you for choosing CLM, and hope to see you trading live soon!';

        //$message = '<script type="text/javascript">window.location = "https://www.clmforex.com/demo-account-thank-you"</script>';
        //return $message;
        //$yourURL="https://www.clmforex.com/demo-account-thank-you";
        $yourURL="/demo-account-thank-you/";
        echo ("<script>location.href='$yourURL'</script>");
        //header('Location: https://www.clmforex.com/demo-account-thank-you');
        //exit(); // terminates the script
    }
    else {
      // error occurred - provide the user some information.
      //echo "Email duplicated";
        $emailError = 'Your 30-day trial period has expired. Additional demos are available once you open and fund a live trading account.';


    }




//********************** Creating data for Salesforce **********************//
$oid = "00Di0000000cOee";
//$post_data['retURL'] = 'https://www.clmforex.com/demo-account-thank-you';

//create array of data to be posted
$post_data['oid'] = $oid;
$post_data['first_name'] = trim($_POST['lead-first-name']);
$post_data['last_name'] = trim($_POST['lead-last-name']);
$post_data['country'] = trim($_POST['social']);
//$post_data['phone'] = trim('0000-0000');
$post_data['email'] = trim($_POST['lead-email']);
$post_data['Preferred_Language__c'] = trim($_POST['Preferred_Language__c']);

// What_are_your_favorite_pairs__c ->

if(isset($_POST['What_are_your_favorite_pairs__c'])){ // select_name will be replaced with your input filed name
  $post_dataM = $_POST['What_are_your_favorite_pairs__c']; // select_name will be replaced with your input filed name
  $selectedOption = "";
  foreach ($post_dataM as $option => $value) {
    $selectedOption .= $value.';'; // I am separating Values with a comma (,) so that I can extract data using explode()
  }
  }
//echo $selectedOption; 


//$money = "EUR/USD;USD/JPY;GBP/USD";
//$money = "Other;BTC;GOLD;USD/CAD;";
$money = $selectedOption;



//create array of data to be posted
$post_data['What_are_your_favorite_pairs__c'] = $money;



$post_data['Trading_experience__c'] = trim($_POST['Trading_experience__c']);





//$post_data['Tell_us_what_you_like_to_trade__c'] = trim($_POST['Tell_us_what_you_like_to_trade__c']);
// Trading_Product__c ->

if(isset($_POST['Trading_Product__c'])){ // select_name will be replaced with your input filed name
  $post_dataM = $_POST['Trading_Product__c']; // select_name will be replaced with your input filed name
  $selectedOption = "";
  foreach ($post_dataM as $option => $value) {
    $selectedOption .= $value.';'; // I am separating Values with a comma (,) so that I can extract data using explode()
  }
  }
//echo $selectedOption; 


//$money = "EUR/USD;USD/JPY;GBP/USD";
//$money = "Other;BTC;GOLD;USD/CAD;";
$money = $selectedOption;



//create array of data to be posted
$post_data['Trading_Product__c'] = $money;








//traverse array and prepare data for posting (key1=value1)
foreach ( $post_data as $key => $value) {
$post_items[] = $key . '=' . $value;
}

//create the final string to be posted using implode()
$post_string = implode ('&', $post_items);

//print_r($post_data);
//create cURL connection
$curl_connection = curl_init('https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8');
//curl_setopt($curl_connection, CURLOPT_URL, $url);


//set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT,
"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
 
//set data to be posted
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
//perform our request
$result = curl_exec($curl_connection);
//show information regarding the request
//print_r(curl_getinfo($curl_connection));
//echo curl_errno($curl_connection) . '-' . curl_error($curl_connection);
//close the connection
curl_close($curl_connection);
 
// HERE YOU CAN ADD ANY BUSINESS REQUIREMENT,
//********************** Ends data of SF  **********************//



}

?>

<html>
<head>
    <title>Live Account Login - Core Liquidity Markets</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>


     <script src="https://makitweb.com/demo/jquery.js" type="text/javascript"></script>

    <!-- select2 css -->
    <link href="https://makitweb.com/demo/dropdown_image/select2.min.css" rel="stylesheet" type="text/css">

    <!-- select2 script -->
    <script src="https://makitweb.com/demo/dropdown_image/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">



  <style id="compiled-css" type="text/css">
    /* Library for show / hide password input */
      @import url("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");

/* form { margin:50px auto;max-width:560px;}    */
  </style>


    <style type="text/css">
        @font-face {
          font-family: avenir-regular;
          src: url(/wp-content/uploads/2019/04/AvenirNextLTPro-Regular-1.woff);
          /* background-color: #4281c6; */
        }

        body {
          font-family: avenir-regular !important;
          src: url(/wp-content/uploads/2019/04/AvenirNextLTPro-Regular-1.woff);
        }

    div.formStyle {
          border-radius: 8px;
          background-color: #fff;
          max-width: 500px;
          margin: auto;
          padding-left: 20px;
          padding-right: 20px;
          padding-top: 42px;
          padding-bottom: 42px;
    }

     div.ht {
      height: auto;
      /* min-height : 100%; */
      /* height: 39%; */
      bottom: 7%;
      position: relative;
      overflow:hidden;
      position: relative;
      display: block;

    }

    @media only screen and (max-width: 375px) {    
      div.col-left {
      max-width: 100% !important;
      }

      .btn.btn-success {
          background-color: #2cc482 !important;
          width: 48% !important;
          float: right !important;
      }

      .btn.btn-primary {
          background-color: #1062bc !important;
          width: 48% !important;
      }

     .col-md-6 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;

      }

    }

    /*-- Horizontal Cellphones --*/
    @media (min-width: 376px) and (max-width: 767px) {
      div.col-left {
      max-width: 100% !important;
      }

      .btn.btn-success {
          background-color: #2cc482 !important;
          width: 48% !important;
          float: right !important;
      }

      .btn.btn-primary {
          background-color: #1062bc !important;
          width: 48% !important;
      }

      .col-md-6 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;

      }

    }


        /*-- Tablets --*/
    /* @media only screen and (max-width: 768px) { */
    @media (min-width: 768px) and (max-width: 991px) {
      div.col-left {
      max-width: 100% !important;
      }

      .btn.btn-success {
          background-color: #2cc482 !important;
          width: 48% !important;
          float: right !important;
      }

      .btn.btn-primary {
          background-color: #1062bc !important;
          width: 48% !important;
      }


      .col-md-6 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;

      }

      div.col-right {
        max-width: 100% !important;
      }

    }        

           

</style>
<!-- Captcha script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>


<style type="text/css">
    div.col-left {
      max-width: 50% !important;
    }


    /*html, body { height:auto; } a.md-default-theme:not(.md-button), a:not(.md-button) { color:#000;}.input {max-width: 280px;}label{min-width:80px;}*/

    #header {
      min-height:100%;
      display:block;
      /* background-image: url(https://www.clmforex.com/assets/images/login-new.jpg); */
      background-color: #061946;
      background-repeat:no-repeat;
      background-size: cover;
    }

    .white{
      padding: 15px 0
    }

</style>

    <!-- mixing, adding styles -->
    <style type="text/css">
        .error {
            color:red;
        }

        .success {
            color:green;
        }
    </style>


    <style type="text/css">
      @media only screen and (min-width: 1025px) {  
      .btn:not([class*=btn-outline-]) {    
          background-color: #fff !important;
          color: black;  
          border: 1px solid #ccc;

          -webkit-box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0) !important;
          box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0) !important;

      }

      .btn.btn-primary {
          background-color: #1062bc !important;
          /* width: 49% !important; */
          width: 47% !important;
          margin-right: 2.5%;
      }

      .btn.btn-success {
          background-color: #2cc482 !important;
          /* width: 49% !important; */
          width: 47% !important;
          margin-left: 2.5%;
      }
}

    </style>




<script type="text/javascript">
            (async() => {
              //const res = await fetch("https://freegeoip.app/json/");
              const res = await fetch("https://ipapi.co/json/"); 
              const json = await res.json();
              document.getElementById("social").value = json.country_code;
              //$("#social").select2();
              $("#social").select2({
                templateResult: formatOptions,
                templateSelection: formatOptions
              });

                function changeLevel(){
                var s2;
                if(document.getElementById("social").value == "AL"){ s2 = '2';}
                        if(document.getElementById("social").value == "DZ"){ s2 = '3';}
                        if(document.getElementById("social").value == "AS"){ s2 = '4';}
                        if(document.getElementById("social").value == "AD"){ s2 = '5';}
                        if(document.getElementById("social").value == "AO"){ s2 = '6';}
                        if(document.getElementById("social").value == "AI"){ s2 = '7';}
                        if(document.getElementById("social").value == "AQ"){ s2 = '8';}
                        if(document.getElementById("social").value == "AG"){ s2 = '9';}
                        if(document.getElementById("social").value == "AR"){ s2 = '10';}
                        if(document.getElementById("social").value == "AM"){ s2 = '11';}
                        if(document.getElementById("social").value == "AW"){ s2 = '12';}
                        if(document.getElementById("social").value == "AU"){ s2 = '13';}
                        if(document.getElementById("social").value == "AT"){ s2 = '14';}
                        if(document.getElementById("social").value == "AZ"){ s2 = '15';}
                        if(document.getElementById("social").value == "BS"){ s2 = '16';}
                        if(document.getElementById("social").value == "BH"){ s2 = '17';}
                        if(document.getElementById("social").value == "BB"){ s2 = '19';}
                        if(document.getElementById("social").value == "BY"){ s2 = '20';}
                        if(document.getElementById("social").value == "BZ"){ s2 = '22';}
                        if(document.getElementById("social").value == "BJ"){ s2 = '23';}
                        if(document.getElementById("social").value == "BM"){ s2 = '24';}
                        if(document.getElementById("social").value == "BT"){ s2 = '25';}
                        if(document.getElementById("social").value == "BO"){ s2 = '26';}
                        if(document.getElementById("social").value == "BW"){ s2 = '28';}
                        if(document.getElementById("social").value == "BV"){ s2 = '29';}
                        if(document.getElementById("social").value == "BR"){ s2 = '30';}
                        if(document.getElementById("social").value == "IO"){ s2 = '31';}
                        if(document.getElementById("social").value == "BN"){ s2 = '32';}
                        if(document.getElementById("social").value == "BG"){ s2 = '33';}
                        if(document.getElementById("social").value == "BF"){ s2 = '34';}
                        if(document.getElementById("social").value == "KH"){ s2 = '36';}
                        if(document.getElementById("social").value == "CM"){ s2 = '37';}
                        if(document.getElementById("social").value == "CV"){ s2 = '39';}
                        if(document.getElementById("social").value == "KY"){ s2 = '40';}
                        if(document.getElementById("social").value == "TD"){ s2 = '42';}
                        if(document.getElementById("social").value == "CL"){ s2 = '43';}
                        if(document.getElementById("social").value == "CN"){ s2 = '44';}
                        if(document.getElementById("social").value == "CX"){ s2 = '45';}
                        if(document.getElementById("social").value == "CC"){ s2 = '47';}
                        if(document.getElementById("social").value == "CO"){ s2 = '48';}
                        if(document.getElementById("social").value == "KM"){ s2 = '49';}
                        if(document.getElementById("social").value == "CK"){ s2 = '50';}
                        if(document.getElementById("social").value == "CR"){ s2 = '51';}
                        if(document.getElementById("social").value == "HR"){ s2 = '52';}
                        if(document.getElementById("social").value == "CU"){ s2 = '53';}
                        if(document.getElementById("social").value == "CY"){ s2 = '54';}
                        if(document.getElementById("social").value == "CZ"){ s2 = '55';}
                        if(document.getElementById("social").value == "DK"){ s2 = '56';}
                        if(document.getElementById("social").value == "DJ"){ s2 = '57';}
                        if(document.getElementById("social").value == "DM"){ s2 = '58';}
                        if(document.getElementById("social").value == "DO"){ s2 = '59';}
                        if(document.getElementById("social").value == "EC"){ s2 = '61';}
                        if(document.getElementById("social").value == "EG"){ s2 = '62';}
                        if(document.getElementById("social").value == "SV"){ s2 = '63';}
                        if(document.getElementById("social").value == "GQ"){ s2 = '64';}
                        if(document.getElementById("social").value == "EE"){ s2 = '66';}
                        if(document.getElementById("social").value == "FK"){ s2 = '68';}
                        if(document.getElementById("social").value == "FO"){ s2 = '69';}
                        if(document.getElementById("social").value == "FJ"){ s2 = '70';}
                        if(document.getElementById("social").value == "FI"){ s2 = '71';}
                        if(document.getElementById("social").value == "FR"){ s2 = '72';}
                        if(document.getElementById("social").value == "GF"){ s2 = '73';}
                        if(document.getElementById("social").value == "PF"){ s2 = '74';}
                        if(document.getElementById("social").value == "TF"){ s2 = '75';}
                        if(document.getElementById("social").value == "GA"){ s2 = '76';}
                        if(document.getElementById("social").value == "GM"){ s2 = '77';}
                        if(document.getElementById("social").value == "GE"){ s2 = '78';}
                        if(document.getElementById("social").value == "DE"){ s2 = '79';}
                        if(document.getElementById("social").value == "GH"){ s2 = '80';}
                        if(document.getElementById("social").value == "GI"){ s2 = '81';}
                        if(document.getElementById("social").value == "GR"){ s2 = '82';}
                        if(document.getElementById("social").value == "GL"){ s2 = '83';}
                        if(document.getElementById("social").value == "GD"){ s2 = '84';}
                        if(document.getElementById("social").value == "GP"){ s2 = '85';}
                        if(document.getElementById("social").value == "GU"){ s2 = '86';}
                        if(document.getElementById("social").value == "GT"){ s2 = '87';}
                        if(document.getElementById("social").value == "GN"){ s2 = '88';}
                        if(document.getElementById("social").value == "GW"){ s2 = '89';}
                        if(document.getElementById("social").value == "HM"){ s2 = '92';}
                        if(document.getElementById("social").value == "HN"){ s2 = '93';}
                        if(document.getElementById("social").value == "HK"){ s2 = '94';}
                        if(document.getElementById("social").value == "HU"){ s2 = '95';}
                        if(document.getElementById("social").value == "IS"){ s2 = '96';}
                        if(document.getElementById("social").value == "ID"){ s2 = '98';}
                        if(document.getElementById("social").value == "IT"){ s2 = '103';}
                        if(document.getElementById("social").value == "JM"){ s2 = '104';}
                        if(document.getElementById("social").value == "JO"){ s2 = '106';}
                        if(document.getElementById("social").value == "KZ"){ s2 = '107';}
                        if(document.getElementById("social").value == "KE"){ s2 = '108';}
                        if(document.getElementById("social").value == "KI"){ s2 = '109';}
                        if(document.getElementById("social").value == "KW"){ s2 = '112';}
                        if(document.getElementById("social").value == "KG"){ s2 = '113';}
                        if(document.getElementById("social").value == "LV"){ s2 = '115';}
                        if(document.getElementById("social").value == "LS"){ s2 = '117';}
                        if(document.getElementById("social").value == "LR"){ s2 = '118';}
                        if(document.getElementById("social").value == "LI"){ s2 = '120';}
                        if(document.getElementById("social").value == "LT"){ s2 = '121';}
                        if(document.getElementById("social").value == "LU"){ s2 = '122';}
                        if(document.getElementById("social").value == "MO"){ s2 = '123';}
                        if(document.getElementById("social").value == "MK"){ s2 = '124';}
                        if(document.getElementById("social").value == "MG"){ s2 = '125';}
                        if(document.getElementById("social").value == "MW"){ s2 = '126';}
                        if(document.getElementById("social").value == "MY"){ s2 = '127';}
                        if(document.getElementById("social").value == "ML"){ s2 = '128';}
                        if(document.getElementById("social").value == "MT"){ s2 = '129';}
                        if(document.getElementById("social").value == "MH"){ s2 = '130';}
                        if(document.getElementById("social").value == "MQ"){ s2 = '131';}
                        if(document.getElementById("social").value == "MR"){ s2 = '132';}
                        if(document.getElementById("social").value == "MU"){ s2 = '133';}
                        if(document.getElementById("social").value == "YT"){ s2 = '134';}
                        if(document.getElementById("social").value == "MX"){ s2 = '135';}
                        if(document.getElementById("social").value == "FM"){ s2 = '136';}
                        if(document.getElementById("social").value == "MD"){ s2 = '137';}
                        if(document.getElementById("social").value == "MC"){ s2 = '138';}
                        if(document.getElementById("social").value == "MN"){ s2 = '139';}
                        if(document.getElementById("social").value == "ME"){ s2 = '140';}
                        if(document.getElementById("social").value == "MS"){ s2 = '141';}
                        if(document.getElementById("social").value == "MA"){ s2 = '142';}
                        if(document.getElementById("social").value == "MZ"){ s2 = '143';}
                        if(document.getElementById("social").value == "NA"){ s2 = '145';}
                        if(document.getElementById("social").value == "NR"){ s2 = '146';}
                        if(document.getElementById("social").value == "NP"){ s2 = '147';}
                        if(document.getElementById("social").value == "NL"){ s2 = '148';}
                        if(document.getElementById("social").value == "NC"){ s2 = '150';}
                        if(document.getElementById("social").value == "NZ"){ s2 = '151';}
                        if(document.getElementById("social").value == "NE"){ s2 = '153';}
                        if(document.getElementById("social").value == "NU"){ s2 = '154';}
                        if(document.getElementById("social").value == "NF"){ s2 = '155';}
                        if(document.getElementById("social").value == "MP"){ s2 = '156';}
                        if(document.getElementById("social").value == "NO"){ s2 = '157';}
                        if(document.getElementById("social").value == "OM"){ s2 = '158';}
                        if(document.getElementById("social").value == "PW"){ s2 = '160';}
                        if(document.getElementById("social").value == "PS"){ s2 = '161';}
                        if(document.getElementById("social").value == "PY"){ s2 = '164';}
                        if(document.getElementById("social").value == "PE"){ s2 = '165';}
                        if(document.getElementById("social").value == "PH"){ s2 = '166';}
                        if(document.getElementById("social").value == "PN"){ s2 = '167';}
                        if(document.getElementById("social").value == "PL"){ s2 = '168';}
                        if(document.getElementById("social").value == "PT"){ s2 = '169';}
                        if(document.getElementById("social").value == "QA"){ s2 = '171';}
                        if(document.getElementById("social").value == "RE"){ s2 = '172';}
                        if(document.getElementById("social").value == "RO"){ s2 = '173';}
                        if(document.getElementById("social").value == "RU"){ s2 = '174';}
                        if(document.getElementById("social").value == "RW"){ s2 = '175';}
                        if(document.getElementById("social").value == "SH"){ s2 = '176';}
                        if(document.getElementById("social").value == "KN"){ s2 = '177';}
                        if(document.getElementById("social").value == "LC"){ s2 = '178';}
                        if(document.getElementById("social").value == "MF"){ s2 = '242';}
                        if(document.getElementById("social").value == "PM"){ s2 = '179';}
                        if(document.getElementById("social").value == "VC"){ s2 = '180';}
                        if(document.getElementById("social").value == "WS"){ s2 = '181';}
                        if(document.getElementById("social").value == "SM"){ s2 = '182';}
                        if(document.getElementById("social").value == "ST"){ s2 = '183';}
                        if(document.getElementById("social").value == "SA"){ s2 = '184';}
                        if(document.getElementById("social").value == "SN"){ s2 = '185';}
                        if(document.getElementById("social").value == "SC"){ s2 = '187';}
                        if(document.getElementById("social").value == "SG"){ s2 = '189';}
                        if(document.getElementById("social").value == "VE"){ s2 = '224';}
                        if(document.getElementById("social").value == "SX"){ s2 = '243';}
                        if(document.getElementById("social").value == "SK"){ s2 = '190';}
                        if(document.getElementById("social").value == "SI"){ s2 = '191';}
                        if(document.getElementById("social").value == "SB"){ s2 = '192';}
                        if(document.getElementById("social").value == "ZA"){ s2 = '193';}
                        if(document.getElementById("social").value == "GS"){ s2 = '194';}
                        if(document.getElementById("social").value == "ES"){ s2 = '195';}
                        if(document.getElementById("social").value == "SJ"){ s2 = '199';}
                        if(document.getElementById("social").value == "SZ"){ s2 = '200';}
                        if(document.getElementById("social").value == "SE"){ s2 = '201';}
                        if(document.getElementById("social").value == "CH"){ s2 = '202';}
                        if(document.getElementById("social").value == "SY"){ s2 = '203';}
                        if(document.getElementById("social").value == "TJ"){ s2 = '204';}
                        if(document.getElementById("social").value == "TZ"){ s2 = '206';}
                        if(document.getElementById("social").value == "TH"){ s2 = '207';}
                        if(document.getElementById("social").value == "TG"){ s2 = '208';}
                        if(document.getElementById("social").value == "TK"){ s2 = '209';}
                        if(document.getElementById("social").value == "TO"){ s2 = '210';}
                        if(document.getElementById("social").value == "TM"){ s2 = '214';}
                        if(document.getElementById("social").value == "TC"){ s2 = '215';}
                        if(document.getElementById("social").value == "TV"){ s2 = '216';}
                        if(document.getElementById("social").value == "UA"){ s2 = '218';}
                        if(document.getElementById("social").value == "AE"){ s2 = '219';}
                        if(document.getElementById("social").value == "GB"){ s2 = '220';}
                        if(document.getElementById("social").value == "UY"){ s2 = '221';}
                        if(document.getElementById("social").value == "UZ"){ s2 = '222';}
                        if(document.getElementById("social").value == "VN"){ s2 = '225';}
                        if(document.getElementById("social").value == "VG"){ s2 = '226';}
                        if(document.getElementById("social").value == "VI"){ s2 = '227';}
                        if(document.getElementById("social").value == "WF"){ s2 = '228';}
                        if(document.getElementById("social").value == "EH"){ s2 = '229';}
                        if(document.getElementById("social").value == "ZM"){ s2 = '231';}
                // }
                document.getElementById("NS").innerHTML=("Level: " +s2);
                //var element = document.getElementById("NS");

                document.getElementById("NewValueCountry").value = s2;
              }
              changeLevel();

            })();
        </script>


        <style type="text/css">
            .img-flag  {
                /*width: 45px !important;
                height: 45px !important;*/
                /* width: 5% !important;*/

                width: 35px !important;
                height: 35px !important;
                border-radius: 100% !important;
                background: #eee no-repeat center !important;
                background-size: cover !important;
                /*
                width: 23px;
                height: 23px;
                */
            }
        </style>

<!--         <script>      
        function formatOptions (state) {
            if (!state.id) {
             return state.text;
         }

             var baseUrl = "images/";
             var $state = $(
                '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.svg" class="img-flag" /> ' + state.text + '</span>'
              );
              return $state;
        }
        </script> -->



        <script type="text/javascript">  
        function formatOptions (state) {
            if (!state.id) {
             return state.text;
         }


             var baseUrl = "https://clmmultisites.wpengine.com/wp-content/uploads/2019/06/";

             var $state = $(
                '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.svg" class="img-flag" /> ' + state.text + '</span>'
              );
              return $state;
        }
        </script>
<!-- -->


<!-- input height & border colors -->
<style type="text/css">
  a:focus, a:active, input, input:hover, input:focus, input:active, textarea, textarea:hover, textarea:focus, textarea:active {
    -moz-outline: none;
    outline: none;
    height: 50px !important;
    border-color: #b1b1b1 !important;

</style>


<style type="text/css">
/* heigh, select country flags */
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #7a7a7a !important;
    line-height: 37px;
   
}

  .select2-container .select2-selection--single {    
    height: 50px !important;
    border-color: #dbdbdb !important;
}

/* height center country name and flag. */
  .select2-container .select2-selection--single .select2-selection__rendered {
    padding-top: 6px !important;
}

/* Center arrow in dropdown*/
  .select2-container--default .select2-selection--single .select2-selection__arrow b {
      margin-top: 8px;
  }




/* Disclaimer */

  input.xyz  {
      width: 17px !important;
      height: 17px !important;
  }

  span.xyz {
      margin-top: -20px !important;
  }


/* height: 50px !important; */


</style>




<!-- -->
</head>


<style type="text/css">


    div.col-left {
      max-width: 50% !important;
    }


 
</style>

<body style="background-color:#061946;">
<!-- <center><h1 style="color:#fff">Create your account</h1></center> -->
    <div class="formStyle">
      <div class="ht">

<script type="text/javascript">
  function passvalues()
  {
    var firstname=document.getElementById("lead-first-name").value;
    localStorage.setItem("FirstName",firstname);

    var lastname=document.getElementById("lead-last-name").value;
    localStorage.setItem("LastName",lastname);

    var Email=document.getElementById("lead-email").value;
    localStorage.setItem("VEmail",Email);
    return false;
  }
</script>
       
      <form action="" method="POST">
        <input id="redirect_url" type="hidden" name="redirect_url" value="https://www.clmforex.com/demo-account-thank-you"; />
                           
                            <div class="col-md-12">                              
                              <center>
                                <span class="error"><?php if (isset($emailError)) echo $emailError ?></span>  
                              </center>
                             
                            </div>

                            <input type="text" id="website" name="website"/>
                            <style type="text/css">
                              form #website{ display:none; }
                            </style>
                            <div class="col-md-6" style="padding-right: 5px;">                              
                                <div class="form-group">
                                    <!-- <label for="first_name">First name *</label> -->
                                    <input onkeyup="javascript:capitalize(this);" id="lead-first-name" type="text" name="lead-first-name" class="form-control" placeholder="First name*" required="required" data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <script type="text/javascript">
                                function capitalize(obj) {
                                  str = obj.value;
                                  obj.value = str.replace(/\w\S*/g, function(txt) {          
                                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();            
                                  });
                                }
                            </script>

                            <div class="col-md-6" style="padding-left: 5px;">
                                <div class="form-group">
                                    <!-- <label for="last_name">Last name *</label> -->
                                    <input onkeyup="javascript:capitalize(this);" id="lead-last-name" type="text" name="lead-last-name" class="form-control" placeholder="Last name*" required="required" data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                           

                             <!-- Hidden -->

                            <input id="Preferred_Language__c" type="hidden" name="Preferred_Language__c" class="form-control" placeholder="Please enter your phone number *" required="required" data-error="Phone is required." value="English">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <label for="email">Email *</label> -->
                                    <input oninput="this.value=this.value.toLowerCase()" id="lead-email" type="email" name="lead-email" class="form-control" placeholder="Email address*" required="required" data-error="Valid email is required." value="<?php if (isset($email)) echo $emailError ?>">
                                   <!--  <span class="error"><?php if (isset($emailError)) echo $emailError ?></span>  -->
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                element.addEventListener('input',function(){this.value=this.value.toLowerCase()});

                            </script>




                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="social" id="social" name="social" style="width: 100%;" onchange='changeLevel()' required>
                                      <option value="AL">Albania</option>
                                      <option value="DZ">Algeria</option>
                                      <option value="AS">American Samoa</option>
                                      <option value="AD">Andorra</option>
                                      <option value="AO">Angola</option>
                                      <option value="AI">Anguilla</option>
                                      <option value="AQ">Antarctica</option>
                                      <option value="AG">Antigua and Barbuda</option>
                                      <option value="AR">Argentina</option>
                                      <option value="AM">Armenia</option>
                                      <option value="AW">Aruba</option>
                                      <!-- <option value="AU">Australia</option> -->
                                      <option value="AT">Austria</option>
                                      <!-- <option value="AZ">Azerbaijan</option> -->
                                      <option value="BS">Bahamas</option>
                                      <option value="BH">Bahrain</option>
                                      <option value="BB">Barbados</option>
                                      <option value="BY">Belarus</option>
                                      <option value="BZ">Belize</option>
                                      <option value="BJ">Benin</option>
                                      <option value="BM">Bermuda</option>
                                      <option value="BT">Bhutan</option>
                                      <option value="BO">Bolivia, Plurinational State of</option>
                                      <!-- <option value="BW">Botswana</option> -->
                                      <option value="BV">Bouvet Island</option>
                                      <option value="BR">Brazil</option>
                                      <option value="IO">British Indian Ocean Territory</option>
                                      <option value="BN">Brunei Darussalam</option>
                                      <option value="BG">Bulgaria</option>
                                      <option value="BF">Burkina Faso</option>
                                      <option value="KH">Cambodia</option>
                                      <option value="CM">Cameroon</option>
                                      <option value="CV">Cape Verde</option>
                                      <option value="KY">Cayman Islands</option>
                                      <option value="TD">Chad</option>
                                      <option value="CL">Chile</option>
                                      <option value="CN">China</option>
                                      <option value="CX">Christmas Island</option>
                                      <option value="CC">Cocos (Keeling) Islands</option>
                                      <option value="CO">Colombia</option>
                                      <option value="KM">Comoros</option>
                                      <option value="CK">Cook Islands</option>
                                      <option value="CR">Costa Rica</option>
                                      <option value="HR">Croatia</option>
                                      <option value="CU">Cuba</option>
                                      <option value="CY">Cyprus</option>
                                      <option value="CZ">Czech Republic</option>
                                      <option value="DK">Denmark</option>
                                      <option value="DJ">Djibouti</option>
                                      <option value="DM">Dominica</option>
                                      <option value="DO">Dominican Republic</option>
                                      <option value="EC">Ecuador</option>
                                      <option value="EG">Egypt</option>
                                      <option value="SV">El Salvador</option>
                                      <option value="GQ">Equatorial Guinea</option>
                                      <option value="EE">Estonia</option>
                                      <option value="FK">Falkland Islands (Malvinas)</option>
                                      <option value="FO">Faroe Islands</option>
                                      <option value="FJ">Fiji</option>
                                      <option value="FI">Finland</option>
                                      <option value="FR">France</option>
                                      <option value="GF">French Guiana</option>
                                      <option value="PF">French Polynesia</option>
                                      <option value="TF">French Southern Territories</option>
                                      <option value="GA">Gabon</option>
                                      <option value="GM">Gambia</option>
                                      <option value="GE">Georgia</option>
                                      <option value="DE">Germany</option>
                                      <option value="GH">Ghana</option>
                                      <option value="GI">Gibraltar</option>
                                      <option value="GR">Greece</option>
                                      <option value="GL">Greenland</option>
                                      <option value="GD">Grenada</option>
                                      <option value="GP">Guadeloupe</option>
                                      <option value="GU">Guam</option>
                                      <option value="GT">Guatemala</option>
                                      <option value="GN">Guinea</option>
                                      <option value="GW">Guinea-Bissau</option>
                                      <option value="HM">Heard Island and McDonald Islands</option>
                                      <option value="HN">Honduras</option>
                                      <option value="HK">Hong Kong</option>
                                      <option value="HU">Hungary</option>
                                      <!-- <option value="IS">Iceland</option> -->
                                      <option value="IT">Italy</option>
                                      <option value="ID">Indonesia</option>
                                      <option value="JM">Jamaica</option>
                                      <option value="JO">Jordan</option>
                                      <!-- <option value="KZ">Kazakhstan</option> -->
                                      <option value="KE">Kenya</option>
                                      <option value="KI">Kiribati</option>
                                      <option value="KW">Kuwait</option>
                                      <option value="KG">Kyrgyzstan</option>
                                      <option value="LV">Latvia</option>
                                      <option value="LS">Lesotho</option>
                                      <option value="LR">Liberia</option>
                                      <option value="LI">Liechtenstein</option>
                                      <option value="LT">Lithuania</option>
                                      <option value="LU">Luxembourg</option>
                                      <option value="MO">Macao</option>
                                      <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                      <option value="MG">Madagascar</option>
                                      <option value="MW">Malawi</option>
                                      <option value="MY">Malaysia</option>
                                      <option value="ML">Mali</option>
                                      <option value="MT">Malta</option>
                                      <option value="MH">Marshall Islands</option>
                                      <option value="MQ">Martinique</option>
                                      <option value="MR">Mauritania</option>
                                      <option value="MU">Mauritius</option>
                                      <option value="YT">Mayotte</option>
                                      <option value="MX">Mexico</option>
                                      <option value="FM">Micronesia, Federated States of</option>
                                      <option value="MD">Moldova, Republic of</option>
                                      <option value="MC">Monaco</option>
                                      <!-- <option value="MN">Mongolia</option> -->
                                      <option value="ME">Montenegro</option>
                                      <option value="MS">Montserrat</option>
                                      <option value="MA">Morocco</option>
                                      <option value="MZ">Mozambique</option>
                                      <option value="NA">Namibia</option>
                                      <option value="NR">Nauru</option>
                                      <option value="NP">Nepal</option>
                                      <option value="NL">Netherlands</option>
                                      <option value="NC">New Caledonia</option>
                                      <option value="NZ">New Zealand</option>
                                      <option value="NE">Niger</option>
                                      <option value="NU">Niue</option>
                                      <option value="NF">Norfolk Island</option>
                                      <option value="MP">Northern Mariana Islands</option>
                                      <option value="NO">Norway</option>
                                      <option value="OM">Oman</option>
                                      <option value="PW">Palau</option>
                                      <option value="PS">Palestinian Territory, Occupied</option>
                                      <option value="PY">Paraguay</option>
                                      <option value="PE">Peru</option>
                                      <option value="PH">Philippines</option>
                                      <option value="PN">Pitcairn</option>
                                      <option value="PL">Poland</option>
                                      <option value="PT">Portugal</option>
                                      <option value="QA">Qatar</option>
                                      <option value="RE">Réunion</option>
                                      <option value="RO">Romania</option>
                                      <!-- <option value="RU">Russian Federation</option> -->
                                      <option value="RW">Rwanda</option>
                                      <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                      <option value="KN">Saint Kitts and Nevis</option>
                                      <option value="LC">Saint Lucia</option>
                                      <option value="MF">Saint Martin (French part)</option>
                                      <option value="PM">Saint Pierre and Miquelon</option>
                                      <option value="VC">Saint Vincent and the Grenadines</option>
                                      <option value="WS">Samoa</option>
                                      <option value="SM">San Marino</option>
                                      <option value="ST">Sao Tome and Principe</option>
                                      <option value="SA">Saudi Arabia</option>
                                      <option value="SN">Senegal</option>
                                      <option value="SC">Seychelles</option>
                                      <option value="SG">Singapore</option>
                                      <option value="SX">Sint Maarten (Dutch part)</option>
                                      <option value="SK">Slovakia</option>
                                      <option value="SI">Slovenia</option>
                                      <option value="SB">Solomon Islands</option>
                                      <option value="ZA">South Africa</option>
                                      <option value="GS">South Georgia and the South Sandwich Islands</option>
                                      <option value="ES">Spain</option>
                                      <option value="SJ">Svalbard and Jan Mayen</option>
                                      <option value="SZ">Swaziland</option>
                                      <option value="SE">Sweden</option>
                                      <option value="CH">Switzerland</option>
                                      <option value="SY">Syrian Arab Republic</option>
                                      <!-- <option value="TJ">Tajikistan</option> -->
                                      <option value="TZ">Tanzania, United Republic of</option>
                                      <option value="TH">Thailand</option>
                                      <option value="TG">Togo</option>
                                      <option value="TK">Tokelau</option>
                                      <option value="TO">Tonga</option>
                                      <!-- <option value="TM">Turkmenistan</option> -->
                                      <option value="TC">Turks and Caicos Islands</option>
                                      <option value="TV">Tuvalu</option>
                                      <!-- <option value="UA">Ukraine</option> -->
                                      <option value="AE">United Arab Emirates</option>
                                      <option value="GB">United Kingdom</option>
                                      <option value="UY">Uruguay</option>
                                      <!-- <option value="UZ">Uzbekistan</option> -->
                                      <option value="VE">Venezuela</option>
                                      <option value="VN">Viet Nam</option>
                                      <option value="VG">Virgin Islands, British</option>
                                      <option value="VI">Virgin Islands, U.S.</option>
                                      <option value="WF">Wallis and Futuna</option>
                                      <option value="EH">Western Sahara</option>
                                      <option value="ZM">Zambia</option>
                                  </select>

                                  <p hidden id="NS" name="NS">Level: </p>
                                  <input id="NewValueCountry" type="hidden" name="NewValueCountry">
                        <script type="text/javascript">
                          function changeLevel(){
                          var level;

                        if(document.getElementById("social").value == "AL"){ level = '2';}
                        if(document.getElementById("social").value == "DZ"){ level = '3';}
                        if(document.getElementById("social").value == "AS"){ level = '4';}
                        if(document.getElementById("social").value == "AD"){ level = '5';}
                        if(document.getElementById("social").value == "AO"){ level = '6';}
                        if(document.getElementById("social").value == "AI"){ level = '7';}
                        if(document.getElementById("social").value == "AQ"){ level = '8';}
                        if(document.getElementById("social").value == "AG"){ level = '9';}
                        if(document.getElementById("social").value == "AR"){ level = '10';}
                        if(document.getElementById("social").value == "AM"){ level = '11';}
                        if(document.getElementById("social").value == "AW"){ level = '12';}
                        if(document.getElementById("social").value == "AU"){ level = '13';}
                        if(document.getElementById("social").value == "AT"){ level = '14';}
                        if(document.getElementById("social").value == "AZ"){ level = '15';}
                        if(document.getElementById("social").value == "BS"){ level = '16';}
                        if(document.getElementById("social").value == "BH"){ level = '17';}
                        if(document.getElementById("social").value == "BB"){ level = '19';}
                        if(document.getElementById("social").value == "BY"){ level = '20';}
                        if(document.getElementById("social").value == "BZ"){ level = '22';}
                        if(document.getElementById("social").value == "BJ"){ level = '23';}
                        if(document.getElementById("social").value == "BM"){ level = '24';}
                        if(document.getElementById("social").value == "BT"){ level = '25';}
                        if(document.getElementById("social").value == "BO"){ level = '26';}
                        if(document.getElementById("social").value == "BW"){ level = '28';}
                        if(document.getElementById("social").value == "BV"){ level = '29';}
                        if(document.getElementById("social").value == "BR"){ level = '30';}
                        if(document.getElementById("social").value == "IO"){ level = '31';}
                        if(document.getElementById("social").value == "BN"){ level = '32';}
                        if(document.getElementById("social").value == "BG"){ level = '33';}
                        if(document.getElementById("social").value == "BF"){ level = '34';}
                        if(document.getElementById("social").value == "KH"){ level = '36';}
                        if(document.getElementById("social").value == "CM"){ level = '37';}
                        if(document.getElementById("social").value == "CV"){ level = '39';}
                        if(document.getElementById("social").value == "KY"){ level = '40';}
                        if(document.getElementById("social").value == "TD"){ level = '42';}
                        if(document.getElementById("social").value == "CL"){ level = '43';}
                        if(document.getElementById("social").value == "CN"){ level = '44';}
                        if(document.getElementById("social").value == "CX"){ level = '45';}
                        if(document.getElementById("social").value == "CC"){ level = '47';}
                        if(document.getElementById("social").value == "CO"){ level = '48';}
                        if(document.getElementById("social").value == "KM"){ level = '49';}
                        if(document.getElementById("social").value == "CK"){ level = '50';}
                        if(document.getElementById("social").value == "CR"){ level = '51';}
                        if(document.getElementById("social").value == "HR"){ level = '52';}
                        if(document.getElementById("social").value == "CU"){ level = '53';}
                        if(document.getElementById("social").value == "CY"){ level = '54';}
                        if(document.getElementById("social").value == "CZ"){ level = '55';}
                        if(document.getElementById("social").value == "DK"){ level = '56';}
                        if(document.getElementById("social").value == "DJ"){ level = '57';}
                        if(document.getElementById("social").value == "DM"){ level = '58';}
                        if(document.getElementById("social").value == "DO"){ level = '59';}
                        if(document.getElementById("social").value == "EC"){ level = '61';}
                        if(document.getElementById("social").value == "EG"){ level = '62';}
                        if(document.getElementById("social").value == "SV"){ level = '63';}
                        if(document.getElementById("social").value == "GQ"){ level = '64';}
                        if(document.getElementById("social").value == "EE"){ level = '66';}
                        if(document.getElementById("social").value == "FK"){ level = '68';}
                        if(document.getElementById("social").value == "FO"){ level = '69';}
                        if(document.getElementById("social").value == "FJ"){ level = '70';}
                        if(document.getElementById("social").value == "FI"){ level = '71';}
                        if(document.getElementById("social").value == "FR"){ level = '72';}
                        if(document.getElementById("social").value == "GF"){ level = '73';}
                        if(document.getElementById("social").value == "PF"){ level = '74';}
                        if(document.getElementById("social").value == "TF"){ level = '75';}
                        if(document.getElementById("social").value == "GA"){ level = '76';}
                        if(document.getElementById("social").value == "GM"){ level = '77';}
                        if(document.getElementById("social").value == "GE"){ level = '78';}
                        if(document.getElementById("social").value == "DE"){ level = '79';}
                        if(document.getElementById("social").value == "GH"){ level = '80';}
                        if(document.getElementById("social").value == "GI"){ level = '81';}
                        if(document.getElementById("social").value == "GR"){ level = '82';}
                        if(document.getElementById("social").value == "GL"){ level = '83';}
                        if(document.getElementById("social").value == "GD"){ level = '84';}
                        if(document.getElementById("social").value == "GP"){ level = '85';}
                        if(document.getElementById("social").value == "GU"){ level = '86';}
                        if(document.getElementById("social").value == "GT"){ level = '87';}
                        if(document.getElementById("social").value == "GN"){ level = '88';}
                        if(document.getElementById("social").value == "GW"){ level = '89';}
                        if(document.getElementById("social").value == "HM"){ level = '92';}
                        if(document.getElementById("social").value == "HN"){ level = '93';}
                        if(document.getElementById("social").value == "HK"){ level = '94';}
                        if(document.getElementById("social").value == "HU"){ level = '95';}
                        if(document.getElementById("social").value == "IS"){ level = '96';}
                        if(document.getElementById("social").value == "ID"){ level = '98';}
                        if(document.getElementById("social").value == "IT"){ level = '103';}
                        if(document.getElementById("social").value == "JM"){ level = '104';}
                        if(document.getElementById("social").value == "JO"){ level = '106';}
                        if(document.getElementById("social").value == "KZ"){ level = '107';}
                        if(document.getElementById("social").value == "KE"){ level = '108';}
                        if(document.getElementById("social").value == "KI"){ level = '109';}
                        if(document.getElementById("social").value == "KW"){ level = '112';}
                        if(document.getElementById("social").value == "KG"){ level = '113';}
                        if(document.getElementById("social").value == "LV"){ level = '115';}
                        if(document.getElementById("social").value == "LS"){ level = '117';}
                        if(document.getElementById("social").value == "LR"){ level = '118';}
                        if(document.getElementById("social").value == "LI"){ level = '120';}
                        if(document.getElementById("social").value == "LT"){ level = '121';}
                        if(document.getElementById("social").value == "LU"){ level = '122';}
                        if(document.getElementById("social").value == "MO"){ level = '123';}
                        if(document.getElementById("social").value == "MK"){ level = '124';}
                        if(document.getElementById("social").value == "MG"){ level = '125';}
                        if(document.getElementById("social").value == "MW"){ level = '126';}
                        if(document.getElementById("social").value == "MY"){ level = '127';}
                        if(document.getElementById("social").value == "ML"){ level = '128';}
                        if(document.getElementById("social").value == "MT"){ level = '129';}
                        if(document.getElementById("social").value == "MH"){ level = '130';}
                        if(document.getElementById("social").value == "MQ"){ level = '131';}
                        if(document.getElementById("social").value == "MR"){ level = '132';}
                        if(document.getElementById("social").value == "MU"){ level = '133';}
                        if(document.getElementById("social").value == "YT"){ level = '134';}
                        if(document.getElementById("social").value == "MX"){ level = '135';}
                        if(document.getElementById("social").value == "FM"){ level = '136';}
                        if(document.getElementById("social").value == "MD"){ level = '137';}
                        if(document.getElementById("social").value == "MC"){ level = '138';}
                        if(document.getElementById("social").value == "MN"){ level = '139';}
                        if(document.getElementById("social").value == "ME"){ level = '140';}
                        if(document.getElementById("social").value == "MS"){ level = '141';}
                        if(document.getElementById("social").value == "MA"){ level = '142';}
                        if(document.getElementById("social").value == "MZ"){ level = '143';}
                        if(document.getElementById("social").value == "NA"){ level = '145';}
                        if(document.getElementById("social").value == "NR"){ level = '146';}
                        if(document.getElementById("social").value == "NP"){ level = '147';}
                        if(document.getElementById("social").value == "NL"){ level = '148';}
                        if(document.getElementById("social").value == "NC"){ level = '150';}
                        if(document.getElementById("social").value == "NZ"){ level = '151';}
                        if(document.getElementById("social").value == "NE"){ level = '153';}
                        if(document.getElementById("social").value == "NU"){ level = '154';}
                        if(document.getElementById("social").value == "NF"){ level = '155';}
                        if(document.getElementById("social").value == "MP"){ level = '156';}
                        if(document.getElementById("social").value == "NO"){ level = '157';}
                        if(document.getElementById("social").value == "OM"){ level = '158';}
                        if(document.getElementById("social").value == "PW"){ level = '160';}
                        if(document.getElementById("social").value == "PS"){ level = '161';}
                        if(document.getElementById("social").value == "PY"){ level = '164';}
                        if(document.getElementById("social").value == "PE"){ level = '165';}
                        if(document.getElementById("social").value == "PH"){ level = '166';}
                        if(document.getElementById("social").value == "PN"){ level = '167';}
                        if(document.getElementById("social").value == "PL"){ level = '168';}
                        if(document.getElementById("social").value == "PT"){ level = '169';}
                        if(document.getElementById("social").value == "QA"){ level = '171';}
                        if(document.getElementById("social").value == "RE"){ level = '172';}
                        if(document.getElementById("social").value == "RO"){ level = '173';}
                        if(document.getElementById("social").value == "RU"){ level = '174';}
                        if(document.getElementById("social").value == "RW"){ level = '175';}
                        if(document.getElementById("social").value == "SH"){ level = '176';}
                        if(document.getElementById("social").value == "KN"){ level = '177';}
                        if(document.getElementById("social").value == "LC"){ level = '178';}
                        if(document.getElementById("social").value == "MF"){ level = '242';}
                        if(document.getElementById("social").value == "PM"){ level = '179';}
                        if(document.getElementById("social").value == "VC"){ level = '180';}
                        if(document.getElementById("social").value == "WS"){ level = '181';}
                        if(document.getElementById("social").value == "SM"){ level = '182';}
                        if(document.getElementById("social").value == "ST"){ level = '183';}
                        if(document.getElementById("social").value == "SA"){ level = '184';}
                        if(document.getElementById("social").value == "SN"){ level = '185';}
                        if(document.getElementById("social").value == "SC"){ level = '187';}
                        if(document.getElementById("social").value == "SG"){ level = '189';}
                        if(document.getElementById("social").value == "VE"){ level = '224';}
                        if(document.getElementById("social").value == "SX"){ level = '243';}
                        if(document.getElementById("social").value == "SK"){ level = '190';}
                        if(document.getElementById("social").value == "SI"){ level = '191';}
                        if(document.getElementById("social").value == "SB"){ level = '192';}
                        if(document.getElementById("social").value == "ZA"){ level = '193';}
                        if(document.getElementById("social").value == "GS"){ level = '194';}
                        if(document.getElementById("social").value == "ES"){ level = '195';}
                        if(document.getElementById("social").value == "SJ"){ level = '199';}
                        if(document.getElementById("social").value == "SZ"){ level = '200';}
                        if(document.getElementById("social").value == "SE"){ level = '201';}
                        if(document.getElementById("social").value == "CH"){ level = '202';}
                        if(document.getElementById("social").value == "SY"){ level = '203';}
                        if(document.getElementById("social").value == "TJ"){ level = '204';}
                        if(document.getElementById("social").value == "TZ"){ level = '206';}
                        if(document.getElementById("social").value == "TH"){ level = '207';}
                        if(document.getElementById("social").value == "TG"){ level = '208';}
                        if(document.getElementById("social").value == "TK"){ level = '209';}
                        if(document.getElementById("social").value == "TO"){ level = '210';}
                        if(document.getElementById("social").value == "TM"){ level = '214';}
                        if(document.getElementById("social").value == "TC"){ level = '215';}
                        if(document.getElementById("social").value == "TV"){ level = '216';}
                        if(document.getElementById("social").value == "UA"){ level = '218';}
                        if(document.getElementById("social").value == "AE"){ level = '219';}
                        if(document.getElementById("social").value == "GB"){ level = '220';}
                        if(document.getElementById("social").value == "UY"){ level = '221';}
                        if(document.getElementById("social").value == "UZ"){ level = '222';}
                        if(document.getElementById("social").value == "VN"){ level = '225';}
                        if(document.getElementById("social").value == "VG"){ level = '226';}
                        if(document.getElementById("social").value == "VI"){ level = '227';}
                        if(document.getElementById("social").value == "WF"){ level = '228';}
                        if(document.getElementById("social").value == "EH"){ level = '229';}
                        if(document.getElementById("social").value == "ZM"){ level = '231';}
  //document.getElementById("NS").innerHTML=("Level: " +level);
  //document.getElementById("NewValueCountry").value = level;

  document.getElementById("NS").innerHTML=("Level: " +level);
  document.getElementById("NewValueCountry").value = level;
}
changeLevel();
</script>
                                </div>
                            </div>





<style type="text/css">
  /* Disclaimer */
  input.abc  {
    width: 18px !important;
    height: 18px !important;
  }

  .abc, label input[type=checkbox] {
     position:absolute !important;
     top:-2px !important;
     left:0px !important;  
}



input[type="checkbox"] { position: absolute; opacity: 0; z-index: -1; }
/*input[type="checkbox"]+span.tyc { font: 16pt sans-serif; color: #000; }*/

input[type="checkbox"]+span.tyc:before { font: 16pt FontAwesome; content: '\00f096'; display: inline-block; width: 16pt; padding: 2px 2px 0 3px; margin-right: 0.5em; margin-left: -29px; color: #ccc; font-weight: 100;}

input[type="checkbox"]:checked+span.tyc:before {
    content: '\00f046';
    color: #2cc482;
}

input[type="checkbox"]:focus+span.tyc:before { outline: 1px #aaa; }
input[type="checkbox"]:disabled+span.tyc { color: #999; }
input[type="checkbox"]:disabled+span.tyc { border-color: red; border-style: solid; }
/* input[type="checkbox"]:not(:disabled)+span.tyc:hover:before { text-shadow: 0 1px 2px #77F; } */



</style>

                           <!--  <div class="col-md-12">                              
                                <div class="form-group">
                                    <label for="Tell_us_what_you_like_to_trade__c" style="color: #b1b1b1 !important; font-weight: 600 !important; font-size: 13px !important;">Tell us what you like to trade...</label>
                                    <input id="Tell_us_what_you_like_to_trade__c" type="text" name="Tell_us_what_you_like_to_trade__c" class="form-control" placeholder="Example: Forex, Metals, Cryptocurrencies..." required="required" data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div> -->

                            <div class="col-md-12" style="padding-right: 15px;">  
                            <label for="first_name" class="font-safari" style="color: #b1b1b1 !important; font-weight: 600 !important; font-size: 13px !important;">Tell us what you like to trade...</label>
                            <select class="js-example-basic-multiple2" id="Trading_Product__c" name="Trading_Product__c[]" multiple="multiple" required>
                                <!-- <option></option>
 -->                                <option value="Forex">Forex</option>
                                <option value="Metals">Metals</option>
                                <option value="Oil">Oil</option>
                                <option value="Indices">Indices</option>
                                <option value="Stocks">Stocks</option>
                                <option value="Cryptos">Cryptos</option>
                                <option value="Binary Options">Options</option>                               
                            </select>
                          </div> 

                          <script type="text/javascript">
                            $(document).ready(function() {
                              $('.js-example-basic-multiple2').select2();


                          $('#Trading_Product__c').select2({
                             placeholder: "    Select all that apply..."
                          });

                          $('#Trading_experience__c').select2({
                              placeholder: "    Select one..."
                          });



                          $('Trading_Product__c').select2({
                                minimumResultsForSearch: -1
                            });


                          });
                          </script> 


                    <div class="col-md-12" style="margin-top:10px; margin-bottom: 10px;">  
                    </div>
                                                
           
<style type="text/css">
  @media screen and (min-color-index:0) and(-webkit-min-device-pixel-ratio:0)
{ @media {
    /*   
      Define here the CSS styles applied only to Safari browsers
      (any version and any device)
     */
     .font-safari{
      font-size: 12px !important;
     }
}}
</style>


                          <div class="col-md-6" style="padding-right: 5px;">  
                            <label for="first_name" class="font-safari" style="color: #b1b1b1 !important; font-weight: 600 !important; width: 100% !important; font-size: 13px !important;">What are your favorite pairs...</label>
                            <select class="js-example-basic-multiple" id="What_are_your_favorite_pairs__c" name="What_are_your_favorite_pairs__c[]" multiple="multiple" required>
                                <option></option>
                                <option value="EUR/USD">EUR/USD</option>
                                <option value="USD/JPY">USD/JPY</option>
                                <option value="GBP/USD">GBP/USD</option>
                                <option value="AUD/USD">AUD/USD</option>
                                <option value="USD/CHF">USD/CHF</option>
                                <option value="NZD/USD">NZD/USD</option>
                                <option value="USD/CAD">USD/CAD</option>
                                <option value="GOLD">GOLD</option>
                                <option value="BTC">BTC</option>
                                <option value="Other">Other</option> 
                            </select>
                          </div> 

                          <script type="text/javascript">
                            $(document).ready(function() {
                              $('.js-example-basic-multiple').select2();


                          $('#What_are_your_favorite_pairs__c').select2({
                              placeholder: "    Select all that apply..."
                          });

                          $('#Trading_experience__c').select2({
                              placeholder: "    Select one..."
                          });



                          $('What_are_your_favorite_pairs__c').select2({
                                minimumResultsForSearch: -1
                            });


                          });
                          </script>   

                          <style type="text/css">
                            .select2-selection__choice{
                              float: none !important;
                              display: inline-block !important;        
                            }

                            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                              color: #ffffff;
                              cursor: pointer;
                              display: inline-block;
                              font-weight: bold;
                              margin-right: 2px;
                          }

                          .select2-container--default .select2-selection--multiple .select2-selection__choice {
                              /* background-color: #2cc482; */
                              background-color: #ffffff;
                              border: 1px solid #ffffff;    
                              margin-top: 17px !important;
                              margin-right: 0px !important;
                              padding: 0 0px;
                              }

                          .select2-container--default .select2-selection--multiple .select2-selection__rendered {
                              box-sizing: border-box;
                              list-style: none;
                              margin: -5px;
                              padding: 1px 5px;
                              width: 100%;    
                          }


                          .select2-container--default .select2-selection--multiple{     
                              height: 50px;
                          }


                          .js-example-basic-multiple{
                            width: 100% !important;
                          }

                          .js-example-basic-multiple2{
                            width: 100% !important;
                          }



                          .select2-container--default.select2-container--focus .select2-selection--multiple {
                              border: solid #ccc 1px;
                              outline: 0;
                              height: 50px;
                          }


                          .select2-dropdown--below {
                             /* top: 50px; */
                          }

                          .select2-search .select2-search--inline {
                            display: none !important;
                          }


                          /* pipeline transparent */
                          .select2-container .select2-search--inline {
                              float: left;
                              /* display: block;*/ 
                              color: transparent;
                          }


/*.select2 .select2-container .select2-container--default .select2-container--below .select2-container--focus .select2-container--open    {
  width: 205.344px !important;
}


.select2 .select2-container .select2-container--default .select2-container--below .select2-container--focus{
  width: 205.344px !important;
}




  .select2-container--default.select2-container--focus .select2-selection--multiple {
    border: 1px solid #ccc; 
    outline: 0;
    height: 50px !important;
    width: 200px !important;
  }   
*/
</style>   

                            <div class="col-md-6" style="padding-left: 5px;"> 
                              <label for="Trading_experience__c" style="color: #b1b1b1 !important; font-weight: 600 !important; font-size: 13px !important;">Trading experience</label>
                                <select id="Trading_experience__c" name="Trading_experience__c" class="form-control" style="height: 50px !important;" required>
                                <!-- <select class="social" id="social" name="social" style="width: 100%;" onchange='changeLevel()' required>
 -->                                  
                                  <option></option>
                                  <option value="Just starting">Just starting</option>
                                  <option value="Been at it awhile">Been at it awhile</option>
                                  <option value="Ready to turn pro">Ready to turn pro</option>
                                  <option value="Step aside Mr. Buffett">Step aside Mr. Buffett</option>
                                </select>
                            </div>  




                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="position:relative; padding-left:27px; padding-top: 15px; display:block; color: #515151; display: block; font-size: 11px; font-family: avenir-regular; font-weight: 500;"><input class="abc" type="checkbox" required="required"><span class="tyc" id="tc" style="display: flex;">By continuing I certify that I am 18 years of age, and I agree to the <a href="/legal-documents/" target="_blank">Terms and Conditions</a>, <a href="/legal-documents/" target="_blank">Privacy Policy</a>,<a href="/legal-documents/" target="_blank"> PDS</a> and <a href="/legal-documents/" target="_blank">FSG.</a></span></label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


<style type="text/css">
 

  #tc a{
    color: rgb(22, 82, 240) !important;
    display: contents !important;
  }

</style>

            
                           
                            <div class="col-md-12">
                             

                                <input style="color: #fff; font-family: avenir-regular; font-weight: 500; font-size: 17px; border-radius: 8px !important" type="submit" name="submit" class="btn btn-primary btn-send" value="DEMO">


                               
                               
                                <!-- <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 17px;  border-radius: 8px !important" type="submit" name="submit" class="btn btn-success btn-send" onclick="location.href='https://clmmultisites.wpengine.comlive';" value="LIVE">  -->

                                <!-- <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 17px;  border-radius: 8px !important" type="submit" name="submit" class="btn btn-success btn-send" onclick="passvalues();" formaction="https://clmmultisites.wpengine.comlive" value="LIVE">    -->
                                <?php
                                if (isset($_POST['submitL'])) {
                                      // Starts send email
                                    $to = "accounts@clmforex.com"; // this is your UserName address
                                    //$to = "danycan31416@gmail.com"; // this is your UserName address
                                    //$to = "support@clmforex.com"; // this is your UserName address    
                                    $lead_first_name = $_POST['lead-first-name'];
                                    $lead_last_name = $_POST['lead-last-name'];
                                    $from = $_POST['lead-email']; // this is the sender's UserName address
                                    $country = $_POST['social'];



                                    $subject = "Form EN [Pass from demo to live account]";
                                   
                                    // Concat first & last name
                                    $message = $lead_first_name.' '.$lead_last_name . "  starts with the following data:"

                                    //. "\n\n" . "Full name: " . $_POST['individual-first-name']

                                    // Concat first & last name
                                    . "\n\n" . "Full name: " . $_POST['lead-first-name'].' '.$_POST['lead-last-name']  
                                    . "\n\n" . "Email: " . $_POST['lead-email']
                                    . "\n\n" . "Country: " . $_POST['social'];


                                    $headers = "From:" . $from;
                                    // Send copy
                                    //$headers2 = "From:" . $to;
                                    mail($to,$subject,$message,$headers);

                                    //delete
                                    //header('Location: /live-account-application'); // to redirect to another page.  

                                    header( "refresh:1; url=/live-account-application" );

                                // Ends send email */
                                 

                                  }
                                ?>

                                <!-- no send email  -->
                                <!-- <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 17px;  border-radius: 8px !important" type="submit" name="submit" class="btn btn-success btn-send" onclick="passvalues();" formaction="/live-account-application" value="LIVE">    -->
                               
                                <!-- To send email -->                                
                                <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 17px;  border-radius: 8px !important" type="submit" name="submitL" class="btn btn-success btn-send" onclick="passvalues();" value="LIVE">

                                <!-- <input type="submit" value="Click" onclick="passvalues();" formaction="https://clmmultisites.wpengine.comlive"/>  -->

                            </div>
                            <!-- Retrieve data from home & platfoms in email inputs  -->
                            <script type="text/javascript">
                              document.getElementById("lead-email").value=localStorage.getItem("VEmail");
                            </script>

          </div>  
          </div>                  
      </form>
<br/>
<center>
<p style="font-family: avenir-regular; font-size: 22px; font-weight: normal; color: #ffffff;"><a style="color: #ffffff !important;" href="/sign-in">Already have an account? <u>Sign in</u></a></p>
</center>

<!-- <div class="elementor-widget-container">
      <p style="font-family: avenir-regular; font-size: 22px; font-weight: normal; color: #ffffff;"><a href="/sign-in">Already have an account? <u>Log in</u></a></p>   </div>
 -->
<p></p><p></p><p></p>
<div class="spacer">
 
</div>




</body>
</html>