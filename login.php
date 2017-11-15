<!--// this is a log in file for BullyPool by Deepak Chapagain
// Date: 11/06/2017-->

<!DOCTYPE html>
<html>
    <title>BullyPool</title>
	<head>
		<meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<title>login</title>
		                
            <div class="w3-top">
              <div class="w3-bar w3-light-grey w3-card w3-left-align w3-large">
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
                <a href="home_page.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
                <a href="forgot_pw.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Forgot password</a>
                <a href="signup.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Register</a>
              </div>
            </div>
        <header class="w3-container w3-black w3-center" style="padding:128px 16px">
            <h1 class="w3-margin w3-jumbo">BULLYPOOL</h1>
            <p class="w3-xlarge">Welcome! to the BullyPool, a place to find your travel companion.</p>
            <span style="font-style:italic; font-weight:bold;">Happy BullyPooling!! (^_^)</span>
        </header>

	</head>
	<body bpcolor="maroon" text="#f44256">
		
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
			if (isset($_POST['user_pw'])) $temp_pw = sanitizeString($_POST['user_pw']);
			
			// log into the database to verify user details
			require_once'database_login.php';
			$conn = new mysqli($hn,$un,$pw,$db); //check this
			if($conn->connect_error) die($conn->connection_error);
			// if connection is good, then make query
			$query = "SELECT * FROM bullypool WHERE user_ID='$user_ID'";
			$result = $conn->query($query);
			// if there is a result ( databse for the user exist)
			if(!$result) die($conn->error);
			if($result->num_rows)
			{
				//echo "hi";
				// Since the database for the given user exist, fetch the contains
				if($result->fetch_array(MYSQLI_ASSOC));
				//$salt1 = "qm&h*";
				//$salt2 = "pg!@";
				//$token = hash('ripemd128',"$salt1$temp_pw$salt2");
				$token = $temp_pw;
				// verify user_ID and password are valid
				if($temp_ID==$row['user_ID'] && $token == $row['user_pw'])
				{
					// since the user_ID and user_pw matched, user is now logged in. Start session and save the details.

					session_start();
					$_SESSION['user_ID'] = $row['user_ID'];
					$_SESSION['isAdmin'] = $row['isAdmin'];
					// based on the user type redirect to the respective pages
					if($row['isAdmin']=='1')
					{
						echo "It works";
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
		

		<!---// error message-->
		

        <!--//Create HTML form-->
        <div class="w3-row-padding w3-padding-64 w3-container">
        <div class="w3-content">
        <div class="w3-twothird">
		<form method="post" action="login.php">
			<label>  user_ID :</label>
                        <input type="text" name="user_ID" value="<?php echo"$temp_ID" ?>"><br><br>
			<label>Password: </label>
				<input type="password" name="user_pw"><br>
				<input type="Submit" value="login"><br>
			<label>Remember Login</label>
            	<input type="checkbox" value="checked">
		</form>
        </div>

        <div class="w3-third w3-center">
        </div>
        </div>
        </div>

        <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
        <h5>All right reserved. Follow us on facebook at BullyPool page.</h5>
         <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
        </footer>
    </body>
</html>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

<!--// useful PHP functions -->
<?php
    if ($error == 'true')
    {
        ?><p style="color: red"><?php echo"The username / password combination is not correct.</p>";
    }
?>
<?php
function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}
?>