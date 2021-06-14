<?php
    include_once 'connect.php';
    
    if (isset($_POST["register_user"])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);
        $cha = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$email}'");
        $ch = mysqli_num_rows($cha);
        if ($ch == 1){
            header('Location:registraction.php');
        }
        else{
            $result = mysqli_query($conn, "INSERT INTO users (`id`, `name`, `phone`, `username`, `password`) VALUES (null, '{$name}', '{$phone}', '{$email}', '{$password}')");
            if($result){
                header('Location:index.php');
            }
        }
    }
?>