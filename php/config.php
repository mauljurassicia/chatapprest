<?php 
    $conn = mysqli_connect("localhost", "root", "161803pi", "chat");
    if(!$conn){
        echo "Database connected" . mysqli_connect_error();
    }

?>