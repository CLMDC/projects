<?PHP


if(isset($_POST['submit'])) {


//'account-language-id' => $_POST['account-language-id'], 
$beneficiaryFirstName = $_POST['beneficiaryFirstName']; 
$beneficiaryLastName = $_POST['beneficiaryLastName'];
$PayoutBeneficiaryTypeCode = $_POST['PayoutBeneficiaryTypeCode'];
$documentType = $_POST['documentType'];
$documentNumber = $_POST['documentNumber'];
$email = $_POST['email'];
$currencyCode = $_POST['currencyCode'];
$country = $_POST['country'];
$bankName = $_POST['bankName'];
$accountNumber = $_POST['accountNumber'];
$amount = $_POST['amount'];
$payoutAccountTypeCode = $_POST['payoutAccountTypeCode'];
$NotificationUrl = 'https://payment-form.payretailers.com/';



//$amount = "2055";

$api_key = "9670";   
$password = "71deab6ec52cdeae9a4c9b13d3b717a3a16501322eba0e8515a50d346fddc310";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.gateway.payretailers.com/v2/payout",
  CURLOPT_RETURNTRANSFER => true,
  curl_setopt($curl, CURLOPT_USERPWD, $api_key.':'.$password),
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"
            {\n    \"beneficiaryFirstName\": \"$beneficiaryFirstName\",
             \n    \"beneficiaryLastName\": \"$beneficiaryLastName\",
             \n    \"PayoutBeneficiaryTypeCode\": \"$PayoutBeneficiaryTypeCode\",
             \n    \"documentType\": \"$documentType\",
             \n    \"documentNumber\": \"$documentNumber\",   
             \n    \"email\": \"$email\",            
             \n    \"currencyCode\": \"$currencyCode\",
             \n    \"country\": \"$country\",
             \n    \"bankName\": \"$bankName\",
             \n    \"accountNumber\": \"$accountNumber\",
             \n    \"amount\": \"$amount\",
             \n    \"payoutAccountTypeCode\": \"$payoutAccountTypeCode\",
             \n    \"NotificationUrl\": \"$NotificationUrl\"
            }",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);

$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//echo $statusCode;echo'<br/>';


curl_close($curl);
//echo $response;



//print_r($response);


if ($statusCode == 200) {
      // successful response - continue as planned.        
        $thk = 'Data created!';
        //echo "<center><p style='color:#ffffff; font-family: avenir-regular; font-size: 16px;'><strong> ".$thk." </strong></p></center>";
        
        echo "<center><p style='color:#ffffff; font-family: avenir-regular; font-size: 16px;'><strong> ".$thk." : ".$response." </strong></p></center>";
        
        //$api_key.':'.$password),

        //$yourURL="/sign-in/"; 
        //echo ("<script>location.href='$yourURL'</script>");

    }
    else {

        // $emailError = 'Something failed...';

        $emailError = 'Something failed...';
        echo "<center><p style='color:#FF0000; font-family: avenir-regular; font-size: 16px;'><strong> ".$emailError." </strong></p></center>";

    }


}

?>


<html>
<head>
    <title>Payouts - Core Liquidity Markets</title>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
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
      src: url(https://clmmultisites.wpengine.com/wp-content/uploads/2019/04/AvenirNextLTPro-Regular-1.woff;)
      /* background-color: #4281c6; */
    }

    

    body {
      font-family: avenir-regular !important;
      src: url(https://clmmultisites.wpengine.com/wp-content/uploads/2019/04/AvenirNextLTPro-Regular-1.woff;)
    }


    div .formStyle {
        border-radius: 8px;
        background-color: #fff;
        max-width: 100%;
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



    /*html, body { height:auto; } a.md-default-theme:not(.md-button), a:not(.md-button) { color:#000;}.input {max-width: 280px;}label{min-width:80px;}*/

    #header {
      min-height:100%;
      display:block; 
      /* background-image: url(https://www.clmforex.com/assets/images/login-new.jpg); */
      background-color: #061946;
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
        .error {
            color:red;
        }

        .success {
            color:green;
        }
</style>


<style type="text/css">
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
          width: 19% !important;
          float: right !important;
          border-radius: 8px !important;
          margin-right: 15px;
      }

</style>



<!-- input height & border colors -->
<style type="text/css">
  a:focus, a:active, select, input, input:hover, input:focus, input:active, textarea, textarea:hover, textarea:focus, textarea:active {
    -moz-outline: none;
    outline: none;
    height: 50px !important;
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

/* Center arrow in dropdown*/
  .select2-container--default .select2-selection--single .select2-selection__arrow b {
      margin-top: 8px;
  }



/* Label color, titles*/
label {
    color: #b1b1b1 !important;
    font-weight: normal !important;
    font-family: "avenir-regular", Sans-serif !important;
}

/* Disclaimer */


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
      content: "\f00c" !important;
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
      /* Responsive rules */
    @media only screen and (max-width: 375px) {
      div .formStyle {
      border-radius: 10px !important;
      /* background-color: #f2f2f2; */
      background-color: #fff;
      /* padding: 20px; */
      padding-left: 20px;
      padding-right: 20px;
      padding-bottom: 9px;
      padding-top: 35px;
      position: relative;
      /* max-width: 800px; */
      /* max-width: 600px; */
      width: 100%;
      /* height: 600px;  */
      /* height: 1030px;  */
      /* height: 800px; */
      /* height: 1360px; */
      height: 100% !important;       
      padding-bottom: 86px;
      margin: auto;
      top:25%;
      /* width: 75%; */
      }
    }
</style>


<style type="text/css">
  .row:before, .row:after{
 display: inline-block !important;
}
</style>
</head>


<style type="text/css">
    div.col-left {
      max-width: 50% !important;
    }


/*-- Cellphones --*/
    @media only screen and (max-width: 375px) {     
      div.col-left {
      max-width: 100% !important;
      }

      .btn.btn-success {
          background-color: #2cc482 !important;
          width: 50% !important;
          float: right !important;
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
          width: 50% !important;
          float: right !important;
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
          width: 50% !important;
          float: right !important;
      }


      .col-md-6 {
      /*-ms-flex: 0 0 50%;
      flex: 0 0 50%;*/
      max-width: 100% !important;
      padding-right: 15px !important;
      padding-left: 15px !important;

      }



    div.col-right {
      max-width: 100% !important;
    }
}    
</style>

<body style="background-color:#061946;">
  <div class="formStyle">
    <div class="ht">

      <center><h1 style="color: #1062bc !important"><strong>Payouts | PayRetailers</strong></h1><br/><br/></center>   
      <!-- <div class="col-left"> -->
      <!-- Left column -->
      <div class="col-sm-3 col-md-12 col-lg-12">
        
      <form action="" method="POST">

              <!-- <div class="col-md-6" style="padding-right: 5px;">  -->
              <div class="col-md-6"> 
                  <div class="form-group">
                      <input onkeypress="return /[a-z ]/i.test(event.key)" id="beneficiaryFirstName" type="text" name="beneficiaryFirstName" class="form-control" placeholder="First name*" required="required" data-error="Firstname is required." maxlength="32">
                      <div class="help-block with-errors"></div>
                  </div>
              </div>

              <div class="col-md-6"> 
                  <div class="form-group">
                      <input onkeypress="return /[a-z ]/i.test(event.key)" id="beneficiaryLastName" type="text" name="beneficiaryLastName" class="form-control" placeholder="Last name*" required="required" data-error="Lastname is required." maxlength="32">
                      <div class="help-block with-errors"></div>
                  </div>
              </div>




              <div class="col-md-6"> 
              <div class="form-group">
                  <select class="form-control" id="PayoutBeneficiaryTypeCode" name="PayoutBeneficiaryTypeCode" required>
                    <option value="">Payout beneficiary type code*</option>
                    <option value="person">Person</option>
                    <option value="company">Company</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6"> 
              <div class="form-group">
                  <select class="form-control" id="documentType" name="documentType" required>
                    <option value="">Document type*</option>
                    <option value="cl_rut">RUT</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6"> 
              <!-- <div class="col-md-6"> -->
                  <div class="form-group">
                      <input onkeypress="return /[a-zA-Z0-9 ]/i.test(event.key)" id="documentNumber" type="text" name="documentNumber" class="form-control" placeholder="Document number*" required="required" data-error="Document number is required." maxlength="9">
                      <div class="help-block with-errors"></div>
                  </div>
              </div>


              <div class="col-md-6">
                  <div class="form-group">
                      <input onkeypress="return /[a-zA-Z0-9 @.]/i.test(event.key)" id="email" type="email" name="email" class="form-control" placeholder="Email address*" required="required" data-error="Valid email is required.">                      
                      <div class="help-block with-errors"></div>
                  </div>
              </div>

               <!-- Hidden  currencyCode, country -->
              <input id="currencyCode" type="hidden" name="currencyCode" class="form-control" placeholder="" required="required" value="CLP">
              <input id="country" type="hidden" name="country" class="form-control" placeholder="" required="required" value="CL">



              <div class="col-md-6"> 
              <div class="form-group">
                  <select class="form-control" id="bankName" name="bankName" required>
                    <!-- <select class="form-control" id="sel1"> -->
                    <option value="">Bank name*</option>
                    <option value="12">Banco Del Estado De Chile</option>
                    <option value="504">Banco Bbva ( Bilbao Vizcaya Argentaria Chile) / Banco Bhif</option>
                    <option value="28">Banco Bice</option>
                    <option value="55">Banco Consorcio</option>
                    <option value="27">Banco Corpbanca</option>
                    <option value="1">Banco De Chile / Banco A. Edwards / Credichile / Citybank</option>
                    <option value="16">Banco De Crédito E Inversiones (BCI) / Tbanc</option>
                    <option value="507">Banco Del Desarrollo</option>
                    <option value="51">Banco Falabella</option>
                    <option value="9">Banco Internacional</option>
                    <option value="39">Banco Itau Chile / Bank Boston</option>
                    <option value="53">Banco Ripley</option>
                    <option value="57">Banco París</option>
                    <option value="37">Banco Santander – Santiago / Banco Santander / Banefe</option>
                    <option value="49">Banco Security</option>
                    <option value="672">Coopeuch</option>
                    <option value="31">Hsbc Bank (Chile)</option>
                    <option value="14">Scotiabank / Sud – Americano</option>
                  
                    
                  </select>
                </div>
              </div>


              <div class="col-md-6"> 
                  <div class="form-group">
                      <input onkeypress="return /[a-zA-Z0-9 ]/i.test(event.key)" id="accountNumber" type="text" name="accountNumber" class="form-control" placeholder="Account number*" required="required" data-error="Account number is required." maxlength="13">
                      <div class="help-block with-errors"></div>
                  </div>
              </div>

              <div class="col-md-6"> 
                  <div class="form-group">
                      <input id="amount" type="number" min="1" step="any" name="amount" class="form-control" placeholder="Amount CLP*" required="required" data-error="Amount is required.">
                      <div class="help-block with-errors"></div>
                  </div>
              </div>

              <div class="col-md-6"> 
              <div class="form-group">
                  <select class="form-control" id="payoutAccountTypeCode" name="payoutAccountTypeCode" required>
                    <option value="">Payout account type code*</option>
                    <option value="0001">Cuenta Corriente / Cueta Vista</option>
                    <option value="0002">Cuenta de ahorro</option>
                    <option value="0003">Chequera electrónica</option>
                    <option value="0004">Cuenta RUT</option>
                  </select>
                </div>
              </div>

             
      </div><!-- End div col-left -->   


<!-- <div class="col-right"> -->

<!-- 
<div class="col-sm-9 col-md-6 col-lg-6">                         
</div>  
-->

<!-- End col-right -->


                  <div class="col-md-12">
                    <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 20px;" type="submit" name="submit" class="btn btn-success btn-send" value="Send">
                  </div>
      </div><!-- ht -->
    </div><!-- formStyle -->
  </form>
</body>
</html>