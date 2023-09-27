<?php
session_start();
include_once "config.php";

$sqlgetcontactlist = mysqli_query($conn, "SELECT u.*, m.msg FROM ( SELECT users.*, MAX(message.msg_id) AS latest_msg_id FROM users JOIN users_contact ON users_contact.saved_contact_id = users.user_id LEFT JOIN message ON message.outcoming_id = users.unique_id WHERE users_contact.user_id = ( SELECT user_id FROM users WHERE users.unique_id = {$_SESSION['unique_id']}) GROUP BY users.user_id ) AS u LEFT JOIN message AS m ON u.latest_msg_id = m.msg_id ORDER BY u.latest_msg_id DESC; ");
if (mysqli_num_rows($sqlgetcontactlist) > 0) {
    $userarray = []; //array to store list of available user
    while ($row = mysqli_fetch_assoc($sqlgetcontactlist)) {
        $userObject = new stdClass(); // Create an empty object
        $userObject->name = $row['fname']." ".$row['lname']; // Replace with the actual column name
        $userObject->status = $row['status']; 
        $userObject->msg = $row['msg'];
        $userObject->img = $row['img'];
        $userObject->unique_id = $row['unique_id'];

        // Add the object to the array
        $userarray[] = $userObject;
    }

    $jsonArray = json_encode($userarray);

    header("Content-Type: application/json");

    echo $jsonArray;
} else {
    echo "false";
}
?>