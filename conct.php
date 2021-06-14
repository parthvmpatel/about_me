<?php
    include_once 'connect.php';
    
    if (isset($_POST["form-submit"])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $subject = mysqli_real_escape_string($con, $_POST['subject']);
        $message = mysqli_real_escape_string($con, $_POST['message']);
            $result = mysqli_query($con, "INSERT INTO contect (`name`, `phone`, `email`, `subject`, `message`) VALUES ('{$name}', '{$phone}', '{$email}', '{$subject}', '{$message}')");
            if($result){
                header('Location:index.html');
            }
    }
?>