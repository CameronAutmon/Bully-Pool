<!DOCTYPE html>
<html>
    <head>
        <title>Logged Out</title>
    </head>
    <?php
        // remove session and session cookie
		//if (isset($_SESSION['username'])
		//{
        //$_SESSION = array();
		//setcookie(session_name(), '', time() - 3000000, '/');
		//session_destroy();
		//}
    ?> 
    <body>
        <h1>Logged Out</h1>
        <p>
            You are now logged out of the website.
        </p>
        <p>
            <a href="login.php">Log in</a> again.
        </p>
    </body>
</html>