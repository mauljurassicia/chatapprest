<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    include_once 'config.php';
    $outcomingId = mysqli_real_escape_string($conn, $_GET['outcoming']);
    $incomingId = mysqli_real_escape_string($conn, $_GET['incoming']);

    $sql = mysqli_query($conn, "SELECT * FROM message WHERE (outcoming_id = {$outcomingId}  AND incoming_id = {$incomingId}) OR (outcoming_id = {$incomingId} AND incoming_id = {$outcomingId}) ORDER BY msg_id ASC");

    $arrayChat = [];
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $chatObject = new stdClass();
            $chatObject->msg = $row['msg'];
            $chatObject->inout = $row['outcoming_id'] == $_SESSION['unique_id'] ? "outcoming" : "incoming";

            $arrayChat[] = $chatObject;
        }
    }

    header("Content-Type: application/json");
    echo json_encode($arrayChat);
}

?>