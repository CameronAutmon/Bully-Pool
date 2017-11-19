<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'database_login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error)
    die($conn->connect_error);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$user_Id = "Abcdef123";
    $subjectField = mysqli_real_escape_string($conn, $_POST["subjectField"]);
    $travelDate = mysqli_real_escape_string($conn, $_POST["travel_date"]);
    $travelTime = mysqli_real_escape_string($conn, $_POST["travel_time"]);
    $Role = mysqli_real_escape_string($conn, $_POST["Role"]);
    if($Role == "Driver")
    	$isRider = 0;
    else if ($Role == "Rider")
    	$isRider = 1;
    $startingLocation = mysqli_real_escape_string($conn, $_POST["startingLocation"]);
    $finishingLocation = mysqli_real_escape_string($conn, $_POST["finishingLocation"]);
    $additionalInfo = mysqli_real_escape_string($conn, $_POST["additionalInfo"]);

    $query = "INSERT INTO Request_Travel VALUES" .
         "( \"$user_Id\", \"$subjectField\", \"$travelDate\", \"$travelTime\", \"$isRider\", \"$startingLocation\", \"$finishingLocation\", \"$additionalInfo\" )";

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
      <h1>Travel  Request  Form</h1>
    </header>

        <div class="w3-container w3-half w3-margin-top">

            <form class="w3-container w3-card-4" method="POST" action="Travel_Request_Form.php">
                <p> Note: Fields marked with (*) are required. </p>
                <p><label><b>Subject Field*</b></label>
                    <input class="w3-input" placeholder="08:00 AM Monday" 
                    name = "subjectField" type="text" style="width:90%" required></p>

                <p><label><b>Date of Travel*</b></label>
                    <input class="w3-input" type="text"  name = "travel_date" placeholder="YYYY-MM-DD" pattern="^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$" style="width:90%" required></p>

                <p><label><b>Time of Travel*</b></label>
                    <input class="w3-input" type="text" name = "travel_time" placeholder="HH:MM:SS (24 hour clock)" pattern="(?:[01]\d|2[0123]):(?:[012345]\d):(?:[012345]\d)" style="width:90%" required></p>

                <p><label><b>Role*</b><br></label>
						  <input type="radio" name="Role" value="Driver" checked> Driver<br>
						  <input type="radio" name="Role" value="Rider"> Rider<br></p>

                <p><label><b>Starting Location*</b></label>
                    <input class="w3-input" type="text" name = "startingLocation" placeholder="90 B.S. Hood Rd, Mississippi State, MS 39762" style="width:90%" maxlength="256" required></p>

                <p><label><b>Finishing Location*</b></label>
                    <input class="w3-input" type="text" name = "finishingLocation" placeholder="1300 Old Hwy 12, Starkville, MS 39759" style="width:90%" maxlength="256" required></p>

                <p><label><b>Additional Info</b></label>
                    <input class="w3-input" type="text" name = "additionalInfo" pattern="<[^>]*script" style="width:90%" maxlength="512"></p>

                <p>
                    <div class="clearfix">
                      <button type="reset" name = "reset" class="w3-button w3-section w3-red w3-ripple">Reset</button>
                      <button type="submit" name = "submit" class="w3-button w3-section w3-green w3-ripple">Submit Request</button>
                    </div>

            </form>

        </div>
    </body>
</html> 
