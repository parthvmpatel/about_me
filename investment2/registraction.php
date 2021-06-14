<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        body {margin: 0;
            padding: 0;
            background: url(background_2.jpg);
            background-size: cover;
        }
        .registration_box {
            width: 520px;
            height: 420px;
            background: rgba(255, 255, 255, 0.342);
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%,-50%);
            box-sizing: border-box;
            padding: 70px ;
        }
        .registration_box p{
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        .registration_box input[type="text"], input[type="password"],[type="int"]{
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            color: red;
            font-size: 16px;
            width: 70%;
            margin-bottom: 20px;
        }
        .registration_box input[type="submit"]{
            border: none;
            outline: none;
            height: 40px;
            background: rgb(230, 9, 9);
            font-size: 20px;
            color: #fff;
            border-radius: 20px;
        }

        .registration_box input[type="submit"]:hover{
            cursor: pointer;
            background-color: rgba(245, 244, 244, 0.301);
        }
    </style>
</head>
<body>
    <div class="registration_box">
        <h1><center>Create your Account</center></h1>
        <form method = "POST" action = "register_user.php"> 
            <p>Name : <input type="text" name="name" placeholder="Enter full name"></p>
            <p>Phone no. : <input type="int" name="phone" placeholder="Phone no."></p>
            <p>Email id : <input type="text" name="email" placeholder="Email id."></p>
            <p>Password : <input type="password" name="password" placeholder="Password"></p>
            <p>Confirm : <input type="password" name="confirm" placeholder="Confirm"></p>
            <center><input type="submit" name="register_user" value="Submit"></center>
        </form>
    </div>
    <script>
        alert("Email id is allready used !!");
    </script>
</body>
</html>