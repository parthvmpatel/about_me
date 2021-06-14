<html>
<head>
<title> Logine Page </title>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
    <div class="loginbox">
        <img src="logo.png" class="avatar">
        <h1>Login Here</h1>
        <form method = "POST" action = "loginchack.php"> 
        <!--  -->
            <p>Username</p>
            <input type="text" name="Username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="Password" placeholder="Enter Password">
            <input type="submit" name="login" value="Login">
            <a href="registraction.php">Reset Password</a><br>
        </form>
    </div>
</body>
</head>
</html>