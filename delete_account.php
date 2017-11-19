<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		require_once 'login.php';
		$connection = new mysqli($hn, $un, $pw, $db);
		if ($connection->connect_error)
		{
			die($connection->connect_error);
		}
		
		//$account_user = $_POST["userID"];
		$account_user = "HaloMan";
		$query  = "DELETE FROM user_Table WHERE username = $account_user";
		$result = $connection->query($query);
		$connection->close();
		header('Location: home_page.html');
		}
		?>