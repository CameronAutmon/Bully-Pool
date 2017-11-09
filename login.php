// this is a log in file for BullyPool by Deepak Chapagain
// Date: 11/06/2017

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>BullyPool</title>
		<style>
			input{
				margin-bottom:0.5em;
			}
			h1{
		        color: red;
		        background: lightyellow;
		        border: 1px solid;
		        padding: 50px;
	    	}
	    	h5{
		        color: red;
		        background: lightyellow;
		        border: 1px solid;
		        padding: 10px;
		    }
		</style>

	</head>
	<body bpcolor="#99CCFF" text="#f44256">
		<center><h1>BullyPool</h1></center>

		<strong>
                <p class="Welcome">Welcome to the BullyPool, a place to find your travel companion.</p></strong><p>Please log in using the following form to enjoy the services we provide. If you don't have account yet, create an account by clicking register link. Thanks!</p>

        <div class="wrapper">
            <div class="flex-container"></div>
            <div class="box one">
                <p><a href="register.php">Register</a></p>
                <p><a href="Forgotpw.php">Forgot password</a></p>
                <p><a href="Home.php"> Home</a></p>
                <div class="box two">
                

            </div>
            </div>
            
        </div>

		<?php
		
		error_reporting(E_ALL);
		ini_set('display_error', 1);

		// check if user is already logged in
		session_start();
		if(isset($_SESSION['user_ID']) && (isset($_SESSION['isAdmin'])))
		{
			$user_ID = $_SESSION['user_ID'];
			$admin = $_SESSION['isAdmin'];
			// redirect user based on type
			if($type)
			{
				header('Location: admin_page.php');
				exit();
			}else{
				header('Location: user_page.php');
			}
		}
		// check if user_ID and password provided
		else
		{
			if (isset($_POST['user_ID'])) $temp_ID = sanitizeString($_POST['user_ID']);
			if (isset($_POST['password'])) $temp_pw = sanitizeString($_POST['password']);
			
			// log into the database to verify user details
			require_once'database_login.php';
			$conn = new mysqli($hn,$un,$pw,$db); //check this
			if($conn->connect_error) die($conn->connection_error);
			// if connection is good, then make query
			$query = "SELECT * FROM bullypool WHERE use_ID='$user_ID'";
			$result = $conn->query($query);
			// if there is a result ( databse for the user exist)
			if(!$result) die($conn->error);
			if($result->num_rows)
			{
				// Since the database for the given user exist, fetch the contains
				if($result->fetch_array(MYSQLI_ASSOC));
				$salt1 = "qm&h*";
				$salt2 = "pg!@";
				$token = hash('ripemd128',"$salt1$temp_pw$salt2");
				// verify user_ID and password are valid
				if($temp_ID==$row['user_ID'] && $token == $row['user_pw'])
				{
					// since the user_ID and user_pw matched, user is now logged in. Start session and save the details.
					session_start();
					$_SESSION['user_ID'] = $row['user_ID'];
					$_SESSION['isAdmin'] = $row['isAdmin'];
					// based on the user type redirect to the respective pages
					if($row['isAdmin']=='True')
					{
						header('Location: admin_page.php');
						exit();
					}else{
						header('Location: user_page.php');
						exit();
					}
				// if user entered data donot match with database data, report error.
				}else{
					$error = 'True';
					$conn->close();
					$result->close();
				}
			//if empty table in the database
			}else{
				$error = 'True';
				$conn->close();
				$result->close();
			}
		} // close else

		?> <!--// close php

		// make a HTML form-->
		<h1>Welcome to <span style="font-style:italic; font-weight:bold; color:maroon">
				BullyPool login page</span>!</h1>

		<!---// error message-->
		<?php
	       if ($error == 'true')
	       {
	           ?><p style="color: red"><?php echo"The username / password combination is not correct.</p>";
	       }
        ?>

        <!--//Create HTML form-->
		<form method="post" action="login.php">
			<label> User_ID: </label>
				<input type="text" name="user_ID" value="<?php echo"$temp_ID" ?>"><br>
			<label>Password: </label>
				<input type="password" name="user_pw"><br>
				<input type="submit" name="login"><br>
			<label>remember login</label>
            	<input type="checkbox" value="remember">
		</form>

	<br>
    <br>
    <br>
    <br>
    <h5>All right reserved. Follow us on facebook at BullyPool page.</h5>

	</body>
</html>

<!--// useful PHP functions -->
<?php
function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}
