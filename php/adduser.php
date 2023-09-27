<?php 
    session_start();
    $user = $_SESSION['unique_id'];
    include_once 'config.php';

    try {
        $sql = mysqli_query($conn, "INSERT INTO users_contact (user_id, saved_contact_id) VALUES ((SELECT user_id FROM users WHERE unique_id = {$user}),  (SELECT user_id FROM users WHERE email = '{$_POST['value']}'));");
        echo 'success';
    } catch (\Throwable $th) {
        echo "We met some problem";
    }

?>