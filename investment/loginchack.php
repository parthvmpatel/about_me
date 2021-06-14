<?php
include_once 'connect.php';

// $message = '';
if(isset($_POST['login'])){ 
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
        $result = mysqli_query($con, "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
        /* Select queries return a resultset */
        $ch = mysqli_num_rows($result);
        if ($ch == 1){
            header('Location:savings.php');
        }else{
            $message = "wrong id or password";
            header('Location:index.php');
        }
    
}
?>