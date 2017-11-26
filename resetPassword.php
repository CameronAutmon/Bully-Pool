<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BullyPool Reset Password</title>

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
                    
            <div class="w3-top">
              <div class="w3-bar w3-light-grey w3-card w3-left-align w3-large">
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
                <!-- navigation-->
                <a href="home_page.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
                <a href="login.php" class="w3-bar-item w3-button w3-padding-large w3-white">Login</a>
                <a href="Sign_up.php" class="w3-bar-item w3-button w3-padding-large w3-white">Register</a>
              </div>
            </div>
        <header class="w3-container w3-black w3-center" style="padding:128px 16px">
            <h1 class="w3-margin w3-jumbo">BULLYPOOL</h1>
            <p class="w3-xlarge">Welcome! to the BullyPool, a place to find your travel companion.</p>
            <span style="font-style:italic; font-weight:bold;"</span>
        </header>
    </head>
    <body>

		<?PHP
		// varaibles 
		$user_ID = $user_pw = $new_pw = $old_pw = $user_pw1 = $user_pw2 = $pw_temp ='';
		error_reporting(E_ALL);
		ini_set('display_error', 1);

		// check if user is already logged in
		session_start();
		if(isset($_SESSION['user_ID']))
		{
			$user_ID = $_SESSION['user_ID'];
		}
		else
		{
			if(isset($_POST['user_ID'])) $user_ID = sanitizeString($_POST['user_ID']);
			if(isset($_POST['user_pw'])) $pw_temp = sanitizeString($_POST['user_pw1']);
			if(isset($_POST['user_pw'])) $pw_temp = sanitizeString($_POST['user_pw2']);
			if ($user_pw1 != $user_pw2)
			{
				echo "Error! Password did not match. Please try again.";
				//header('Location: resetPassword.php');
		        //exit();
			}
			// hash the  password
			$salt1 = "qm&h*";
		    $salt2 = "pg!@";
		    $new_pw = hash('ripemd128',"$salt1$pw_temp$salt2");

		}

		//
		if ($user_ID !="")
		{
			require_once'database_login.php';
			$conn = new mysqli($hn,$un,$pw,$db);
			if($conn->connect_error) die($conn->connect_error);
			// if connection is good
			$query ="SELECT * FROM user_Table WHERE user_ID = $temp_ID";
			$result = $conn->query($query);
			if(!$result) die($conn->error);
			if($result->num_rows)
			{
				// fetch the contains of the database
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$old_pw = $row['user_pw'];
				// security question goes here if any
				$query1 = "UPDATE user_Table";	//table name
				$query2 = "SET user_pw = REPLACE(user_pw, $old_pw, $new_pw) WHERE user_pw = $old_pw";
				$conn->query($query1);
				$conn->query($query2);
				if ($row['user_pw']==$new_pw)
				{
					echo "Password updated successfully......";
					//header('Location: login.php');
					//exit();
				}else{
					echo "Error occurred. Please try again.";
				}
			}
		}

		?>

		<div class="w3-row-padding w3-padding-64 w3-container">		
        <div class="w3-content">
        <div class="w3-twothird">
        	<h3> Enter your new password.</h3>
        <form method="post" action="resetPassword.php">
            <!--<label>Username: </label>
            <input type="text" name="user_ID" value="<?php //echo"$un_temp" ?>"> <br>-->
            <label>Password: </label>
            <input type="password" name="user_pw1" > <br><br>
            <label>Confirm Password: </label>
            <input type="password" name="user_pw2" > <br>
            <input type="submit" value="Submit">
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


<?php
function sanitizeString($var)
  {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
  }
?>