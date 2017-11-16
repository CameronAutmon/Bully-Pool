<?php //setupusers.php (with changes)
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once 'database_login.php';
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die($connection->connect_error);

  $query = "CREATE TABLE user_Table (
    first_name    VARCHAR(32) NOT NULL,
    last_name     VARCHAR(32) NOT NULL,
    email       VARCHAR(50) NOT NULL,
    user_ID     VARCHAR(32) NOT NULL UNIQUE,
    isAdmin    BOOLEAN     NOT NULL,
    user_pw    VARCHAR(256) NOT NULL
  )";
  
 $query_1 = "CREATE TABLE user_Profile (
    user_ID INTEGER(50)  NOT NULL UNIQUE,
    rating  INTEGER(50)  NOT NULL,
    reviews VARCHAR(50)  NOT NULL
  )";
  
  $query_2 = "CREATE TABLE Travel_Request_Form_History (
    user_ID     VARCHAR(32) NOT NULL UNIQUE,
    location_ID VARCHAR(32) NOT NULL,
    time        VARCHAR(32) NOT NULL,
    travel_date VARCHAR(32) NOT NULL,
    request_post_date VARCHAR(10) NOT NULL,
    is_driver_or_rider   BOOLEAN NOT NULL,
    user_ID1     VARCHAR(32) NOT NULL,
    user_ID2     VARCHAR(32) NOT NULL,
    user_ID3     VARCHAR(32) NOT NULL,
    user_ID4     VARCHAR(32) NOT NULL
  )";
  
  $result = $connection->query($query);
  $result_1 = $connection->query($query_1);
  $result_2 = $connection->query($query_2);
  if (!$result) die($connection->error);
  if (!$result_1) die($connection->error);
  if (!$result_2) die($connection->error);

?>
