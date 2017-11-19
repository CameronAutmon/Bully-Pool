<html>
<title>Home Page</title>
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
<body>
<?php
session_start();
if (isset($_SESSION['user_ID']))
	{
	// top bar
	echo "<div class='w3-top'>";
	echo  "<div class='w3-bar w3-light-grey w3-card w3-left-align w3-large'>";
	echo    "<a class='w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red' href='javascript:void(0);' onclick='myFunction()' title='Toggle Navigation Menu'><i class='fa fa-bars'></i></a>";
	echo    "<a href='home_page.html' class='w3-bar-item w3-button w3-padding-large w3-white'>Home</a>";
	echo    "<a href='Travel_Request_Form.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Travel</a>";
	echo    "<a href='profilePage.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Profile</a>";
	echo    "<a href='account_settings.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Account Settings</a>";
	echo    "<a href='logout_page.php' class='w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white'>Sign Out</a>";
	echo  "</div>";
	echo "</div>";
	
	echo "<header class='w3-container w3-black w3-center' style='padding:128px 16px'>";
	    echo "<h1 class='w3-margin w3-jumbo'>Account Settings</h1>";
	echo "</header>";
	
	echo "<a href='#' class='w3-bar-item w3-button'>Reset Password</a>";
    echo "<a href='close_account.php' class='w3-bar-item w3-button'>Close Account</a>";

}
// if not, show message and link to home page
else 
{
	echo "<p>You are currently logged out. Please <a href='login.php'>click here</a> to log in.</p>";
}
?>
</body>
</html>
