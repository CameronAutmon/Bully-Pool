<!DOCTYPE html>
<html>
<title>User Page</title>
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

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-light-grey w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="home_page.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="Travel_Request_Form.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Create Travel Request Form</a>
    <a href="account_settings.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">View History</a>
    <a href="profilePage.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Profile Page</a>
    <a href=" account_settings.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Account Settings</a>
    <a href="" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Logout</a>
  </div>
</div>

<!-- First Grid -->
<?php
        session_start();
        // is an User logged in?
        if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $forename = $_SESSION['forename'];
            $surname  = $_SESSION['surname'];
            $type = $_SESSION['type'];

            if($type != 'admin')
            {
                echo "Welcome back $forename <br><br>";   

                // if so, show Admin content
                echo "Placeholder for User content<br><br>";
                
                //if not, show message and link to login form
                echo "<a href='logout_page.php'>logout </a> of website.";
            }
            else
            {
                header('Location: login_page.php');
                exit();
            }
        }
        else 
        {
            echo "<a href='logout_page.php'>logout</a> of website.";  
        }
?>
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>User info placeholder</h1>
      <h5 class="w3-padding-32">More user info placeholder.</h5>
    </div>

    <div class="w3-third w3-center">
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
 <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

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

</body>
</html>
