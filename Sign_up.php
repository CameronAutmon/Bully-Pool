<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'database_login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error)
    die($conn->connect_error);

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
    $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $userID = mysqli_real_escape_string($conn, $_POST["userID"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $salt1    = "qm&h*";
    $salt2    = "pg!@";
    $token    = hash('ripemd128', "$salt1$password$salt2");
    $isAdmin = 0;

    $query = "INSERT INTO user_Table VALUES" .
         "( \"$firstName\", \"$lastName\", \"$email\", \"$userID\", \"$isAdmin\", \"$token\" )";

    $result = $conn->query($query);

    if (!$result) {
        echo "INSERT failed: $query<br>" .$conn->error . "<br><br>";
    } else {
        echo "INSERT successful...";
    }
}



$conn->close();

?>

<!DOCTYPE html>
<html>
<title>BullyPool Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <body>

    <header class="w3-container w3-black">
      <h1>Create an Account</h1>
    </header>

        <div class="w3-container w3-half w3-margin-top">

            <form class="w3-container w3-card-4" method="POST" action="Sign_up.php">
                <p> Note: Fields marked with (*) are required. </p>
                <p><label><b>First Name*</b></label>
                    <input class="w3-input" placeholder="John" 
                    name = "firstName" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" type="text" style="width:90%" required></p>

                <p><label><b>Last Name*</b></label>
                    <input class="w3-input" type="text"  name = "lastName" placeholder="Doe" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" style="width:90%" required></p>

                <p><label><b>Email*</b></label>
                    <input class="w3-input" type="text" name = "email" placeholder="abc@xyz.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" style="width:90%" required></p>

                <p><label><b>Unique User ID*</b></label>
                    <input class="w3-input" placeholder="abc123" pattern = "^[a-zA-Z0-9]+$" name =     "userID" type="text" style="width:90%" required></p>

                <p><label><b>Password*</b></label>
                    <input class="w3-input" type="password" name = "password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" style="width:90%" maxlength="25" required></p>


                <p>
                    <div class="clearfix">
                      <button type="reset" name = "reset" class="w3-button w3-section w3-red w3-ripple">Reset</button>
                      <button type="submit" name = "submit" class="w3-button w3-section w3-green w3-ripple">Sign Up</button>
                    </div>

            </form>

        </div>


    <div id="message">
      <h3>Password must contain the following:</h3>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
      <p id="maxlength" class="invalid"> Maximum <b>25 characters</b></p> 
    </div>

    </body>
</html> 
