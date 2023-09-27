<?php 
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
if(!empty($email)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql= mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $Userprofile = new stdClass();
            $Userprofile->name = $row['fname']." ".$row['lname'];
            $Userprofile->img = $row['img'];
            $Userprofile->email = $row['email'];
            $sql2 = mysqli_query($conn, "SELECT * FROM users JOIN users_contact ON users_contact.saved_contact_id = users.user_id WHERE users_contact.user_id = (SELECT user_id FROM users WHERE users.unique_id = {$_SESSION['unique_id']}) AND users.email = '{$email}'");
            $Userprofile->saved = $_SESSION['unique_id'] == $row['unique_id'] || mysqli_num_rows($sql2) > 0 ? true : false ;
            header("Content-Type: application/json");
            echo json_encode($Userprofile);
        } else {
            echo "User doesn't exist";
        }
    } else {
        echo "Email is not a valid email.";
    }
} else {
    echo "Please type the email";
}

?>