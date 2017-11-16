<!DOCTYPE html>
<html>
<title>Profile Page</title>
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
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Profile</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Account</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Log Out</a>
  
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Account</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Log Out</a>
    
  </div>
</div>
    <header class="w3-container w3-black w3-center" style="padding:50px 16px">
        <h1 class="w3-margin w3-jumbo">PROFILE PAGE</h1>
    </header> 
<?php
require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) 
      die($conn->connect_error);
        
      
        $query  = "SELECT * FROM user_Table WHERE user_ID =  100";
        
        $result = $conn->query($query);
        
        if($rows = $result->num_rows){
           $salt1    = "qm&h*";
           $salt2    = "pg!@";
           $token    = hash('ripemd128', "$salt1$password$salt2");
           $row = $result->fetch_array(MYSQLI_ASSOC);
           echo '<h1>Profile Information</h1>';
           echo 'Name: '   . $row['forename'] . " " . $row['surname'] .'<br>';
           echo 'Username: '   . $row['user_name']   . '<br>';
           echo 'Email: '   . $row['email']   . '<br>';
           echo 'Admin Privlage: '   . $row['is_admin']   . '<br>';
           echo 'Phone: '   . $row['phone']   . '<br>';
           echo 'Location: '   . $row['location_ID']   . '<br>';
           
               $result->close();
               $conn->close();
                }
        
?>
</html>


