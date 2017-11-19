<html>
    <head>
        <meta charset="UTF-8">
        <title>Close Account</title>
        <style>
            input {
                margin-bottom: 0.5em;
            }
        </style>
    </head>
    <body>
	<?php

		if (isset($_SESSION['user_ID']))
		{
			echo "<h3>Are you sure you want to close your account?</h3>";        
			echo "<p style='color: red'><span class='error'><?php echo $log_error; ?></span></p>";
			echo "<form method='post' action='delete_account.php'>";
				echo "<input type='submit' value='Yes'>";
			echo "</form>";

		}
		// if not, show message and link to home page
		else 
		{
			echo "<p>You are currently logged out. Please <a href='login.php'>click here</a> to log in.</p>";
		}
?>  
	</body>
</html>