<?php
session_start();
if(array_key_exists('submit2',$_POST))

if (isset($_POST['UserName'])) {
    $_SESSION['UserName']=$_POST['UserName'];
}else{
    $UserName = "";
}

if (isset($_POST['Password'])) {
    $_SESSION['Password']=$_POST['Password'];
}else{
    $Password = "";    
}

?>
<html>
<form  method="post">
<input type='text' name="UserName">
<input type='text' name="Password">
<input type='submit' name='submit2' value='send my info'>
</html>