<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    include_once 'config.php';
    $outcomingId = mysqli_real_escape_string($conn, $_POST['outcoming']);
    $incomingId = mysqli_real_escape_string($conn, $_POST['incoming']);
    $message = mysqli_real_escape_string($conn, $_POST['msg']);

    $sql = mysqli_query($conn, "INSERT INTO message (incoming_id, outcoming_id, msg) VALUES ({$incomingId}, {$outcomingId}, '{$message}')");

    if($sql){
        echo "success";
    } else {
        echo "not-success";    }
}
?>