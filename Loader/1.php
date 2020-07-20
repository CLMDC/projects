<?php

// Pass data to video form

session_start();

if (isset($_GET['UserName'])) {
    $UserName = $_POST['UserName'];
}else{
    $UserName = "";
}


if (isset($_GET['Password'])) {
    $Password = $_POST['Password'];
}else{
    $Password = "";
}


$_SESSION['UserName'] = $UserName;
$_SESSION['Password'] = $Password;

?>

<form method="post" action="2.php">
    <input type="text" name="UserName" value="">
    <input type="text" name="Password" value="">
    <input type="submit">
</form>