<?php
$ip = file_get_contents('https://api.ipify.org');

 /* ---------- End Get geolocation -> IP ---------- */

//$qs = $_SERVER['REQUEST_URI'];
$qs = $_SERVER['QUERY_STRING'];



$qs = str_replace( '%', '&', $qs );
parse_str($qs, $qs_arr);
print_r($qs_arr);

$amountBefore = $qs_arr['amount'];  // value
$country_code = $qs_arr['residence_country'];  // value
$amountB = number_format($amountBefore, 2); 
//$amountB2 = str_replace(str_split(",."),"",$amountB);

$amount = $amountB;
//$amount = number_format($amountFF, 2);

//echo $amount;


if( $country_code == 'Afghanistan' ) $country = 'AF';
if( $country_code == 'Albania' ) $country = 'AL';
if( $country_code == 'Algeria' ) $country = 'DZ';
if( $country_code == 'American' ) $country = 'AS'; // American Samoa
if( $country_code == 'Andorra' ) $country = 'AD';
if( $country_code == 'Angola' ) $country = 'AO';
if( $country_code == 'Anguilla' ) $country = 'AI';
if( $country_code == 'Antarctica' ) $country = 'AQ';
if( $country_code == 'Antigua' ) $country = 'AG'; //  Antigua and Barbuda
if( $country_code == 'Argentina' ) $country = 'AR';
if( $country_code == 'Armenia' ) $country = 'AM';
if( $country_code == 'Aruba' ) $country = 'AW';
if( $country_code == 'Australia' ) $country = 'AU';
if( $country_code == 'Austria' ) $country = 'AT';
if( $country_code == 'Azerbaijan' ) $country = 'AZ';
if( $country_code == 'Bahamas' ) $country = 'BS';
if( $country_code == 'Bahrain' ) $country = 'BH';
if( $country_code == 'Bangladesh' ) $country = 'BD';
if( $country_code == 'Barbados' ) $country = 'BB';
if( $country_code == 'Belarus' ) $country = 'BY';
if( $country_code == 'Belgium' ) $country = 'BE';
if( $country_code == 'Belize' ) $country = 'BZ';
if( $country_code == 'Benine' ) $country = 'BJ';
if( $country_code == 'Bermuda' ) $country = 'BM';
if( $country_code == 'Bhutan' ) $country = 'BT';
if( $country_code == 'Bolivia' ) $country = 'BO';
if( $country_code == 'Bosnia' ) $country = 'BA'; // Bosnia and Herzegovina
if( $country_code == 'Botswana' ) $country = 'BW';
if( $country_code == 'Bouvet' ) $country = 'AF'; // Bouvet Island
if( $country_code == 'Brazil' ) $country = 'BR';
if( $country_code == 'British' ) $country = 'IO'; // British Indian Ocean Territory
if( $country_code == 'Brunei' ) $country = 'BN'; // Brunei Darussalam
if( $country_code == 'Bulgaria' ) $country = 'BG';
if( $country_code == 'Burkina' ) $country = 'BF';
if( $country_code == 'Burundi' ) $country = 'BI';
if( $country_code == 'Cambodia' ) $country = 'KH';
if( $country_code == 'Cameroon' ) $country = 'CM';
if( $country_code == 'Canada' ) $country = 'CA';
if( $country_code == 'Cape' ) $country = 'CV'; // Cape Verde
if( $country_code == 'Cayman' ) $country = 'KY'; // Cayman Islands
if( $country_code == 'Central' ) $country = 'CF'; // Central African Republic
if( $country_code == 'Chad' ) $country = 'TD';
if( $country_code == 'Chile' ) $country = 'CL';
if( $country_code == 'China' ) $country = 'CN';
if( $country_code == 'Christmas' ) $country = 'CX'; // Christmas Island
if( $country_code == "Côte" ) $country = 'CI'; // Côte d'Ivoire, Republic of
if( $country_code == 'Cocos' ) $country = 'CC'; // Cocos (Keeling) Islands
if( $country_code == 'Colombia' ) $country = 'CO';
if( $country_code == 'Comoros' ) $country = 'KM';
if( $country_code == 'Cook' ) $country = 'CK'; // Cook Islands
if( $country_code == 'Costa' ) $country = 'CR'; // Costa Rica
if( $country_code == 'Croatia' ) $country = 'HR';
if( $country_code == 'Cuba' ) $country = 'CU';
if( $country_code == 'Cyprus' ) $country = 'CY';
if( $country_code == 'Czech' ) $country = 'CZ'; // Czech Republic
if( $country_code == 'Denmark' ) $country = 'DK';
if( $country_code == 'Djibouti' ) $country = 'DJ';
if( $country_code == 'Dominica' ) $country = 'DM';
if( $country_code == 'Dominican' ) $country = 'DO'; // Dominican Republic
if( $country_code == 'East' ) $country = 'TL'; // East Timor
if( $country_code == 'Ecuador' ) $country = 'EC';
if( $country_code == 'Egypt' ) $country = 'EG';
if( $country_code == 'El' ) $country = 'SV'; // El Salvador
if( $country_code == 'Equatorial' ) $country = 'GQ'; // Equatorial Guinea
if( $country_code == 'Eritrea' ) $country = 'ER';
if( $country_code == 'Estonia' ) $country = 'EE';
if( $country_code == 'Ethiopia' ) $country = 'ET';
if( $country_code == 'Falkland' ) $country = 'FK'; // Falkland Islands (Malvinas)
if( $country_code == 'Faroe' ) $country = 'FO'; // Faroe Islands
if( $country_code == 'Fiji' ) $country = 'FJ';
if( $country_code == 'Finland' ) $country = 'FI';
if( $country_code == 'France' ) $country = 'FR';
if( $country_code == 'French' ) $country = 'GF'; // French Guiana *
if( $country_code == 'French' ) $country = 'PF'; // French Polynesia *
if( $country_code == 'French' ) $country = 'TF'; // French Southern Territories *
if( $country_code == 'Gabon' ) $country = 'GA';
if( $country_code == 'Gambia' ) $country = 'GM';
if( $country_code == 'Georgia' ) $country = 'GE';
if( $country_code == 'Germany' ) $country = 'DE';
if( $country_code == 'Ghana' ) $country = 'GH';
if( $country_code == 'Gibraltar' ) $country = 'GI';
if( $country_code == 'Greece' ) $country = 'GR';
if( $country_code == 'Greenland' ) $country = 'GL';
if( $country_code == 'Grenada' ) $country = 'GD';
if( $country_code == 'Guadeloupe' ) $country = 'GP';
if( $country_code == 'Guam' ) $country = 'GU';
if( $country_code == 'Guatemala' ) $country = 'GT';
if( $country_code == 'Guinea' ) $country = 'GN';
if( $country_code == 'Guinea-Bissau' ) $country = 'GW';
if( $country_code == 'Guyana' ) $country = 'GY';
if( $country_code == 'Haiti' ) $country = 'HT';
if( $country_code == 'Heard' ) $country = 'HM'; // Heard Island and McDonald Islands
if( $country_code == 'Honduras' ) $country = 'HN';
if( $country_code == 'Hong' ) $country = 'HK'; // Hong Kong
if( $country_code == 'Hungary' ) $country = 'HU';
if( $country_code == 'Iceland' ) $country = 'IS';
if( $country_code == 'India' ) $country = 'IN';
if( $country_code == 'Indonesia' ) $country = 'ID';
if( $country_code == 'Iran,' ) $country = 'IR'; // Iran, Islamic Republic of
if( $country_code == 'Iraq' ) $country = 'IQ';
if( $country_code == 'Ireland' ) $country = 'IE';
if( $country_code == 'Israel' ) $country = 'IL';
if( $country_code == 'Italy' ) $country = 'IT';
if( $country_code == 'Jamaica' ) $country = 'JM';
if( $country_code == 'Japan' ) $country = 'JP';
if( $country_code == 'Jordan' ) $country = 'JO';
if( $country_code == 'Kazakstan' ) $country = 'KZ';
if( $country_code == 'Kenya' ) $country = 'KE';
if( $country_code == 'Kiribati' ) $country = 'KI';
if( $country_code == 'Korea,' ) $country = 'KP'; // Korea, Democratic Peoples Republic of *
if( $country_code == 'Korea,' ) $country = 'KR'; // Korea, Republic of *
if( $country_code == 'Kuwait' ) $country = 'KW';
if( $country_code == 'Kyrgyzstan' ) $country = 'KG';
if( $country_code == 'Lao' ) $country = 'LA'; // Lao Peoples Democratic Republic
if( $country_code == 'Latvia' ) $country = 'LV';
if( $country_code == 'Lebanon' ) $country = 'LB';
if( $country_code == 'Lesotho' ) $country = 'LS';
if( $country_code == 'Liberia' ) $country = 'LR';
if( $country_code == 'Libyan' ) $country = 'LY'; // Libyan Arab Jamahiriya
if( $country_code == 'Liechtenstein' ) $country = 'LI';
if( $country_code == 'Lithuania' ) $country = 'LT';
if( $country_code == 'Luxembourg' ) $country = 'LU';
if( $country_code == 'Macau' ) $country = 'MO';
if( $country_code == 'Macedonia' ) $country = 'MK';
if( $country_code == 'Madagascar' ) $country = 'MG';
if( $country_code == 'Malawi' ) $country = 'MW';
if( $country_code == 'Malaysia' ) $country = 'MY';
if( $country_code == 'Mali' ) $country = 'ML';
if( $country_code == 'Malta' ) $country = 'MT';
if( $country_code == 'Marshall' ) $country = 'MH'; // Marshall Islands
if( $country_code == 'Martinique' ) $country = 'MQ';
if( $country_code == 'Mauritania' ) $country = 'MR';
if( $country_code == 'Mauritius' ) $country = 'MU';
if( $country_code == 'Mayotte' ) $country = 'YT';
if( $country_code == 'Mexico' ) $country = 'MX';
if( $country_code == 'Micronesia, Federated States of' ) $country = 'FM'; // Micronesia, Federated States of
if( $country_code == 'Moldova' ) $country = 'MD'; // Moldova, Republic of
if( $country_code == 'Monaco' ) $country = 'MC';
if( $country_code == 'Mongolia' ) $country = 'MN';
if( $country_code == 'Montenegro' ) $country = 'ME';
if( $country_code == 'Montserrat' ) $country = 'MS';
if( $country_code == 'Morocco' ) $country = 'MA';
if( $country_code == 'Mozambique' ) $country = 'MZ';
if( $country_code == 'Myanmar' ) $country = 'MM';
if( $country_code == 'Namibia' ) $country = 'NA';
if( $country_code == 'Nauru' ) $country = 'NR';
if( $country_code == 'Nepal' ) $country = 'NP';
if( $country_code == 'Netherlands' ) $country = 'NL';
if( $country_code == 'Former' ) $country = 'AN'; // Former Netherlands Antilles
if( $country_code == 'New' ) $country = 'NC'; // New Caledonia *
if( $country_code == 'New' ) $country = 'NZ'; // New Zealand *
if( $country_code == 'Nicaragua' ) $country = 'NI';
if( $country_code == 'Niger' ) $country = 'NE';
if( $country_code == 'Niue' ) $country = 'NU';
if( $country_code == 'Norfolk' ) $country = 'NF'; // Norfolk Island
if( $country_code == 'Northern' ) $country = 'MP'; // Northern Mariana Islands
if( $country_code == 'Norway' ) $country = 'NO';
if( $country_code == 'Oman' ) $country = 'OM';
if( $country_code == 'Pakistan' ) $country = 'PK';
if( $country_code == 'Palau' ) $country = 'PW';
if( $country_code == 'Palestinian' ) $country = 'PS'; // Palestinian Territory, Occupied
if( $country_code == 'Panama' ) $country = 'PA';
if( $country_code == 'Papua' ) $country = 'PG'; //Papua New Guinea
if( $country_code == 'Paraguay' ) $country = 'PY';
if( $country_code == 'Peru' ) $country = 'PE';
if( $country_code == 'Philippines' ) $country = 'PH';
if( $country_code == 'Pitcairn' ) $country = 'PN';
if( $country_code == 'Poland' ) $country = 'PL';
if( $country_code == 'Portugal' ) $country = 'PT';
if( $country_code == 'Puerto' ) $country = 'PR'; // Puerto Rico
if( $country_code == 'Qatar' ) $country = 'QA';
if( $country_code == 'Reunion' ) $country = 'RE';
if( $country_code == 'Romania' ) $country = 'RO';
if( $country_code == 'Russian' ) $country = 'RU'; // Russian Federation
if( $country_code == 'Rwanda' ) $country = 'RW';
if( $country_code == 'Saint' ) $country = 'SH'; // Saint Helena *
if( $country_code == 'Saint' ) $country = 'KN'; // Saint Kitts and Nevis *
if( $country_code == 'Saint' ) $country = 'LC'; // Saint Lucia *
if( $country_code == 'Saint' ) $country = 'PM'; // Saint Pierre and Miquelon *
if( $country_code == 'Saint' ) $country = 'VC'; // Saint Vincent and the Grenadines *
if( $country_code == 'Samoa' ) $country = 'WS';
if( $country_code == 'San' ) $country = 'SM'; // San Marino *
if( $country_code == 'Sao' ) $country = 'ST'; // Sao Tome and Principe *
if( $country_code == 'Saudi' ) $country = 'SA'; // Saudi Arabia
if( $country_code == 'Senegal' ) $country = 'SN';
if( $country_code == 'Serbia' ) $country = 'RS';
if( $country_code == 'Seychelles' ) $country = 'SC';
if( $country_code == 'Sierra Leone' ) $country = 'SL';
if( $country_code == 'Singapore' ) $country = 'SG';
if( $country_code == 'Slovakia' ) $country = 'SK';
if( $country_code == 'Slovenia' ) $country = 'SI';
if( $country_code == 'Solomon' ) $country = 'SB'; // Solomon Islands
if( $country_code == 'South' ) $country = 'ZA'; // South Africa *
if( $country_code == 'South' ) $country = 'GS'; // South Georgia and the South Sandwich Islands *
if( $country_code == 'Spain' ) $country = 'ES';
if( $country_code == 'Sri' ) $country = 'LK'; // Sri Lanka
if( $country_code == 'Sudan' ) $country = 'SD';
if( $country_code == 'Suriname' ) $country = 'SR';
if( $country_code == 'Svalbard' ) $country = 'SJ'; // Svalbard and Jan Mayen
if( $country_code == 'Swaziland' ) $country = 'SZ';
if( $country_code == 'Sweden' ) $country = 'SE';
if( $country_code == 'Switzerland' ) $country = 'CH';
if( $country_code == 'Syrian' ) $country = 'SY'; // Syrian Arab Republic 
if( $country_code == 'Taiwan' ) $country = 'TJ';
if( $country_code == 'Tajikistan' ) $country = 'TJ';
if( $country_code == 'Tanzania,' ) $country = 'TZ'; // Tanzania, United Republic of
if( $country_code == 'Thailand' ) $country = 'TH';
if( $country_code == 'Togo' ) $country = 'TG';
if( $country_code == 'Tokelau' ) $country = 'TK';
if( $country_code == 'Tonga' ) $country = 'TO';
if( $country_code == 'Trinidad' ) $country = 'TT'; // Trinidad and Tobago
if( $country_code == 'Tunisia' ) $country = 'TN';
if( $country_code == 'Turkey' ) $country = 'TR';
if( $country_code == 'Turkmenistan' ) $country = 'TM';
if( $country_code == 'Turks' ) $country = 'TC'; // Turks and Caicos Islands
if( $country_code == 'Tuvalu' ) $country = 'TV';
if( $country_code == 'Uganda' ) $country = 'UG';
if( $country_code == 'Ukraine' ) $country = 'UA';
/* Must to handle this issue */
if( $country_code == 'United' ) $country = 'AE'; // United Arab Emirates *
if( $country_code == 'United' ) $country = 'GB'; // United Kingdom *
if( $country_code == 'Uruguay' ) $country = 'UY';
if( $country_code == 'Uzbekistan' ) $country = 'UZ';
if( $country_code == 'Vanuatu' ) $country = 'VU';
if( $country_code == 'Venezuela' ) $country = 'VE';
if( $country_code == 'Vietnam' ) $country = 'VN';
if( $country_code == 'Virgin' ) $country = 'VG'; // Virgin Islands, British *
if( $country_code == 'Virgin' ) $country = 'VI'; // Virgin Islands, U.S. *
if( $country_code == 'Wallis' ) $country = 'WF'; // Wallis and Futuna
if( $country_code == 'Western' ) $country = 'EH'; // Western Sahara
if( $country_code == 'Yemen' ) $country = 'YE';
if( $country_code == 'Zambia' ) $country = 'ZM';
if( $country_code == 'Zimbabwe' ) $country = 'ZW';
if( $country_code == 'United' ) $country = 'US'; // United States *
if( $country_code == 'Nigeria' ) $country = 'NG';
if( $country_code == 'Congo,' ) $country = 'CD'; // Congo, the Democratic Republic of the
if( $country_code == 'Curaçao' ) $country = 'CUW';
if( $country_code == 'Guernsey' ) $country = 'GG';
if( $country_code == 'Holy' ) $country = 'VA'; // Holy See (Vatican City State)
if( $country_code == 'Isle' ) $country = 'IM'; // Isle of Man
if( $country_code == 'Jersey' ) $country = 'JE';
if( $country_code == 'Maldives' ) $country = 'MV';
if( $country_code == 'Saint Martin (French part)' ) $country = 'MF'; // Saint Martin (French part) *
if( $country_code == 'Sint' ) $country = 'PM'; // Sint Maarten (Dutch part)
if( $country_code == 'Somalia' ) $country = 'SO';
if( $country_code == 'Timor-Leste' ) $country = 'TL';
if( $country_code == 'United' ) $country = 'UM'; // United States Minor Outlying Islands *
if( $country_code == 'Kosovo' ) $country = 'XK';


$transaction_id = $qs_arr['transaction_id'];
$account_id = $qs_arr['account_id'];
$first_name = $qs_arr['first_name'];
$currency = $qs_arr['currency'];
$last_name = $qs_arr['last_name'];
$email_address = $qs_arr['email_address'];
$citizenship_country = $qs_arr['citizenship_country'];
$residence_country_postal = $qs_arr['residence_country_postal'];
$mobile_number = $qs_arr['mobile_number'];


//$fundingSourceName = 'BTC1';
$fundingSourceName = 'BTC3';
// $fundingSourceName = 'BTC4';

$returnUrl = 'https://clmforex.com/fail';

echo '<br/><br/><br/><br/>';


    // Initialize curl
    $curl = curl_init();
    $data = array(

                'firstName' =>$first_name,
                'lastName' => $last_name,
                'clientId' => $account_id,
                'currency' => $currency,
                'amount' => $amount,
                'fundingSourceName' => $fundingSourceName,
                'returnUrl' => $returnUrl,
            ); // Post Data                               
    //$data_string = json_encode($data); 



    // Configure curl options
    $opts = array(
        CURLOPT_URL             => 'https://qpg.clmforex.com/preparePost',
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_CUSTOMREQUEST   => 'POST',
        CURLOPT_CONNECTTIMEOUT  => 20,
        CURLOPT_POST            => true,
        //CURLOPT_POSTFIELDS      => 'firstName=Dany&lastName=Can&clientId=007&currency=USD&amount=50.00"."fundingSourceName=".$fundingSourceName."&returnUrl=https://clmforex.com/fail/"'
        CURLOPT_POSTFIELDS  => $data,

    );

    // Set curl options
    curl_setopt_array($curl, $opts);

    // Get the results
    $result = curl_exec($curl);

    // Close resource
    curl_close($curl);

    echo $result;






echo '<br/>';
$dataQP = json_decode($result, true);

echo $dataQP['mcTxId'];echo '<br/>';
echo $dataQP['secretId'];echo '<br/>';


// QubePay direction
header("Location: https://qpg.clmforex.com/BTC3/Start?"."mcTxId=".$dataQP['mcTxId']."");
exit;


//http://localhost/payments/qpg/qpg4.php

//exit;



/*

http://localhost/payments/qpg/btc3.php?account_id=20830%first_name=Maya%last_name=Solombrino%20-%20Test%email_address=accounting@clmforex.com%residence_country=Brazil%citizenship_country=Guatemala%residence_country_postal=-----%mobile_number=34637732704%amount=50.5700%currency=USD%funding_source_id=137%transaction_id=121184%funding_source_name=Credit%20Card%20%organization_id=144

*/


?>