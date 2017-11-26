<!DOCTYPE html>
<html>
<title>Ratings</title>
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
    </head>
   <body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-light-grey w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="home_page.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="Travel_Request_Form.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Create Travel Request Form</a>
    <a href="account_settings.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">View History</a>
    <a href="profilePage.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Profile Page</a>
    <a href="account_settings.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Account Settings</a>
    <a href="" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Logout</a>
  </div>
</div>

<?php

  session_start();
  $Err = "";
  $user_id = $_POST['user_id'];
  $rating = $_POST['rating'];
  $review = $_POST['review'];
  require_once 'database_login.php';
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);

  if (isset($_POST['user_id']) &&
      isset($_POST['rating'])  &&
      isset($_POST['review']))
  {
    $un_temp = mysql_entities_fix_string($connection, $_POST['user_id']);
    $rating_temp = mysql_entities_fix_string($connection, $_POST['rating']);
    $review_temp = mysql_entities_fix_string($connection, $_POST['review']);
    $query = "SELECT `user_ID`FROM `user_Table` WHERE user_ID = '$un_temp' ";    
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    elseif ($result->num_rows)
    {
      $Err = 'Rating Successfully Sumbitted!';
      $query = "INSERT INTO `ratings`(`rating`, `user_ID`, `review`) VALUES ('$rating_temp','$un_temp','$review_temp')";
      $result = $connection->query($query);

    }
    else
    {
      $Err = 'USER NOT FOUND';
    }
    
  }
  else
  {
    $Err = 'The user_id / rating combination is not correct.';
  }

  $connection->close();

  function mysql_entities_fix_string($connection, $string)
  {
    return htmlentities(mysql_fix_string($connection, $string));
  } 

  function mysql_fix_string($connection, $string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
  }
         
          
          
          //      If the user_id / rating were not valid, show error message
          //      and populate form with the original inputs

          
          
        ?>
        <!-- Header -->
<header class="w3-container w3-black w3-left-align" style="padding:64px 16px">
  <h1 class="w3-margin w3-jumbo">Rating Page</h1>
    <p class="w3-xlarge">Please leave a rating for your rider/driver here.</p>
</header>
                
        <p style="color: black">
        <?php echo $Err;?>
        </p>
        
        <form method="post" action="rating.php">
            <label>User ID: </label>
            <input type="text" name="user_id" value = <?php echo $user_id?>> <br>
            <label>Rating  :</label>
            <input type="text" name="rating" value = <?php echo $rating?>> <br>
            <label>Review  :</label>
            <input type="text" name="review" value = <?php echo $review?>> <br>
            <input type="submit" value="Submit">
        </form>
        
       
</html>
