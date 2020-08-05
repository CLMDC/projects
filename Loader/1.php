<?php
	if(isset($_POST['submit2'])) {
			$yourURL="2.php";
	        echo ("<script>location.href='$yourURL'</script>");
	}
?>




<!-- <form method="post" action="2.php"> -->
 <form method="post"> 
    <input type="text" name="UserName" value="">
    <input type="text" name="Password" value="">
    <input type="submit" id="" name="submit2">
</form>