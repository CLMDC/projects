<?php

session_start();

$UserName = $_POST['UserName'];
$Password = $_POST['Password'];

echo "Your registration is: ".$UserName.".";echo '<br />';
echo "Your registration is: ".$Password.".";

?>

<input type="text" name="UserName" value="<?php echo $UserName; ?>" />
<input type="text" name="Password" value="<?php echo $Password; ?>" />

<p><a href="set_reg.php">Back to set_reg.php</a>