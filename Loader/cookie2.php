<?php

//send data
session_start();
if(array_key_exists('submit3',$_POST))

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
<input type="text" name="UserName" value="<?php echo $UserNameV; ?>" />
<input type="text" name="UserName" value="<?php echo $PasswordV; ?>" />

<input type='submit' name='submit3' value='send my info'>