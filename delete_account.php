<html>
    <head>
        <title>Logged Out</title>
    </head>
	<body>
<?php
        session_start();
		if (isset($_SESSION['user_ID'])){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		require_once 'login.php';
		$connection = new mysqli($hn, $un, $pw, $db);
		if ($connection->connect_error)
		{
			die($connection->connect_error);
		}
		
		$account_user = $_SESSION["userID"];
		$query  = "DELETE FROM user_Table WHERE username = $account_user";
		$result = $connection->query($query);
		$connection->close();
		$_SESSION = array();
		setcookie(session_name(), '', time() - 3000000, '/');
		session_destroy();
		header('Location: home_page.html');
		}
		}
		else
		{
			echo "You are not logged in. Please <a href='login.php'>click here</a> to log in.";
		}
		?>
		</body>
		</html>