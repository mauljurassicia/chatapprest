<?php
 session_start();
 include_once "config.php";
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);

 if(!empty($email) && !empty($password)){

    $sqlCheckuser = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");

    if(mysqli_num_rows($sqlCheckuser) >0 ){
        $row = mysqli_fetch_assoc($sqlCheckuser);
        $_SESSION["unique_id"] = $row['unique_id'];
        echo "success";
    } else {
        echo "Email or password is incorrect!";
    }

 } else {
    echo "All inputs are required";
 }
?>