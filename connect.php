<?php
$servername = "localhost";
$username = "investment";
$password = "parth123";
$DBDATABASE = "lucifer";

// Create connection
$con = new mysqli($servername, $username, $password, $DBDATABASE);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

?>