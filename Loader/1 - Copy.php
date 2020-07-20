<?php

session_start();

$_SESSION['UserName'] = $UserName;
$_SESSION['Password'] = $Password;

?>

<form method="get" action="2.php">
    <input type="text" name="UserName" value="">
    <input type="text" name="Password" value="">
    <input type="submit">
</form>