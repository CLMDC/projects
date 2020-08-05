<?php



if(isset($_POST['submitToRedirect'])) {


        // Live URL
        //$yourURL="/sign-in-live-account/";        
        // Local URL
        $yourURL="/sign-in-r.php";  
        echo ("<script>location.href='$yourURL'</script>");

}

?>

<!DOCTYPE html>
<html>
<head>
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



    <style type="text/css">
        .btn.btn-success {
            background-color: #2cc482 !important;
            padding-top: 15px;
            padding-bottom: 15px;
            /* width: 49% !important; */
            /* width: 38.8% !important; */
            border-radius: 8px !important;
        }
    </style>
</head>
<body style="background-color: #061946 ">




<form method="POST">

                            <input data-val="true" data-val-number="The field AccountType must be a number." data-val-required="The AccountType field is required." id="accountype" name="AccountType" type="hidden" value="2">
                            <?php

                            //send data
                            session_start();
                            if(array_key_exists('submitToRedirect',$_POST))

                            if (isset($_POST['UserName'])) {
                                $UserNameV=$_SESSION['UserName'];
                            }else{
                                $UserName = "";
                            }

                            if (isset($_POST['Password'])) {
                                $PasswordV=$_SESSION['Password'];
                            }else{
                                $Password = "";  
                            }
                                
                            //receive data  
                            $UserNameV=$_SESSION['UserName'];
                            $PasswordV=$_SESSION['Password'];

                            //echo $r;
                            ?>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="email" type="text" value="<?php echo $UserNameV; ?>" name="UserName" autocomplete="off" class="form-control" placeholder="Email address" required="required" data-error="Valid email is required." >                              

                                    <span class="error"><?php if (isset($emailError)) echo $emailError ?></span> 
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="pwd" type="text" value="<?php echo $PasswordV; ?>" name="Password" autocomplete="off" class="form-control">                                 
                                </div>
                            </div>



                            <div class="col-md-12">
                                <!-- Only add the vars to auto populate -->
                                <center>
                                    <input style="color: #fff; font-family: avenir-regular; font-weight: 500;  font-size: 20px;" type="submit" name="submitToRedirect" class="btn btn-success btn-send" value="Access your client portal" onclick="PassDataToAutoLogin();">  
                                </center>
                            </div>
</form>
</body>
</html>