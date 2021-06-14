<style>
	body{
		background: url(graphics/tree.jpg) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.loginbox {
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		text-align:center;
	}
	input:-webkit-autofill { -webkit-box-shadow: 0 0 0px 1000px white inset;}
</style>
<html>
<head>
<title> Login Page </title>
<link rel="stylesheet" type="text/css" href="my.css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<body>
    <div class="loginbox">
        <h1>Savings Management</h1>
		<div id="LIDErr" class="loginErrMsg">
		<?php
		if(isset($_REQUEST['ErrMode'])) {
			if(ErrMode){
				 echo "Invalid login attempt...";
			}
		}		
		?>
		</div>
        <form method = "POST" action = "validate.php"> 
            <input type="text" name="Username" size=35 class="loginInput" placeholder="Enter Username"> <br>
            <input type="password" name="password" size=35 class="loginInput" placeholder="Enter Password"> <br><br>
            <input type="submit" name="" class="btnLogin" value="Login">
        </form>
    </div>
</body>
</head>
</html>