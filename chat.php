<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
}

include_once 'php/config.php';

$user = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user}");

if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
    $name = ucfirst($row['fname'])." ".ucfirst($row['lname']);
    $img = $row['img'];
    $status = $row['status'];
    
} else {
    header('location: users.php');
}
?>

<?php include_once 'header.php';?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $img;?>" alt="photo profile">
                <div class="details">
                    <span><?php echo $name;?></span>
                    <p><?php echo $status;?></p>
                </div>
            </header>
            <div class="chat-box">
                
            </div>
            <form action="" class="typing-area">
                <input type="text" name="msg" placeholder="Type a message here....">
                <button class="not-send"><i class="fab fa-telegram-plane"></i></button>
            </form>
            
        </section>
    </div>

    
    <span id="incoming" hidden><?php echo $user;?></span>
    <span id="outcoming" hidden><?php echo $_SESSION['unique_id'];?></span>
    <script src="javascript/chat.js"></script>

</body>

</html>