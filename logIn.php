<?php

	if (isset($_POST['user'])) {
	  	# code...
	    
	$user = $_POST['userid'];
	$passwd = $_POST['passwd'];
		}
	echo"<form method='post'>
	User id:<input type='text' name='userid'><br>
	Password:<input type='password' name='passwd'><br>
	<input type='submit' value='LOG IN'>
	</form>";
?>