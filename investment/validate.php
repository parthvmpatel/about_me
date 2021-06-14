<?php
session_start();
ini_set("session.gc_maxlifetime", "28800");
include_once 'connect.php';

if(isset($_POST['Username'])){
    $username = $_POST['Username'];
    $password = $_POST['password'];

	/* Select queries return a resultset */
	if ($result = mysqli_query($con, "SELECT * FROM users WHERE username='{$username}' AND password='{$password}'")) {
		printf("Select returned %d row(s).\n", mysqli_num_rows($result));
		if(mysqli_num_rows($result) > 0){			
			$_SESSION['LoginUser'] = $username;
			//$_SESSION['LoginUserID'] = $userid;
			//echo($_SESSION['LoginUser']);
			header("Location: savings.php" );
		}
		else{
			header("Location: index.php?ErrMode=1" );
		}
	}
}
?> 