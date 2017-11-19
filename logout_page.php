<html>
    <head>
        <title>Logged Out</title>
    </head>
    <body>
	 <?php
        // remove session and session cookie
		session_start();
		if (isset($_SESSION['user_ID']))
		{
        $_SESSION = array();
		setcookie(session_name(), '', time() - 3000000, '/');
		session_destroy();
    
        echo "<h1>Logged Out</h1>";
        echo "<p>You are now logged out of the website.</p>";
        echo "<p><a href='login.php'>Log in</a> again.</p>";
		}
		else
		{
			header('Location: home_page.html');
		}
		?> 
    </body>
</html>