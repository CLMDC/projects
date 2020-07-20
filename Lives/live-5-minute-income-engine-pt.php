<?PHP
// PDF Library
//require('fpd/fpdf.php');
//include_once('/wp-content/uploads/legal-documents/pdf-form/fpd/fpdf.php');
include_once('wp-content/uploads/legal-documents/pdf-form/fpd/fpdf.php');

// PHPMailer
//require 'PHPMailer-master/vendor/autoload.php';
//include_once '/wp-content/uploads/legal-documents/pdf-form/PHPMailer-master/vendor/autoload.php';
include_once 'wp-content/uploads/legal-documents/pdf-form/PHPMailer-master/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/* Get date from Webserver */
date_default_timezone_set('Africa/Addis_Ababa');
$Application_Date__c = date('m/d/Y');
//echo $Application_Date__c . "<br>";


//////////////////////////////////////////////////////////////////////////////////
/* Setting for get url parameters for Referrals Urls */
$query_string = $_SERVER['QUERY_STRING'];
//parse_str( $query_string, $query_vars );
parse_url( $query_string );

// link_id | This avoid the Notice: Undefined index:
if (isset($_GET['link_id'])) {
    $link_id = $_GET['link_id'];
}else{
    $link_id = "";
}
//echo $link_id;


//echo '<br/>';
//echo '<br/>';

// referral_id | This avoid the Notice: Undefined index:
if (isset($_GET['referral_id'])) {
    $referral_id = $_GET['referral_id'];
}else{
    $referral_id = "";
}
//echo $referral_id;
//////////////////////////////////////////////////////////////////////////////////



if(isset($_POST['submit2'])) {



/* ------------------- Start Current Business, data creation ------------------- */
$url = 'https://api.pro.we.01.currentdesk.com:444/registration/client/individual';

    $What_product_do_you_tradeCB = $_POST['Trading_Product__c'];
    $What_product_do_you_tradeST = implode(", ",$What_product_do_you_tradeCB);

$data = array(

    'account-language-id' => 43,  // 1 -> English | 43 -> Portuguese | 50 -> Spanish
    'account-code-id' => 2,  
    'account-emir-id' => 1,
    'financial-annual-income-id' => 312,
    'financial-liquid-assets-id' => 89,
    'financial-investment-objective-id' => 7,
    'trading-style-id' => 2,
    'bank-code-id' => 77,
    'trading-spot-experience-id' => 6,
    'trading-options-experience-id' => 6,
    'trading-shares-experience-id' => 6,
    'trading-futures-experience-id' => 6,
    'trading-futures-experience-source-id' => 1,
    'trading-options-experience-source-id' => 1,
    'trading-shares-experience-source-id' => 1,
    'trading-spot-experience-source-id' => 1,
    'individual-email' => $_POST['UserName'], 
    'individual-address-months' => 1,
    'financial-funds-source-id' => 4,
    'individual-title-id' => $_POST['individual-title-id'], 
    'individual-identification-type-id' => 209,
    'individual-employment-status-id' => 1,
    'individual-birth-date' => $_POST['txtFullDate'], 

    
    'individual-income-source-id' => 1,



    'account-password' => $_POST['Password'], 
    'account-phone-id' => '0000-0000',
    'account-trading-platform-id' => 1,
    'account-preference-id' => $_POST['account-type'], //119-> Standard 121->ECN
    'account-currency-id' => $_POST['base-currency'],  
    'individual-first-name' => $_POST['individual-first-name'], 
    'individual-last-name' => $_POST['individual-last-name'], 
    'individual-address' => '-----',
    'individual-address-city' => '-----',
    'individual-address-postal-code' => '-----',
    'individual-telephone' => $_POST['phone'],   
    //'individual-mobile' => $_POST['whatsapp'],
    'individual-mobile' => $_POST['phone'],
    //'custom-parameter-value-01' => $_POST['product_to_trade'],
    'custom-parameter-value-01' => $What_product_do_you_tradeST,
    'custom-parameter-value-02' => $_POST['who_referred_you'],
    'individual-identification-number' => 0,
    'individual-employment-industry' => 0,
    'individual-occupation' => 0,
    'individual-citizenship-country-id' => $_POST['NewValueCountry'], //country ip
    'individual-residence-country-id' => $_POST['NewValueCountry'], //country ip
    'individual-residence-country-id' => $_POST['NewValueCountry'], //country ip
    'individual-address-country-id' => $_POST['NewValueCountry'], //country ip
    // Gender
    'individual-gender-id' => $_POST['00N1Y00000Iqm89'],
    // Links for Partnerships Url's
    'marketing-referral-id' => $_POST['referral_id'],
    'marketing-link-id' => $_POST['link_id'],
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

 //curl_close($ch);
 //print_r ($result);


$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

/* ------------------- Ends Current Business, data creation ------------------- */

//print_r($response);


if ($statusCode == 200) {


/* ------------------- Start data of SF ------------------- */    

$oid = "00Di0000000cOee";

$GenderBSF = $_POST['00N1Y00000Iqm89'];

$TitleBSF = $_POST['individual-title-id'];


//$GenderB = $_POST['00N1Y00000Iqm89'];

  if( $GenderBSF == '0' ) $GenderSF = 'Female';
  if( $GenderBSF == '1' ) $GenderSF = 'Male';
$GenderSF = $GenderSF;


$TitleBSF = $_POST['individual-title-id'];

  if( $TitleBSF == '1' ) $TitleSF = 'Mr.';
  if( $TitleBSF == '2' ) $TitleSF = 'Mrs.';
  if( $TitleBSF == '3' ) $TitleSF = 'Miss';
  if( $TitleBSF == '4' ) $TitleSF = 'Ms.';
  if( $TitleBSF == '5' ) $TitleSF = 'Dr.';
  if( $TitleBSF == '6' ) $TitleSF = 'Prof.';

$TitleSF = $TitleSF;

//$post_data['retURL'] = 'https://www.clmforex.com/demo-account-thank-you';

//create array of data to be posted
$post_data['oid'] = $oid;

$post_data['Gender__c'] = $GenderSF;
$post_data['salutation'] = $TitleSF;

$post_data['first_name'] = trim($_POST['individual-first-name']);
$post_data['last_name'] = trim($_POST['individual-last-name']);
$post_data['country'] = trim($_POST['social']);

$post_data['phone'] = trim($_POST['phone']);

// WhatsApp in SF
//$post_data['00N1Y00000I53gA'] = trim('00N1Y00000I53gA');
//$post_data['00N1Y00000I53gA'] = trim($_POST['whatsapp']);


// Gender in SF
//$post_data['00N1Y00000Iqm89'] = trim('00N1Y00000Iqm89');


$post_data['email'] = trim($_POST['UserName']);
//$post_data['pwd'] = trim($_POST['pwd']);
//$post_data['amount'] = trim($_POST['amount']);
//$post_data['amount'] = trim(81);

//$post_data['leverage'] = trim($_POST['leverage']);
//$post_data['group'] = trim($_POST['group']);
$post_data['Preferred_Language__c'] = trim($_POST['Preferred_Language__c']);

$post_data['Application_Date__c'] = $Application_Date__c;


// Trading_Product__c ->
if(isset($_POST['Trading_Product__c'])){ // select_name will be replaced with your input filed name
  $post_dataM = $_POST['Trading_Product__c']; // select_name will be replaced with your input filed name
  $selectedOption = "";
  foreach ($post_dataM as $option => $value) {
    $selectedOption .= $value.';'; // I am separating Values with a comma (,) so that I can extract data using explode()
  }
  }

$money = $selectedOption;

//create array of data to be posted
$post_data['Trading_Product__c'] = $money;


$post_data['lead_source'] = trim($_POST['lead_source']);
$post_data['Sales_Representative__c'] = trim($_POST['Sales_Representative__c']);
//$post_data['retURL'] = 'https://www.clmforex.com/demo-account-thank-you';
//$post_data['00N90000009SXUs'] = trim($_POST['abn_acn']);   // CUSTOM FIELDS IN LEAD OBJECT
 
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

/* ------------------- End data of SF ------------------- */  


/* ------------------- Starts send email in PDF ------------------- */



// Form parameters
$Email_reply = 'coreliquiditymarkets.clm@gmail.com';

$TitleB = $_POST['individual-title-id'];

  if( $TitleB == '1' ) $Title = 'Sr.';
  if( $TitleB == '2' ) $Title = 'Sra.';
  if( $TitleB == '3' ) $Title = 'Srta.';
  if( $TitleB == '5' ) $Title = 'Dr.';
  if( $TitleB == '6' ) $Title = 'Prof.';

$Title = $Title;
//$Title = $_POST['individual-title-id'];

$First_name = $_POST['individual-first-name'];
$Last_name = $_POST['individual-last-name'];
$Email_address = $_POST['UserName'];
$Password = $_POST['Password'];
$countryB = $_POST['social'];

if( $countryB == 'AF' ) $country = 'Afghanistan';
if( $countryB == 'AL' ) $country = 'Albania';
if( $countryB == 'DZ' ) $country = 'Algeria';
if( $countryB == 'AS' ) $country = 'American Samoa';
if( $countryB == 'AD' ) $country = 'Andorra';
if( $countryB == 'AO' ) $country = 'Angola';
if( $countryB == 'AI' ) $country = 'Anguilla';
if( $countryB == 'AQ' ) $country = 'Antarctica';
if( $countryB == 'AG' ) $country = 'Antigua and Barbuda';
if( $countryB == 'AR' ) $country = 'Argentina';
if( $countryB == 'AM' ) $country = 'Armenia';
if( $countryB == 'AW' ) $country = 'Aruba';
if( $countryB == 'AU' ) $country = 'Australia';
if( $countryB == 'AT' ) $country = 'Austria';
if( $countryB == 'AZ' ) $country = 'Azerbaijan';
if( $countryB == 'BS' ) $country = 'Bahamas';
if( $countryB == 'BH' ) $country = 'Bahrain';
if( $countryB == 'BD' ) $country = 'Bangladesh';
if( $countryB == 'BB' ) $country = 'Barbados';
if( $countryB == 'BY' ) $country = 'Belarus';
if( $countryB == 'BE' ) $country = 'Belgium';
if( $countryB == 'BZ' ) $country = 'Belize';
if( $countryB == 'BJ' ) $country = 'Benine';
if( $countryB == 'BM' ) $country = 'Bermuda';
if( $countryB == 'BT' ) $country = 'Bhutan';
if( $countryB == 'BO' ) $country = 'Bolivia';
if( $countryB == 'BA' ) $country = 'Bosnia and Herzegovina';
if( $countryB == 'BW' ) $country = 'Botswana';
if( $countryB == 'AF' ) $country = 'Bouvet Island';
if( $countryB == 'BR' ) $country = 'Brazil';
if( $countryB == 'IO' ) $country = 'British Indian Ocean Territory';
if( $countryB == 'BN' ) $country = 'Brunei Darussalam';
if( $countryB == 'BG' ) $country = 'Bulgaria';
if( $countryB == 'BF' ) $country = 'Burkina';
if( $countryB == 'BI' ) $country = 'Burundi';
if( $countryB == 'KH' ) $country = 'Cambodia';
if( $countryB == 'CM' ) $country = 'Cameroon';
if( $countryB == 'CA' ) $country = 'Canada';
if( $countryB == 'CV' ) $country = 'Cape Verde';
if( $countryB == 'KY' ) $country = 'Cayman Islands';
if( $countryB == 'CF' ) $country = 'Central African Republic';
if( $countryB == 'TD' ) $country = 'Chad';
if( $countryB == 'CL' ) $country = 'Chile';
if( $countryB == 'CN' ) $country = 'China';
if( $countryB == 'CX' ) $country = 'Christmas Island';
if( $countryB == 'CI' ) $country = 'Côte';
if( $countryB == 'CC' ) $country = 'Cocos (Keeling) Islands';
if( $countryB == 'CO' ) $country = 'Colombia';
if( $countryB == 'KM' ) $country = 'Comoros';
if( $countryB == 'CK' ) $country = 'Cook Islands';
if( $countryB == 'CR' ) $country = 'Costa Rica';
if( $countryB == 'HR' ) $country = 'Croatia';
if( $countryB == 'CU' ) $country = 'Cuba';
if( $countryB == 'CY' ) $country = 'Cyprus';
if( $countryB == 'CZ' ) $country = 'Czech Republic';
if( $countryB == 'DK' ) $country = 'Denmark';
if( $countryB == 'DJ' ) $country = 'Djibouti';
if( $countryB == 'DM' ) $country = 'Dominica';
if( $countryB == 'DO' ) $country = 'Dominican Republic';
if( $countryB == 'TL' ) $country = 'East Timor';
if( $countryB == 'EC' ) $country = 'Ecuador';
if( $countryB == 'EG' ) $country = 'Egypt';
if( $countryB == 'SV' ) $country = 'El Salvador';
if( $countryB == 'GQ' ) $country = 'Equatorial Guinea';
if( $countryB == 'ER' ) $country = 'Eritrea';
if( $countryB == 'EE' ) $country = 'Estonia';
if( $countryB == 'ET' ) $country = 'Ethiopia';
if( $countryB == 'FK' ) $country = 'Falkland Islands (Malvinas)';
if( $countryB == 'FO' ) $country = 'Faroe Islands';
if( $countryB == 'FJ' ) $country = 'Fiji';
if( $countryB == 'FI' ) $country = 'Finland';
if( $countryB == 'FR' ) $country = 'France';
if( $countryB == 'GF' ) $country = 'French Guiana';
if( $countryB == 'PF' ) $country = 'French Polynesia';
if( $countryB == 'TF' ) $country = 'French Southern Territories';
if( $countryB == 'GA' ) $country = 'Gabon';
if( $countryB == 'GM' ) $country = 'Gambia';
if( $countryB == 'GE' ) $country = 'Georgia';
if( $countryB == 'DE' ) $country = 'Germany';
if( $countryB == 'GH' ) $country = 'Ghana';
if( $countryB == 'GI' ) $country = 'Gibraltar';
if( $countryB == 'GR' ) $country = 'Greece';
if( $countryB == 'GL' ) $country = 'Greenland';
if( $countryB == 'GD' ) $country = 'Grenada';
if( $countryB == 'GP' ) $country = 'Guadeloupe';
if( $countryB == 'GU' ) $country = 'Guam';
if( $countryB == 'GT' ) $country = 'Guatemala';
if( $countryB == 'GN' ) $country = 'Guinea';
if( $countryB == 'GW' ) $country = 'Guinea-Bissau';
if( $countryB == 'GY' ) $country = 'Guyana';
if( $countryB == 'HT' ) $country = 'Haiti';
if( $countryB == 'HM' ) $country = 'Heard Island and McDonald Islands';
if( $countryB == 'HN' ) $country = 'Honduras';
if( $countryB == 'HK' ) $country = 'Hong Kong';
if( $countryB == 'HU' ) $country = 'Hungary';
if( $countryB == 'IS' ) $country = 'Iceland';
if( $countryB == 'IN' ) $country = 'India';
if( $countryB == 'ID' ) $country = 'Indonesia';
if( $countryB == 'IR' ) $country = 'Iran, Islamic Republic of';
if( $countryB == 'IQ' ) $country = 'Iraq';
if( $countryB == 'IE' ) $country = 'Ireland';
if( $countryB == 'IL' ) $country = 'Israel';
if( $countryB == 'IT' ) $country = 'Italy';
if( $countryB == 'JM' ) $country = 'Jamaica';
if( $countryB == 'JP' ) $country = 'Japan';
if( $countryB == 'JO' ) $country = 'Jordan';
if( $countryB == 'KZ' ) $country = 'Kazakstan';
if( $countryB == 'KE' ) $country = 'Kenya';
if( $countryB == 'KI' ) $country = 'Kiribati';
if( $countryB == 'KP' ) $country = 'Korea, Democratic Peoples Republic of';
if( $countryB == 'KR' ) $country = 'Korea, Republic of';
if( $countryB == 'KW' ) $country = 'Kuwait';
if( $countryB == 'KG' ) $country = 'Kyrgyzstan';
if( $countryB == 'LA' ) $country = 'Lao Peoples Democratic Republic';
if( $countryB == 'LV' ) $country = 'Latvia';
if( $countryB == 'LB' ) $country = 'Lebanon';
if( $countryB == 'LS' ) $country = 'Lesotho';
if( $countryB == 'LR' ) $country = 'Liberia';
if( $countryB == 'LY' ) $country = 'Libyan Arab Jamahiriya';
if( $countryB == 'LI' ) $country = 'Liechtenstein';
if( $countryB == 'LT' ) $country = 'Lithuania';
if( $countryB == 'LU' ) $country = 'Luxembourg';
if( $countryB == 'MO' ) $country = 'Macau';
if( $countryB == 'MK' ) $country = 'Macedonia';
if( $countryB == 'MG' ) $country = 'Madagascar';
if( $countryB == 'MW' ) $country = 'Malawi';
if( $countryB == 'MY' ) $country = 'Malaysia';
if( $countryB == 'ML' ) $country = 'Mali';
if( $countryB == 'MT' ) $country = 'Malta';
if( $countryB == 'MH' ) $country = 'Marshall Islands';
if( $countryB == 'MQ' ) $country = 'Martinique';
if( $countryB == 'MR' ) $country = 'Mauritania';
if( $countryB == 'MU' ) $country = 'Mauritius';
if( $countryB == 'YT' ) $country = 'Mayotte';
if( $countryB == 'MX' ) $country = 'Mexico';
if( $countryB == 'FM' ) $country = 'Micronesia, Federated States of';
if( $countryB == 'MD' ) $country = 'Moldova, Republic of';
if( $countryB == 'MC' ) $country = 'Monaco';
if( $countryB == 'MN' ) $country = 'Mongolia';
if( $countryB == 'ME' ) $country = 'Montenegro';
if( $countryB == 'MS' ) $country = 'Montserrat';
if( $countryB == 'MA' ) $country = 'Morocco';
if( $countryB == 'MZ' ) $country = 'Mozambique';
if( $countryB == 'MM' ) $country = 'Myanmar';
if( $countryB == 'NA' ) $country = 'Namibia';
if( $countryB == 'NR' ) $country = 'Nauru';
if( $countryB == 'NP' ) $country = 'Nepal';
if( $countryB == 'NL' ) $country = 'Netherlands';
if( $countryB == 'AN' ) $country = 'Former Netherlands Antilles';
if( $countryB == 'NC' ) $country = 'New Caledonia';
if( $countryB == 'NZ' ) $country = 'New Zealand';
if( $countryB == 'NI' ) $country = 'Nicaragua';
if( $countryB == 'NE' ) $country = 'Niger';
if( $countryB == 'NU' ) $country = 'Niue';
if( $countryB == 'NF' ) $country = 'Norfolk Island';
if( $countryB == 'MP' ) $country = 'Northern Mariana Islands';
if( $countryB == 'NO' ) $country = 'Norway';
if( $countryB == 'OM' ) $country = 'Oman';
if( $countryB == 'PK' ) $country = 'Pakistan';
if( $countryB == 'PW' ) $country = 'Palau';
if( $countryB == 'PS' ) $country = 'Palestinian Territory, Occupied';
if( $countryB == 'PA' ) $country = 'Panama';
if( $countryB == 'PG' ) $country = 'Papua New Guinea';
if( $countryB == 'PY' ) $country = 'Paraguay';
if( $countryB == 'PE' ) $country = 'Peru';
if( $countryB == 'PH' ) $country = 'Philippines';
if( $countryB == 'PN' ) $country = 'Pitcairn';
if( $countryB == 'PL' ) $country = 'Poland';
if( $countryB == 'PT' ) $country = 'Portugal';
if( $countryB == 'PR' ) $country = 'Puerto Rico';
if( $countryB == 'QA' ) $country = 'Qatar';
if( $countryB == 'RE' ) $country = 'Reunion';
if( $countryB == 'RO' ) $country = 'Romania';
if( $countryB == 'RU' ) $country = 'Russian Federation';
if( $countryB == 'RW' ) $country = 'Rwanda';
if( $countryB == 'SH' ) $country = 'Saint Helena';
if( $countryB == 'KN' ) $country = 'Saint Kitts and Nevis';
if( $countryB == 'LC' ) $country = 'Saint Lucia';
if( $countryB == 'PM' ) $country = 'Saint Pierre and Miquelon';
if( $countryB == 'VC' ) $country = 'Saint Vincent and the Grenadines';
if( $countryB == 'WS' ) $country = 'Samoa';
if( $countryB == 'SM' ) $country = 'San Marino';
if( $countryB == 'ST' ) $country = 'Sao Tome and Principe';
if( $countryB == 'SA' ) $country = 'Saudi Arabia';
if( $countryB == 'SN' ) $country = 'Senegal';
if( $countryB == 'RS' ) $country = 'Serbia';
if( $countryB == 'SC' ) $country = 'Seychelles';
if( $countryB == 'SL' ) $country = 'Sierra Leone';
if( $countryB == 'SG' ) $country = 'Singapore';
if( $countryB == 'SK' ) $country = 'Slovakia';
if( $countryB == 'SI' ) $country = 'Slovenia';
if( $countryB == 'SB' ) $country = 'Solomon Islands';
if( $countryB == 'ZA' ) $country = 'South Africa';
if( $countryB == 'GS' ) $country = 'South Georgia and the South Sandwich Islands';
if( $countryB == 'ES' ) $country = 'Spain';
if( $countryB == 'LK' ) $country = 'Sri Lanka';
if( $countryB == 'SD' ) $country = 'Sudan';
if( $countryB == 'SR' ) $country = 'Suriname';
if( $countryB == 'SJ' ) $country = 'Svalbard and Jan Mayen';
if( $countryB == 'SZ' ) $country = 'Swaziland';
if( $countryB == 'SE' ) $country = 'Sweden';
if( $countryB == 'CH' ) $country = 'Switzerland';
if( $countryB == 'SY' ) $country = 'Syrian Arab Republic';
if( $countryB == 'TJ' ) $country = 'Taiwan';
if( $countryB == 'TJ' ) $country = 'Tajikistan';
if( $countryB == 'TZ' ) $country = 'Tanzania, United Republic of';
if( $countryB == 'TH' ) $country = 'Thailand';
if( $countryB == 'TG' ) $country = 'Togo';
if( $countryB == 'TK' ) $country = 'Tokelau';
if( $countryB == 'TO' ) $country = 'Tonga';
if( $countryB == 'TT' ) $country = 'Trinidad and Tobago';
if( $countryB == 'TN' ) $country = 'Tunisia';
if( $countryB == 'TR' ) $country = 'Turkey';
if( $countryB == 'TM' ) $country = 'Turkmenistan';
if( $countryB == 'TC' ) $country = 'Turks and Caicos Islands';
if( $countryB == 'TV' ) $country = 'Tuvalu';
if( $countryB == 'UG' ) $country = 'Uganda';
if( $countryB == 'UA' ) $country = 'Ukraine';
if( $countryB == 'AE' ) $country = 'United Arab Emirates';
if( $countryB == 'GB' ) $country = 'United Kingdom';
if( $countryB == 'UY' ) $country = 'Uruguay';
if( $countryB == 'UZ' ) $country = 'Uzbekistan';
if( $countryB == 'VU' ) $country = 'Vanuatu';
if( $countryB == 'VE' ) $country = 'Venezuela';
if( $countryB == 'VN' ) $country = 'Vietnam';
if( $countryB == 'VG' ) $country = 'Virgin Islands, British';
if( $countryB == 'VI' ) $country = 'Virgin Islands, U.S.';
if( $countryB == 'WF' ) $country = 'Wallis and Futuna';
if( $countryB == 'EH' ) $country = 'Western Sahara';
if( $countryB == 'YE' ) $country = 'Yemen';
if( $countryB == 'ZM' ) $country = 'Zambia';
if( $countryB == 'ZW' ) $country = 'Zimbabwe';
if( $countryB == 'US' ) $country = 'United States';
if( $countryB == 'NG' ) $country = 'Nigeria';
if( $countryB == 'CD' ) $country = 'Congo, the Democratic Republic of the';
if( $countryB == 'CUW' ) $country = 'Curaçao';
if( $countryB == 'GG' ) $country = 'Guernsey';
if( $countryB == 'VA' ) $country = 'Holy See (Vatican City State)';
if( $countryB == 'IM' ) $country = 'Isle of Man';
if( $countryB == 'JE' ) $country = 'Jersey';
if( $countryB == 'MV' ) $country = 'Maldives';
if( $countryB == 'MF' ) $country = 'Saint Martin (French part)';
if( $countryB == 'PM' ) $country = 'Sint Maarten (Dutch part)';
if( $countryB == 'SO' ) $country = 'Somalia';
if( $countryB == 'TL' ) $country = 'Timor-Leste';
if( $countryB == 'UM' ) $country = 'United States Minor Outlying Islands';
if( $countryB == 'XK' ) $country = 'Kosovo';

$country = $country;



$Birthday = $_POST['txtFullDate'];
$GenderB = $_POST['00N1Y00000Iqm89'];

//$GenderB = $_POST['00N1Y00000Iqm89'];

  if( $GenderB == '0' ) $Gender = 'Feminino';
  if( $GenderB == '1' ) $Gender = 'Masculino';
$Gender = $Gender;


$Phone = $_POST['phone'];
$What_product_do_you_trade2 = $_POST['Trading_Product__c'];
$What_product_do_you_trade = implode(", ",$What_product_do_you_trade2);

//$Base_currency = $_POST['base-currency'];

$Base_currencyB = $_POST['base-currency'];

//$GenderB = $_POST['00N1Y00000Iqm89'];

  if( $Base_currencyB == '3' ) $Base_currency = 'EUR';
  if( $Base_currencyB == '4' ) $Base_currency = 'GBP';
  if( $Base_currencyB == '5' ) $Base_currency = 'USD';

$Base_currency = $Base_currency;


//$Account_type = $_POST['account-type'];
$Account_typeB = $_POST['account-type'];

//$GenderB = $_POST['00N1Y00000Iqm89'];

  if( $Account_typeB == '119' ) $Account_type = 'Standard';
  if( $Account_typeB == '121' ) $Account_type = 'ECN';

$Account_type = $Account_type;


$How_did_you_hear_about_us = $_POST['who_referred_you'];

$Application_Date = $Application_Date__c;




$mail = new PHPMailer(TRUE);

try {

   $mail->isHTML(true);
   $mail->setFrom('accounts@clmforex.com', 'Live Application Form - PT');
   $mail->addAddress('accounts@clmforex.com', 'CLM');

   //$mail->setFrom('danycan31416@gmail.com', 'Live Application Form - PT');
   //$mail->addAddress('danycan31416@gmail.com', 'CLM');

   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = TRUE;
   $mail->SMTPSecure = 'tls';
   $mail->Username = 'coreliquiditymarkets.clm@gmail.com';
   $mail->Password = '(-7?,#gr!ss7R6+f';
   $mail->Port = 587;
   

class PDF extends FPDF
{

  //Starts Paraghap
  function WordWrap(&$text, $maxwidth)
{
    $text = trim($text);
    if ($text==='')
        return 0;
    $space = $this->GetStringWidth(' ');
    $lines = explode("\n", $text);
    $text = '';
    $count = 0;

    foreach ($lines as $line)
    {
        $words = preg_split('/ +/', $line);
        $width = 0;

        foreach ($words as $word)
        {
            $wordwidth = $this->GetStringWidth($word);
            if ($wordwidth > $maxwidth)
            {
                // Word is too long, we cut it
                for($i=0; $i<strlen($word); $i++)
                {
                    $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                    if($width + $wordwidth <= $maxwidth)
                    {
                        $width += $wordwidth;
                        $text .= substr($word, $i, 1);
                    }
                    else
                    {
                        $width = $wordwidth;
                        $text = rtrim($text)."\n".substr($word, $i, 1);
                        $count++;
                    }
                }
            }
            elseif($width + $wordwidth <= $maxwidth)
            {
                $width += $wordwidth + $space;
                $text .= $word.' ';
            }
            else
            {
                $width = $wordwidth + $space;
                $text = rtrim($text)."\n".$word.' ';
                $count++;
            }
        }
        $text = rtrim($text)."\n";
        $count++;
    }
    $text = rtrim($text);
    return $count;
}
//Ends Paraghap

//Page header
    function Header()
    {
         // Logo
        $this->Image('https://clmforex.com/wp-content/uploads/legal-documents/pdf-form/CLM-Blue.png',75,6,60);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        //$this->Cell(60,10,'Application Details',1,0,'C');
        // Line break
        $this->Ln(15);
    }

    // Page footer
    function Footer()
    {
        //$this->Cell(60,10,'Application Details',1,0,'C');
    }

}


   //$pdf = new FPDF();
   $pdf = new PDF();

   $pdf->SetMargins(10, 5);
   $pdf->AddPage();

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(40,10, 'Application Details:');
   //$pdf->Cell(40,10, 'Application Details:',1,0,'C');
   //$pdf->Cell(60,10,'Application Details',1,0,'C');
   $pdf->Line(10, 28, 210-10, 28); // Lie
   $pdf->Ln(13);
   

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(12,10, 'Title:');
   $pdf->SetFont('Arial','',12);
   //$pdf->Cell(40,10, $Title);
   //$pdf->Cell(100, 10, $Title, '', 10, true);
   $pdf->Cell(5,10,iconv("UTF-8", "CP1250//TRANSLIT", $Title),20,0,'L');
   $pdf->Ln();

   $pdf->SetFont('Arial','B',12);
   //$pdf->Cell(40,10, 'First name:');
   $pdf->Cell(25,10, 'First name:');   
   $pdf->SetFont('Arial','',12);
   //$pdf->Cell(7, 10, '   ' . $First_name, '', 0,  true);   
  // $pdf->Cell(7, 5, $First_name,  5,  true, 20,0,'L');  
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $First_name),20,0,'L');
   $pdf->Ln();

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(25,10, 'Last name:');   
   $pdf->SetFont('Arial','',12);
   //$pdf->Cell(7, 10, '   ' . $Last_name, '', 0,  true);
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Last_name),20,0,'L');
   $pdf->Ln();

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(32,10, 'Email address:');   
   $pdf->SetFont('Arial','',12);
   //$pdf->Cell(47, 10, '   ' . $Email_address, '', 0,  true);.
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Email_address),20,0,'L');

   $pdf->Ln();

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(23,10, 'Password:');   
   $pdf->SetFont('Arial','',12);
   //$pdf->Cell(7, 5, $Password,  5,  true, 20,0,'L');  
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Password),20,0,'L');
   $pdf->Ln();

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(20,10, 'Country:');
   $pdf->SetFont('Arial','',12);   
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $country),20,0,'L');
   $pdf->Ln();   

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(20,10, 'Birthday:');   
   $pdf->SetFont('Arial','',12);
   //$pdf->Cell(35, 10, '   ' . $Birthday, '', 0,  true);
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Birthday),20,0,'L');
   $pdf->Ln();      

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(19,10, 'Gender:'); 
   $pdf->SetFont('Arial','',12);  
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Gender),20,0,'L');
   $pdf->Ln();      

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(17,10, 'Phone:');  
   $pdf->SetFont('Arial','',12);    
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Phone),20,0,'L');
   $pdf->Ln(); 

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(65,10, 'What product(s) do you trade?:');   
   //$pdf->Cell(40,10,  $email);
   $pdf->SetFont('Arial','',12);
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $What_product_do_you_trade),20,0,'L');


   $pdf->Ln();  

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(33,10, 'Base currency:');   
   $pdf->SetFont('Arial','',12);
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Base_currency),20,0,'L'); 
   $pdf->Ln();  

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(30,10, 'Account type:');   
   $pdf->SetFont('Arial','',12);
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Account_type),20,0,'L');
   $pdf->Ln();      

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(60,10, 'How did you hear about us?:');   
   $pdf->SetFont('Arial','',12);
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $How_did_you_hear_about_us),20,0,'L');
    $pdf->Ln();    
   //$pdf->Cell(40,10,  $email);
   //$pdf->Ln(35);      
   

   $pdf->SetFont('Arial','B',12);
   $pdf->Cell(36,10, 'Application date:');   
   $pdf->SetFont('Arial','',12);
   $pdf->Cell(7,10,iconv("UTF-8", "CP1250//TRANSLIT", $Application_Date),20,0,'L');
   $pdf->Ln(15);   



   $pdf->SetFont('Arial','B',12);
   //$pdf->Cell(40,10, 'Applicant Declaration:');
   $pdf->Cell(40,10,iconv("UTF-8", "CP1250//TRANSLIT", 'Applicant Declaration:'),20,0,'L');
   $pdf->Line(10, 185, 210-10, 185); // Line
   $pdf->Ln(11);
   




   $pdf->SetFont('Arial','',12);
   $text1=str_repeat('I confirm that I understand the full nature and risks of trading forex, CFDs and other derivative products.',1);
   $nb=$pdf->WordWrap($text1,195);
   $pdf->Write(5,$text1);
   $pdf->Ln(10);



   $text2=str_repeat('I acknowledge that I have received, read, understood and agreed to the following documents supplied by CLMarkets Ltd: Financial Services Guide, Product Disclosure Statement, Privacy Policy,Terms and Conditions.',1);
   $nb=$pdf->WordWrap($text2,465);
   $pdf->Write(5,$text2);
   $pdf->Ln(9);

   $text3=str_repeat('I agree to execute and be legally bound by the account Terms and Conditions in relation to the financial products to be traded now or in the future.',1);
   $nb=$pdf->WordWrap($text3,465);
   $pdf->Write(5,$text3);
   $pdf->Ln(9);

   $text4=str_repeat('I understand that CLMarkets Ltd. will verify my identity, and may disclose personal information as my name, date of birth, and address to a reporting agency.',1);
   $nb=$pdf->WordWrap($text4,465);
   $pdf->Write(5,$text4);
   $pdf->Ln(9);


   $text5=str_repeat('I hereby confirm that I am acting on my own behalf, and was not solicited by CLMarkets Ltd. or anyone associated with the company.',1);
   $nb=$pdf->WordWrap($text5,645);
   $pdf->Write(5,$text5);
   


   $pdf->Ln(7.5);

  //$signature = 'X'." ". $First_name." ".$Last_name." ".$Application_Date; 
  $signature = $First_name." ".$Last_name." ".$Application_Date; 



   $pdf->SetFont('Arial','B',12);   
   //$pdf->SetFont('Arial','',12);
   $pdf->Cell(7,13,iconv("UTF-8", "CP1250//TRANSLIT", $signature),20,0,'L');

   $pdf->Ln(15); 

   $pdfdoc = $pdf->Output('', 'S');
   $pdf->Ln();


       if ($mail->addReplyTo($Email_reply, $First_name)) {
            //$this->AddAnAddress('ReplyTo', $address, $name);
        $mail->Subject = 'Live Application Form - PT'; 


        $mail->isHTML(true);

    $mail->Body = "There has been a message sent from our Live Account form  
    <br>Details can be found in the attached pdf";


    $mail->addStringAttachment($pdfdoc, 'contact-pt.pdf');


   //Starts send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo

            //$msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            //$msg = 'Message sent! Thanks for contacting us.';
            //header("Refresh:3; url=index.php#contact");
            //echo "Message sent! Thanks for contacting us. We aim to respond within 1 working day";
        }
    //Ends send the message, check for errors    


    } 


   /* Enable SMTP debug output. */
   $mail->SMTPDebug = 4;

  // $mail->send();


}

catch (Exception $e)
{
  echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();

 } 



/* ------------------- Ends send email in PDF ------------------- */

        //$yourURL="/pt/entrar-aplicativo-de-conta-ativa/"; 
        $yourURL="/pt/verifique-sua-conta-r/"; 


        echo ("<script>location.href='$yourURL'</script>");
        //header('Location: https://www.clmforex.com/demo-account-thank-you');
        //exit(); // terminates the script
    }
    else {
      // error occurred - provide the user some information.
      //echo "Email duplicated";
        //$emailError = 'This email address is already registered.';
        $emailError = 'Este endereço de e-mail já está registrado.';

    }


}

?>


<html>
<head>
    <title>Live Account Login - Core Liquidity Markets</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="robots" content="noindex, nofollow">
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

        
    #header {
      min-height:100%;
      display:block; 
      /* background-image: url(https://www.clmforex.com/assets/images/login-new.jpg); */
      background-color: #1062bc;
      background-repeat:no-repeat; 
      background-size: cover; 
      border-radius: 5px;
    }

    .white{
      padding: 15px 0
    } 

</style>

    <!-- mixing, adding styles -->
    <style type="text/css">

    /* Space between Investment Amount & Account type */
        .mr-2, .mx-2 {
            margin-right: 0.1rem!important;
        }  

        .error {
            color:red;
        }

        .success {
            color:green;
        }
    </style>


    <style type="text/css">

      .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: #7a7a7a !important;
          
      }
    /* @media only screen and (min-width: 1025px) {   */
     .btn:not([class*=btn-outline-]) {    
      background-color: #fff !important;
      color: black;  
      border: 1px solid #ccc;

      -webkit-box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0) !important; 
      box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0) !important;

      }

      .btn.btn-primary {
          background-color: #1062bc !important;
          width: 49% !important;
      }

      .btn.btn-success {
          background-color: #2cc482 !important;
          /* width: 49% !important; */
          width: 38.8% !important;
          float: right !important;
          border-radius: 8px !important;
      }
  /* } */

    </style>

<!-- <script type="text/javascript">
            (async() => {
              const res = await fetch("https://freegeoip.app/json/");
              const json = await res.json();
              document.getElementById("social").value = json.country_code;
              //$("#social").select2();
              $("#social").select2({
                templateResult: formatOptions,
                templateSelection: formatOptions
              });
            })();
</script> -->


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
                        if(document.getElementById("social").value == "IE"){ s2 = '101';}
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
                        if(document.getElementById("social").value == "CUW"){ s2 = '236';}
                        if(document.getElementById("social").value == "GG"){ s2 = '237';}
                        if(document.getElementById("social").value == "IM"){ s2 = '239';}
                        if(document.getElementById("social").value == "JE"){ s2 = '240';}
                        if(document.getElementById("social").value == "XK"){ s2 = '247';}
                        if(document.getElementById("social").value == "MV"){ s2 = '241';}
                        if(document.getElementById("social").value == "AN"){ s2 = '149';}
                        if(document.getElementById("social").value == "NI"){ s2 = '152';}
                        if(document.getElementById("social").value == "NG"){ s2 = '234';}
                        if(document.getElementById("social").value == "KR"){ s2 = '111';}
                        if(document.getElementById("social").value == "VA"){ s2 = '238';}
                // }
                document.getElementById("NS").innerHTML=("Level: " +s2);
                //var element = document.getElementById("NS");

                document.getElementById("NewValueCountry").value = s2;

                /* Assign Sales representatives according to time's schedule and countries */
   
   var d = new Date("<?= date('D M d, Y G:i:s'); ?>");
   //d.setHours( d.getHours() - 8 ); //Localhost time
   d.setHours( d.getHours() - 6 ); //wpEngine Server time
   var varTime = d.toLocaleTimeString('it-IT') ;
   //var varTime = '00:28:00';
   var flag_code = document.getElementById("NewValueCountry").value = s2;
   //console.log(varTime);
   //console.log(flag_code);
   


    var sr;
    // Tiago's schedule GMT +2
    var startT = '03:59:59';
    var endT   = '23:59:59';


    // Gustavo's schedule
    var startG = '00:00:00';
    var endG   = '04:00:00';


    if((varTime >= startT && varTime <= endT) && (flag_code == 30 || flag_code == 39 || flag_code == 143 || flag_code == 169)) {    
            sr = "Tiago Almeida";
      }
     
      else if((varTime >= startG && varTime <= endG) && (flag_code == 30 || flag_code == 39 || flag_code == 143 || flag_code == 169)) {  
            sr = "Gustavo Oliveira";
      }
      
      else if(flag_code != 30 || flag_code !=39 || flag_code != 143 || flag_code != 169) {   
            sr = '';
      }
  

    //document.getElementById("demo").innerHTML = sr;
    document.getElementById("Sales_Representative__c").value = sr;

/* --End-- */

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


<!-- input height & border colors -->
<style type="text/css">
  a:focus, a:active, input, select, input:hover, input:focus, input:active, textarea, textarea:hover, textarea:focus, textarea:active {
    -moz-outline: none;
    outline: none;
    height: 45px !important;
    border-color: #dbdbdb !important;
</style>


<style type="text/css">
/* heigh, select country flags */
  .select2-container .select2-selection--single {    
    height: 50px !important;
    border-color: #dbdbdb !important;

}

/* height center country name and flag. */
  .select2-container .select2-selection--single .select2-selection__rendered {
    padding-top: 6px !important;
}

/* Center arrow in dropdown caret*/
  .select2-container--default .select2-selection--single .select2-selection__arrow b {
      margin-top: 8px;
  }



/* Label color, titles*/
label {
    color: #b1b1b1 !important;
    font-weight: 600 !important;
}

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

    input[type="checkbox"]+span.tyc:before { font: 16pt FontAwesome; content: '\0f096'; display: inline-block; width: 16pt; padding: 2px 2px 0 3px; margin-right: 0.5em; margin-left: -29px; color: #ccc; font-weight: 100;}

    input[type="checkbox"]:checked+span.tyc:before {
    content: '\0f046';
    color: #2cc482;
}

    input[type="checkbox"]:focus+span.tyc:before { outline: 0px #aaa; } 
    input[type="checkbox"]:disabled+span.tyc { color: #999; }
    input[type="checkbox"]:disabled+span.tyc { border-color: red; border-style: solid; }
    /* input[type="checkbox"]:not(:disabled)+span.tyc:hover:before { text-shadow: 0 1px 2px #77F; } */


#ex2 input {
  float: left;
}

#ex2 label {
  width: 100%;
  display: block;
  float: left;
  color: #b1b1b1 !important;
/*  margin-left: 10px;  */
}


</style>



<!-- Styles for radio input -->
<style>
    body {
      /*padding: 1rem;
      color: #797e86;*/
    }

    .rdo h1 {
      color: #18191b;
      margin-bottom: 2rem;
    }

    .rdo section {
      display: flex !important;
      flex-flow: row wrap !important;
    }

    .rdo section > div {
      flex: 1 !important;
      padding: 0.5rem !important;
    }

    .rdo input[type="radio"] {
      display: none !important;
    }
    
    .rdo input[type="radio"]:not(:disabled) ~ label {
      cursor: pointer !important;
    }
    
    .rdo input[type="radio"]:disabled ~ label {
      color: #bcc2bf !important;
      border-color: #bcc2bf !important;
      box-shadow: none !important;
      cursor: not-allowed !important;
    }

    .rdo label {
      /* height: 100% !important; */
      display: block !important;
      /* background: white !important; */
       /* background: #f2f5f8 !important; */
       /* background: #eef1f4 !important; */
       background: #f5f7f8 !important;
      /* border: 2px solid #20df80; */      
      border: 2px solid #f2f5f8 !important;
      border-radius: 10px !important;
      padding: 1rem !important;
      margin-bottom: 1rem !important;
      text-align: center !important;
      box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5) !important;
      position: relative !important;
      color: #b1b1b1 !important;
    }

    .rdo input[type="radio"]:checked + label {
      /* background: #20df80; */
      background: #f2f5f8 !important;
      color: gray !important;
      /* box-shadow: 0px 0px 20px rgba(0, 255, 128, 0.75); */
    }
    
    .rdo input[type="radio"]:checked + label::after {
      color: #3d3f43 !important;
      font-family: FontAwesome !important;
      border: 2px solid #1062bc !important;
      content: "f00c" !important;
      font-size: 24px !important;
      position: absolute !important;
      top: -25px !important;
      left: 95% !important;
      transform: translateX(-50%) !important;
      height: 50px !important;
      width: 50px !important;
      line-height: 50px !important;
      text-align: center !important;
      border-radius: 50% !important;
      background: white !important;
      box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25) !important;
    }

    /*.rdo input[type="radio"]#control_05:checked + label {
      background: red !important;
      border-color: red !important;
    }*/

    .rdo p {
      font-weight: 600 !important;
      color: #b1b1b1;
    }

    @media only screen and (max-width: 700px) {
      .rdo section {
        flex-direction: column !important;
      }
    }

</style>
    
    <script>
      window.console = window.console || function(t) {};
    </script>

    <script>
      if (document.location.search.match(/type=embed/gi)) {
        window.parent.postMessage("resize", "*");
      }
    </script>


<!-- Retrieve data from ipwhois This API is free for up to 10,000 requests per month (IP and REFERER identification). -->
<script type="text/javascript">
            (async() => {
              //const res = await fetch("http://free.ipwhois.io/json/");
              const res = await fetch("https://ipapi.co/json/");
              const json = await res.json();
              //document.getElementById("phone").value = json.country_phone;
              //document.getElementById("phone").value = json.country_calling_code;
              //delete the first character "+"
              document.getElementById("phone").value = json.country_calling_code.substr(1);
            })();
</script>
<!-- -->


<style type="text/css">
    input.abc  { 
      width: 20px !important; 
      height: 20px !important; 
  } 

.abc, label input[type=checkbox] {
   position:absolute;
   top:2px;
   left:0px;   
}


#ex2 input {
  float: left;
}

#ex2 label {
  width: 100%;
  display: block;
  float: left;
/*  margin-left: 10px;  */
}
</style>


<!-- style for radio options -->





<!-- Responsive -->

<style type="text/css">
  /* ------Normal settings------ */
   
   div.formStyle {
            border-radius: 8px;
            background-color: #fff;
            max-width: 600px;
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


      /* Responsive rules */
    @media only screen and (max-width: 375px) {
      /*div .formStyle {
      border-radius: 10px !important;
      background-color: #fff;
      padding-left: 20px;
      padding-right: 20px;
      padding-bottom: 9px;
      padding-top: 35px;
      position: relative;
      height: 1130px; 
      width: 100%;
      height: 100% !important;     
      margin: auto;
      top:25%;
      padding-bottom: 24% !important;
      }*/


      .col-md-6 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;

      }

      .col-md-5 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;
      }

      .col-md-2 {
      padding-right: 16px !important;
      }
    }



    /*-- Horizontal Cellphones --*/
    @media (min-width: 376px) and (max-width: 767px) {
      /*div .formStyle{
        border-radius: 10px !important;
      background-color: #fff;
      padding-left: 20px;
      padding-right: 20px;
      padding-bottom: 9px;
      padding-top: 35px;
      position: relative;
      width: 100%;
      height: 100% !important;       
      padding-bottom: 25% !important;
      margin: auto;
      top:25%;        
      }*/

      .col-md-6 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;
      }

      .col-md-5 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;
      }

      .col-md-2 {
      padding-right: 15px !important;
      }
      
    }


    /*-- Tablets --*/
    /* @media only screen and (max-width: 768px) { */
    @media (min-width: 768px) and (max-width: 991px) {



      .col-md-6 {
      /*-ms-flex: 0 0 50%;
      flex: 0 0 50%;*/
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;
      }

      .col-md-5 {
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;
      }

      .col-md-2 {
      padding-right: 15px !important;
      max-width: 100% !important;
      }
}    


</style>


<style>
  /* FIREFOX FIX OF UGLY SELECT BOXES */
@supports (-moz-appearance:none) {

  SELECT
  {
  -moz-appearance:none !important;
  background: transparent url('data:image/gif;base64,R0lGODlhBgAGAKEDAFVVVX9/f9TU1CgmNyH5BAEKAAMALAAAAAAGAAYAAAIODA4hCDKWxlhNvmCnGwUAOw==') right center no-repeat !important;
  background-position: calc(100% - 5px) center !important;
  }

}


 /* Style for Safari. */ 
/* select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: .5em;
    background: #efefef;
    border: none;
    border-radius: 3px;
    padding: 1em 2em 1em 1em;
    font-size: 1em;
}
.select-container {position:relative; display: inline;}
.select-container:after {content:""; width:0; height:0; position:absolute; pointer-events: none;}
.select-container:after {
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    top: .3em;
    right: .75em;
    border-top: 8px solid black;
    opacity: 0.5;
}
select::-ms-expand {
    display: none;
}*/


/*select {
  -webkit-appearance: none; 
  -moz-appearance: none;
  appearance: none;
  background: url("data:image/gif;base64,R0lGODlhBgAGAKEDAFVVVX9/f9TU1CgmNyH5BAEKAAMALAAAAAAGAAYAAAIODA4hCDKWxlhNvmCnGwUAOw==") no-repeat;
  background-size: 12px;
  background-position: calc(100% - 20px) center;
  background-repeat: no-repeat;
  background-color: #efefef;
}*/


/* This was working almos done, but by time is in stand by*/
select {

-webkit-appearance: none; 
-moz-appearance: none;
appearance: none;

-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
background: transparent url('data:image/gif;base64,R0lGODlhBgAGAKEDAFVVVX9/f9TU1CgmNyH5BAEKAAMALAAAAAAGAAYAAAIODA4hCDKWxlhNvmCnGwUAOw==') right no-repeat !important;
/* background-position: left 15px bottom 50px; */
background-position: 89% 50% !important;
background-color: #CCCCCC;
color: #000000;
border: 1px solid #000000;

}

select {
    /* padding:0 0.65em !important; */
    
}



/*
select {
  color: #8C98F2;
  font-size: 18px;
  width: 50%;
  margin-left: 25%;
  margin-top: 50px;
  padding: 20px 0 20px 10px;
  border: 0 !important;
  
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  

  background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='100' height='100' fill='%238C98F2'><polygon points='0,0 100,0 50,50'/></svg>") no-repeat;
  background-size: 12px;
  background-position: calc(100% - 20px) center;
  background-repeat: no-repeat;
  background-color: #efefef;
}
*/


</style>

<!-- Get data and send it to sign in, auto populate. -->
      <script type="text/javascript">
        function passVarToAffiliates()
        {
          var EEmail=document.getElementById("UserName").value;
          //email is the imput into the form"
          localStorage.setItem("TPVEmail",EEmail); 


          var FName=document.getElementById("password").value;
          //email is the imput into the form"
          localStorage.setItem("TPFName",FName);    


          return false;
        }
      </script>

</head>


<body id="header">
<!-- <center><h1 style="color:#fff">Create your account</h1></center> -->
    <div class="formStyle">
      <div class="ht">
      <form method="POST" oninput="txtFullDate.value = txtYear.value +'-'+ txtMonth.value +'-'+ txtDay.value"  _lpchecked="1">
        <!-- <input id="redirect_url" type="hidden" name="redirect_url" value="https://www.clmforex.com/demo-account-thank-you"; /> -->
                            <!-- Setting the link_id & rererral_id from url parameters  into a input to avoid the index maybe will be another way; but for the short time I done it like this -->
                            <input type="hidden" name="link_id" value = "<?php echo (isset($link_id))?$link_id:'';?>">

                            <input type="hidden" name="referral_id" value = "<?php echo (isset($referral_id))?$referral_id:'';?>">        
                            
                            
                              <div class="col-md-2" style="padding-right: 0px;">
                                <div class="form-group">
                                    <select class="form-control" id="individual-title-id" name="individual-title-id" required>
                                      <!-- <select class="form-control" id="sel1"> -->
                                      <option value="">Título</option>
                                      <option value="1">Sr.</option>
                                      <option value="2">Sra.</option>
                                      <option value="3">Srta.</option>
                                      <!-- <option value="4">Ms.</option> -->
                                      <option value="5">Dr.</option>
                                      <option value="6">Prof.</option>
                                    </select>
                                  </div>
                                </div>
                            <div class="col-md-5" style="padding-right: 5px; padding-left: 10px;">   
                                <div class="form-group">
                                    <input onkeyup="javascript:capitalize(this);" id="individual-first-name" type="text" name="individual-first-name" class="form-control" placeholder="Nome*" required="required" data-error="Firstname is required.">
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

                            <div class="col-md-5" style="padding-left: 5px;">
                                <div class="form-group">
                                    <input onkeyup="javascript:capitalize(this);" id="individual-last-name" type="text" name="individual-last-name" class="form-control" placeholder="Sobrenome*" required="required" data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <!-- Hidden -->
                            <input id="Preferred_Language__c" type="hidden" name="Preferred_Language__c" class="form-control" placeholder="Please enter your phone number *" required="required" data-error="Phone is required." value="Portuguese">

                            <input id="lead_source" type="hidden" name="lead_source" class="form-control" placeholder="Please enter your phone number *" required="required" data-error="Phone is required." value="Live Account (5-Minute-Income-Engine)">

                             <!-- Sales representative for Salesforce -->
                            <input id="Sales_Representative__c" type="hidden" name="Sales_Representative__c" class="form-control" placeholder="Sales Representative*" required="required" data-error="Phone is required." value="<?php echo (isset($Sales_Representative__c))?$Sales_Representative__c:'';?>">


                            <!-- Hidden -->
                            <input data-val="true" data-val-number="The field AccountType must be a number." data-val-required="The AccountType field is required." id="accountype" name="AccountType" type="hidden" value="2">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input oninput="this.value=this.value.toLowerCase()" id="UserName" type="email" name="UserName" class="form-control" placeholder="E-mail*" required="required" data-error="Valid email is required." value="<?php if (isset($email)) echo $emailError ?>">
                                    <span class="error"><?php if (isset($emailError)) echo $emailError ?></span> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div> 
                            <script type="text/javascript">
                                element.addEventListener('input',function(){this.value=this.value.toLowerCase()});​

                            </script>

 


                            <div class="col-md-12">
                            <div class="form-group input-group">
                                <input type="password" id="password" name="Password" class="form-control"  placeholder="Criar senha*" required="required" autocomplete="off" style="background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC"); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                <label class="input-group-addon">
                                  <input type="checkbox" style="display:none" onclick="(function(e, el){
                                      document.getElementById('password').type = el.checked ? 'text' : 'password';
                                      el.parentNode.lastElementChild.innerHTML = el.checked ? '<i class=\'glyphicon glyphicon-eye-close\'>' : '<i class=\'glyphicon glyphicon-eye-open\'>';
                                      })(event, this)">
                                   <span><i class="glyphicon glyphicon-eye-open"></i></span>
                                </label>
                              </div>
                              </div>
                              


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
                                      <!-- <option value="BS">Bahamas</option> -->
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
                                      <!-- <option value="BG">Bulgaria</option> -->
                                      <option value="BF">Burkina Faso</option>
                                      <!-- <option value="KH">Cambodia</option> -->
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
                                      <option value="CUW">Curacao</option>
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
                                      <!-- <option value="GH">Ghana</option> -->
                                      <option value="GI">Gibraltar</option>
                                      <option value="GR">Greece</option>
                                      <option value="GL">Greenland</option>
                                      <option value="GD">Grenada</option>
                                      <option value="GP">Guadeloupe</option>
                                      <option value="GU">Guam</option>
                                      <option value="GT">Guatemala</option>
                                      <option value="GG">Guernsey</option>
                                      <option value="GN">Guinea</option>
                                      <!-- <option value="GW">Guinea-Bissau</option> -->
                                      <option value="HM">Heard Island and McDonald Islands</option>
                                      <option value="HN">Honduras</option>
                                      <option value="HK">Hong Kong</option>
                                      <option value="HU">Hungary</option>
                                      <!-- <option value="IS">Iceland</option> -->
                                      <option value="ID">Indonesia</option>
                                      <option value="IE">Ireland</option>
                                      <option value="IM">Isle of Man</option>
                                      <option value="IT">Italy</option>
                                      <option value="JM">Jamaica</option>
                                      <option value="JE">Jersey</option>
                                      <option value="JO">Jordan</option>
                                      <!-- <option value="KZ">Kazakhstan</option> -->
                                      <option value="KE">Kenya</option>
                                      <option value="KI">Kiribati</option>
                                      <option value="XK">Kosovo</option>
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
                                      <option value="MV">Maldives</option>
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
                                      <option value="AN">Netherlands Antilles</option>
                                      <option value="NC">New Caledonia</option>
                                      <option value="NZ">New Zealand</option>
                                      <!-- <option value="NI">Nicaragua</option> -->
                                      <option value="NE">Niger</option>
                                      <option value="NG">Nigeria</option>
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
                                      <option value="KR">South Korea</option>
                                      <option value="ES">Spain</option>
                                      <option value="SJ">Svalbard and Jan Mayen</option>
                                      <option value="SZ">Swaziland</option>
                                      <option value="SE">Sweden</option>
                                      <option value="CH">Switzerland</option>
                                      <!-- <option value="SY">Syrian Arab Republic</option> -->
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
                                      <option value="VA">Holy See (Vatican City State)</option>
                                      <option value="VE">Venezuela</option>
                                      <option value="VN">Viet Nam</option>
                                      <option value="VG">Virgin Islands, British</option>
                                      <option value="VI">Virgin Islands, U.S.</option>
                                      <option value="WF">Wallis and Futuna</option>
                                      <option value="EH">Western Sahara</option>
                                      <option value="ZM">Zambia</option>
                                  </select>

                                  <p hidden id="NS" name="NS">Level: </p>
                                  <input hidden id="NewValueCountry" type="text" name="NewValueCountry">
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
                        if(document.getElementById("social").value == "IE"){ level = '101';}
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
                        if(document.getElementById("social").value == "CUW"){ level = '236';}
                        if(document.getElementById("social").value == "GG"){ level = '237';}
                        if(document.getElementById("social").value == "IM"){ level = '239';}
                        if(document.getElementById("social").value == "JE"){ level = '240';}
                        if(document.getElementById("social").value == "XK"){ level = '247';}
                        if(document.getElementById("social").value == "MV"){ level = '241';}
                        if(document.getElementById("social").value == "AN"){ level = '149';}
                        if(document.getElementById("social").value == "NI"){ level = '152';}
                        if(document.getElementById("social").value == "NG"){ level = '234';}
                        if(document.getElementById("social").value == "KR"){ level = '111';}
                        if(document.getElementById("social").value == "VA"){ level = '238';}
  //document.getElementById("NS").innerHTML=("Level: " +level);
  //document.getElementById("NewValueCountry").value = level;

  document.getElementById("NS").innerHTML=("Level: " +level);
  document.getElementById("NewValueCountry").value = level;

    /* Assign Sales representatives according to time's schedule and countries */   
   var d = new Date("<?= date('D M d, Y G:i:s'); ?>");
   //d.setHours( d.getHours() - 8 ); //Localhost time
   d.setHours( d.getHours() - 6 ); //wpEngine Server time
   var varTime = d.toLocaleTimeString('it-IT') ;
   
   //var varTime = '00:28:00';
   var flag_code = document.getElementById("NewValueCountry").value = level;
   console.log(varTime);
   console.log(flag_code);
   

   var sr;
   // Tiago's schedule GMT +2
   var startT = '03:59:59';
   var endT   = '23:59:59';


   // Gustavo's schedule
   var startG = '00:00:00';
   var endG   = '04:00:00';


 
if((varTime >= startT && varTime <= endT) && (flag_code == 30 || flag_code == 39 || flag_code == 143 || flag_code == 169)) {
        sr = "Tiago Almeida";
  }

  else if((varTime >= startG && varTime <= endG) && (flag_code == 30 || flag_code == 39 || flag_code == 143 || flag_code == 169)) {    
        sr = "Gustavo Oliveira";
  }

  else if(flag_code != 30 || flag_code != 39 || flag_code != 143 || flag_code != 169) {   
        sr = '';
  }

    document.getElementById("Sales_Representative__c").value = sr;
    /* --End-- */
  
}
changeLevel();
</script>
                                    <!-- <div class="help-block with-errors"></div> -->
                                </div>
                            </div>

<style type="text/css">
input.wt[type=tel] {
  width: 32%;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 6px 12px;
  font-size: 14px;
</style>




                          <div class="col-md-7" style="padding-right: 5px;">
                                <div class="form-group">
                                    <label for="phone">Data de nascimento*</label><br/>                                                                       
                                    <input class="wt" id="" type="tel" class="form-control" name="txtYear" pattern="[0-9]{4}" title="Enter the year as (YYYY)" placeholder="Ano" required="required" data-error="Valid birthday is required.">

                                    <input class="wt" id="" type="tel" class="form-control" name="txtMonth" pattern="[0-9]{2}" title="Enter the month as (MM)" placeholder="Mês" required="required" data-error="Valid birthday is required.">

                                    <input class="wt" type="tel" name="txtDay" pattern="[0-9]{2}" title="Enter the day as (DD)" placeholder="Dia" required="required" data-error="Valid birthday is required.">

                                     
                                    <input hidden type="tel" name="txtFullDate" id="txtFullDate"> 
                                    
                                </div>
                            </div>   


                            <div class="col-md-5">
                              <div class="form-group">
                                  <label >Gênero*</label><br/>
                                        <div class="btn-group-horizontal btn-group-toggle" data-toggle="buttons">
                              
                                          <!-- <label class="btn btn-secondary rounded"> -->
                                          <div class="btn-group mr-2" role="group" aria-label="Second group">            
                                              <label class="btn btn-gender rounded mt-1">
                                                <input type="radio" name="00N1Y00000Iqm89" id="" value="0" required>Feminino                   
                                              </label>
                                          </div>

                                          <div class="btn-group mr-2" role="group" aria-label="Second group">
                                              <label class="btn btn-gender rounded mt-1">
                                                <input type="radio" name="00N1Y00000Iqm89" id="" value="1" required>Masculino
                                              </label>
                                          </div> 
                                        </div>
                                </div>
                            </div>   

  
                            <div class="col-md-12" style="padding-left: 5px;">
                            </div>                                  



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Celular*</label>
                                    <input id="phone" type="tel" pattern="[0-9]{8,}" title="Deve conter apenas números e ao menos 8 ou mais dígitos." name="phone" class="form-control" placeholder="Por favor, digite seu número de telefone *" required="required" data-error="Valid phone is required.">
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                              <div class="form-group">
                                <label for="first_name">WhatsApp</label><br/>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="Yes-WhatsApp">
                                    <label class="custom-control-label" for="customRadioInline1">Yes</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="No-WhatsApp">
                                    <label class="custom-control-label" for="customRadioInline2">No</label>
                                  </div>
                              </div>      
                            </div>   --> 

                            


                            <!-- <div class="col-md-5">
                              <div class="form-group">
                                  <label >WhatsApp*</label><br/>
                                        <div class="btn-group-horizontal btn-group-toggle" data-toggle="buttons">
                              
                                          <div class="btn-group mr-2" role="group" aria-label="Second group">            
                                              <label class="btn btn-gender rounded mt-1">
                                                <input type="radio" name="whatsapp" id="" value="Yes" required>Sim   
                                              </label>
                                          </div>

                                          <div class="btn-group mr-2" role="group" aria-label="Second group">
                                              <label class="btn btn-gender rounded mt-1">
                                                <input type="radio" name="whatsapp" id="" value="No" required>Não
                                              </label>
                                          </div> 
                                        </div>
                                </div>
                            </div> -->




                            <div class="col-md-6">  
                            <label for="first_name" class="font-safari" style="color: #b1b1b1 !important; font-weight: 600 !important; width: 100% !important; font-size: 13px !important;">Quais produtos você opera?*</label>
                            <select class="js-example-basic-multiple" id="Trading_Product__c" name="Trading_Product__c[]" multiple="multiple" required>
                                <option></option>
                                <option value="Forex">Forex</option>
                                <option value="Metals">Metais</option>
                                <option value="Oil">Petróleo</option>
                                <option value="Indices">Índices</option>
                                <option value="Stocks">Ações</option>
                                <option value="Cryptos">Criptos</option>
                                <option value="Binary Options">Opções</option>   
                            </select>
                          </div> 

                          <script type="text/javascript">
                            $(document).ready(function() {
                              $('.js-example-basic-multiple').select2();


                          $('#Trading_Product__c').select2({
                              placeholder: "    Selecione as opções"
                          });

                          $('#Trading_experience__c').select2({
                              placeholder: "    Selecione um..."
                          });



                          $('Trading_Product__c').select2({
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
                              height: 45px;
                          }


                          .js-example-basic-multiple{
                            width: 100% !important;
                          }

                          /*Tell us what you like to trade... */
                          .js-example-basic-multiple2{
                            width: 100% !important;


                          }
                          
            
                          .select2-container--default.select2-container--focus .select2-selection--multiple {
                              border: solid #ccc 1px;
                              outline: 10;
                              height: 45px;
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
                         </style>

                           




<style type="text/css">
.btn-group-toggle>.btn, .btn-group-toggle>.btn-group>.btn {
    margin-bottom: 0;
    font-weight: 400 !important;
}



.btn.btn-secondary {
    color: #b1b1b1 !important;
    background-color: #f5f7f8 !important;
    border-color: #dbdbdb !important;
    border-radius: 8px !important;
    /* width: 113px !important; */
    /* width: 80px !important; */
    /* width: 90px !important; */
    width: 95px !important;
    padding: 13px 12px !important;
    outline: 0 !important;
    height: 45px !important;

}

.btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle {
    color: #ffffff !important;
    background-color: #2cc482 !important;
    border-radius: 8px !important;
    border-color: #2cc482;;
    outline: 0 !important;
}


.btn.btn-gender {
    color: #b1b1b1 !important;
    background-color: #f5f7f8 !important;
    border-color: #dbdbdb !important;
    border-radius: 8px !important;
    /* width: 113px !important; */
    /* width: 80px !important; */
    /* width: 90px !important; */
    width: 98px !important;
    padding: 13px 12px !important;
    outline: 0 !important;
    height: 45px !important;

}

.btn-gender:not(:disabled):not(.disabled).active, .btn-gender:not(:disabled):not(.disabled):active, .show>.btn-gender.dropdown-toggle {
    color: #ffffff !important;
    background-color: #2cc482 !important;
    border-radius: 8px !important;
    border-color: #2cc482;;
    outline: 0 !important;
}




button:focus {outline:0;}

</style>

<div class="col-md-7">
  <div class="form-group">
  <label for="first_name">Moeda base*</label><br/>
            <div class="btn-group-horizontal btn-group-toggle" data-toggle="buttons">
   
              <!-- <label class="btn btn-secondary rounded"> -->
              <div class="btn-group mr-2" role="group" aria-label="Second group">            
                  <label class="btn btn-secondary rounded mt-1">
                    <input type="radio" name="base-currency" id="" value="5" required>USD
                  </label>
              </div>
              <div class="btn-group mr-2" role="group" aria-label="Second group">  
                  <label class="btn btn-secondary rounded mt-1">
                    <input type="radio" name="base-currency" id="" value="3" required>
                    EUR
                  </label>
              </div>
              <!-- <div class="btn-group mr-2" role="group" aria-label="Second group"> -->
                  <label class="btn btn-secondary rounded mt-1">
                    <input type="radio" name="base-currency" id="" value="4" required>
                    GBP
                  </label>
              <!-- </div> -->
            
            </div>
    </div>
</div>


                            <div class="col-md-5">
                              <div class="form-group">
                                  <label for="first_names">Tipo de Conta*</label><br/>
                                        <div class="btn-group-horizontal btn-group-toggle" data-toggle="buttons">
                              
                                          <!-- <label class="btn btn-secondary rounded"> -->
                                          <div class="btn-group mr-2" role="group" aria-label="Second group">            
                                              <label class="btn btn-secondary rounded mt-1">
                                                <input type="radio" name="account-type" id="" value="119" required>Standard                   
                                              </label>
                                          </div>

                                          <div class="btn-group mr-2" role="group" aria-label="Second group">
                                              <label class="btn btn-secondary rounded mt-1">
                                                <input type="radio" name="account-type" id="" value="121" required>ECN
                                              </label>
                                          </div> 
                                        </div>
                                </div>
                            </div>



                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first_name">Como você conheceu a corretora?</label>
                                    <input id="who_referred_you" type="text" name="who_referred_you" class="form-control" placeholder="Digite sua resposta"data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="x" style="position:relative; padding-left:27px; display:block; color: #515151 !important; display: block; font-size: 11px; font-family: avenir-regular !important; font-weight: 500 !important;"><input class="abc" type="checkbox" required="required"><span class="tyc" id="tc" style="display: flex; text-align: justify !important;">Ao continuar e enviar esta inscrição, reconheço que assino eletronicamente seus <a href="https://clmforex.com/wp-content/uploads/legal-documents/CLMarkets-Terms-Conditions.pdf" target="_blank">Termos e Condições</a> e <a href="/pt/legal-documents/" target="_blank">documentos legais</a> relacionados e que este é um documento contratual juridicamente vinculativo. Confirmo que compreendo a natureza e os riscos da negociação de forex, CFDs e outros produtos derivados. Por meio deste, confirmo que estou agindo em meu próprio nome e não fui solicitado pela CLMarkets Ltd. ou por qualquer pessoa associada à empresa.</span></label>
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
                                <!-- <input style="color: #fff; font-family: avenir-regular; font-weight: 500; font-size: 20px;" type="submit" name="submit" class="btn btn-primary btn-send" value="">  -->

                                <!-- Working good...
                                <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 20px;" type="submit" name="submit2" class="btn btn-success btn-send" value="Seguinte">   
                                -->

                                <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 20px;" type="submit" name="submit2" class="btn btn-success btn-send" value="Seguinte" onclick="passVarToAffiliates();">   



                                <!-- <input type="submit" name="submit"> --> 
                                <!-- <button formaction="https://www.clmforex.com/demo-account-thank-you">Send message</button> -->    
                            </div>
<script type="text/javascript">
  //document.getElementById("result").innerHTML=localStorage.getItem("textValue");
  document.getElementById("individual-first-name").value=localStorage.getItem("FirstName");
  document.getElementById("individual-last-name").value=localStorage.getItem("LastName");
  document.getElementById("UserName").value=localStorage.getItem("VEmail");

</script>

        </div> 
       </div>                     
      </form>
</body>
</html>