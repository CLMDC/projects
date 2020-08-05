<?php

//receive data.
session_start();
$UserNameV=$_SESSION['UserName'];
$PasswordV=$_SESSION['Password'];
//echo $r;
?>
<input type="text" name="UserName" value="<?php echo $UserNameV; ?>" />
<input type="text" name="UserName" value="<?php echo $PasswordV; ?>" />