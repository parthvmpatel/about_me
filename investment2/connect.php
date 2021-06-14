<?php
$servername = "localhost";
$username = "investment";
$password = "parth123";
$DBDATABASE = "investment";

// Create connection
$conn = new mysqli($servername, $username, $password, $DBDATABASE);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>