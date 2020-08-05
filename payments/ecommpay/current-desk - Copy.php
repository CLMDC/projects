<?php
$query_string = $_SERVER['QUERY_STRING'];
$query_string = str_replace( '%', '&', $query_string );
parse_str( $query_string, $query_vars );


echo '<pre>';
var_dump( $query_vars );
echo '</pre>';


//echo ' Hi '.$query_vars['first_name'].' your emailID is '.$query_vars['email_address']; 

//echo $query_vars['payment_amount'];echo '<br/>';


echo $query_vars['account_id'];echo '<br/>';
echo $query_vars['first_name'];echo '<br/>';
echo $query_vars['last_name'];echo '<br/>';
echo $query_vars['email_address'];echo '<br/>';
echo $query_vars['residence_country'];echo '<br/>';
echo $query_vars['citizenship_country'];echo '<br/>';
echo $query_vars['residence_country_postal'];echo '<br/>';
echo $query_vars['mobile_number'];echo '<br/>';
echo $query_vars['amount'];echo '<br/>';
echo $query_vars['currency'];echo '<br/>';
echo $query_vars['funding_source_id'];echo '<br/>'; // I don't know
echo $query_vars['transaction_id'];echo '<br/>';
echo $query_vars['funding_source_name'];echo '<br/>'; // Credit card fix with the formatting %20
echo $query_vars['organization_id'];echo '<br/>';


// Store vars from Current Desk
$account_id = $query_vars['account_id'];
$first_name = $query_vars['first_name'];
$last_name = $query_vars['last_name'];
$email_address = $query_vars['email_address'];
$residence_country = $query_vars['residence_country'];
$citizenship_country = $query_vars['citizenship_country'];
$residence_country_postal = $query_vars['residence_country_postal'];
$mobile_number = $query_vars['mobile_number'];
$amountBF = $query_vars['amount'];

// Quit the point and comma
$amountWP = str_replace(str_split(",."),"",$amountBF);
//$amountWP = str_replace(".","",$amountBF);

//$amountWP = str_replace(",","",$amountBF);

echo $amountWP;
// Pass to a var
$amountWPoint = $amountWP;

// Quit the last 2 00's
$amountQL2D = substr($amountWPoint, 0, -2);
// Pass to a var
$amount = $amountQL2D;

echo $amount;



$currency = $query_vars['currency'];
$funding_source_id = $query_vars['funding_source_id'];
$transaction_id = $query_vars['transaction_id'];
$funding_source_name = $query_vars['funding_source_name'];
$organization_id = $query_vars['organization_id'];


// Assign vars from CD to Ecommpay
$close_on_missclick = '1=true';
$customer_first_name = $first_name;
$customer_last_name = $last_name;
$customer_phone = $mobile_number;
$force_payment_method = 'card';
$is_test = '1';
$language_code = 'en'; //language of ecommpay
$payment_amount = $amount;
$payment_currency = $currency;
$payment_description = $account_id;
$payment_id = $transaction_id;
//$project_id = '2090';
$project_id = '2089';
$region_code = 'US';



$toString = 'close_on_missclick:'.'1=true'.";".
			'customer_first_name:'.$customer_first_name.";".
			'customer_last_name:'.$customer_last_name.";".
			'customer_phone:'.$customer_phone.";".
			'force_payment_method:'.$force_payment_method.";".
			'is_test:'.$is_test.";".
			//'is_test:'.'is_test'.";".
			'language_code:'.$language_code.";".
			'payment_amount:'.$payment_amount.";".
			'payment_currency:'.$payment_currency.";".
			'payment_description:'.$payment_description.";".
			//'payment_description:'.parse_str($query_vars['payment_description']).";".
			'payment_id:'.$payment_id.";".
			'project_id:'.$project_id.";".
			'region_code:'.$region_code
			; 
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';


echo $toString;echo '<br/>';
//echo ' Hi '.$query_vars['first_name'].' your emailID is '.$query_vars['email_address']; 


;
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
//customer_first_name:

//string ( $account_id, $first_name );

echo '<strong>Automatic</strong/>';
echo '<br/>';

// 2089
$key = "d85515ede08df68071032d27907e896680f12594a328afa9cd00fd3820b66cad1b09e742085d56546ad2441faee63f7abb8ff7418f6da9650e72fceb4e85ca4e";

// 2090
//$key = "af51d7c1231907e445362aab60be2d176315e0cff07a5c17d8416fbac87aa8db68f740404403255dfc88c3aba88bfc43c5362f23f6b27faed1adfd65e72c8a7a";


// Here build the signature according with the parameters and the secret key.
$sign = hash_hmac('sha512', "$toString", "$key", true);
echo base64_encode($sign);

echo '<br/>';echo '<br/>';
echo '<strong>Transforming URL to avoid errors</strong/>';
echo '<br/>';
//$TUrl = str_replace( '+', '%2B', $sign );

echo '<br/>';
$ConvertUrl = base64_encode($sign);

$newuri2 = str_replace("+","%2B",$ConvertUrl);
echo $newuri2;


// Store signature into a var
$sign = $newuri2;
echo '<br/>';
echo '<strong>Signature store as a parameter</strong/>';
echo '<br/>';
echo $sign;


echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';


$s = hash_hmac('sha512', "close_on_missclick:1=true;customer_first_name:Dany;customer_last_name:Can;customer_phone:0000-0000;force_payment_method:card;is_test:1;language_code:ru;payment_amount:1990000;payment_currency:USD;payment_description:10002;payment_id:106205;project_id:2089;region_code:US", "af51d7c1231907e445362aab60be2d176315e0cff07a5c17d8416fbac87aa8db68f740404403255dfc88c3aba88bfc43c5362f23f6b27faed1adfd65e72c8a7a", true);


echo base64_encode($s);



/*
Login: g2_583
Password: YzI5Mzk0
URL: https://g2_583:YzI5Mzk0@pay188pay.com/g2



https://active_domain.com/payment?project_id=0&payment_amount=100&
payment_id=70872663&payment_currency=USD&
signature=YWb6Z20ByxpQ30hfTIjaCCsVIwVynXV%2BVLe



https://<user>:<password>@<healthcheck.com>/g2,
*/



// PAYMENT PAGE
/*
header("Location: https://paymentpage.accentpay.com/payment?"."signature=".$sign."&payment_id=".$payment_id."&payment_amount=".$payment_amount."&payment_currency=".$payment_currency."&project_id=".$project_id."&payment_description=".$payment_description."&region_code=".$region_code."&language_code=".$language_code."&force_payment_method=".$force_payment_method."&customer_phone=".$customer_phone."&customer_last_name=".$customer_last_name."&customer_first_name=".$customer_first_name."&is_test=".$is_test."&close_on_missclick=".$close_on_missclick);
exit;
*/

// CASHIER PAGE
header("Location: https://cashier.paywallk.com/payment?"."signature=".$sign."&payment_id=".$payment_id."&payment_amount=".$payment_amount."&payment_currency=".$payment_currency."&project_id=".$project_id."&payment_description=".$payment_description."&region_code=".$region_code."&language_code=".$language_code."&force_payment_method=".$force_payment_method."&customer_phone=".$customer_phone."&customer_last_name=".$customer_last_name."&customer_first_name=".$customer_first_name."&is_test=".$is_test."&close_on_missclick=".$close_on_missclick);
exit;


// G2 PAY NEW URL
/*
header("Location: https://g2_583:YzI5Mzk0@pay188pay.com/g2?"."signature=".$sign."&payment_id=".$payment_id."&payment_amount=".$payment_amount."&payment_currency=".$payment_currency."&project_id=".$project_id."&payment_description=".$payment_description."&region_code=".$region_code."&language_code=".$language_code."&force_payment_method=".$force_payment_method."&customer_phone=".$customer_phone."&customer_last_name=".$customer_last_name."&customer_first_name=".$customer_first_name."&is_test=".$is_test."&close_on_missclick=".$close_on_missclick);

exit;
*/


// ANOTHER NEW URL
/*
header("Location: https://g2_583:YzI5Mzk0@healthcheck.com/g2?"."signature=".$sign."&payment_id=".$payment_id."&payment_amount=".$payment_amount."&payment_currency=".$payment_currency."&project_id=".$project_id."&payment_description=".$payment_description."&region_code=".$region_code."&language_code=".$language_code."&force_payment_method=".$force_payment_method."&customer_phone=".$customer_phone."&customer_last_name=".$customer_last_name."&customer_first_name=".$customer_first_name."&is_test=".$is_test."&close_on_missclick=".$close_on_missclick);

exit;

*/

/*

clmforex.net/wp-content/uploads/legal-documents/current-desk.php

English
https://paymentpage.accentpay.com/payment?signature=H%2BW8QfObc49CSJSg21YP3KBrO5tiqtYhaUIJOx%2BdDvfT6XfDjt8GBr9x9V7zNCmQuRFrSJElRiwisRFoiUc0Wg==&payment_id=109259&payment_amount=5000&payment_currency=USD&project_id=2090&payment_description=10002&region_code=US&language_code=en&force_payment_method=card&customer_phone=0000-0000&customer_last_name=Can&customer_first_name=Dany&is_test=1&close_on_missclick=1=true

http://localhost/cc/current-desk.php?signature=H%2BW8QfObc49CSJSg21YP3KBrO5tiqtYhaUIJOx%2BdDvfT6XfDjt8GBr9x9V7zNCmQuRFrSJElRiwisRFoiUc0Wg==&payment_id=109259&payment_amount=5000&payment_currency=USD&project_id=2090&payment_description=10002&region_code=US&language_code=en&force_payment_method=card&customer_phone=0000-0000&customer_last_name=Can&customer_first_name=Dany&is_test=1&close_on_missclick=1=true


Spanish
https://paymentpage.accentpay.com/payment?signature=T3ghYgCSgcnqLIPaormzKSyRv4Hc7e32QisNzZQYdDZ9sBihutyrXU3bDHDPkJ1Em44A8zFilMBt4nOVIf1CEg==&payment_id=109260&payment_amount=50,00&payment_currency=USD&project_id=2090&payment_description=10002&region_code=US&language_code=en&force_payment_method=card&customer_phone=0000-0000&customer_last_name=Can&customer_first_name=Dany&is_test=1&close_on_missclick=1=true

http://localhost/cc/current-desk.php?signature=T3ghYgCSgcnqLIPaormzKSyRv4Hc7e32QisNzZQYdDZ9sBihutyrXU3bDHDPkJ1Em44A8zFilMBt4nOVIf1CEg==&payment_id=109260&payment_amount=50,00&payment_currency=USD&project_id=2090&payment_description=10002&region_code=US&language_code=en&force_payment_method=card&customer_phone=0000-0000&customer_last_name=Can&customer_first_name=Dany&is_test=1&close_on_missclick=1=true


Portuguese
https://paymentpage.accentpay.com/payment?signature=o2a1u4Gv3S%2BOsIvPbfF3um1QhiOtlulHGXfd35JDuZM/DIjJUBVGNbEsEHagi6OLdOBq3uOVEH/a%2BjpBo9Au2A==&payment_id=109261&payment_amount=50,00&payment_currency=USD&project_id=2090&payment_description=10002&region_code=US&language_code=en&force_payment_method=card&customer_phone=0000-0000&customer_last_name=Can&customer_first_name=Dany&is_test=1&close_on_missclick=1=true



*/

/*
Ecommpay									->					CD

payment_id: 247736												transaction_id
payment_amount: 10000											amount
payment_currency: USD 											currency
project_id: 2090 												[The same]
payment_description: Nothig to put 								account_id
region_code: US 												[The same]						
language_code: en 												[The same]
force_payment_method: card 										[The same]	
customer_phone: 7499123456s7 									mobile_number
customer_last_name: Can 										last_name									
customer_first_name: Dany 										first_name
is_test: 1 														[The same]
close_on_missclick: 1=true 										[The same]
*/

?>

