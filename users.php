<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                include_once "php/config.php";
                $sqlgetuserName = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");

                if (mysqli_num_rows($sqlgetuserName) > 0) {
                    $row = mysqli_fetch_assoc($sqlgetuserName);
                }
                ?>
                <div class="content">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
                <a href="" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" name="username" id="" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="add-user">
                <button class="add">Add new user
                    <i class="fas fa-plus"></i>
                </button>
                <div class="modal-background">
                    <div class="add-modal">
                        <div class="add-form">
                            <form action="#">
                                <label for="">Search by email:</label>
                                <input type="text" name="email" placeholder="Type the user's email">
                                <button>Search</button>
                            </form>
                        </div>
                        <div class="user-found">
                            <div class="content">
                                <img src="mei.jpg" alt="">
                                <div class="details">
                                    <span>meira</span>
                                </div>
                            </div>
                            <div class="add-user-btn">
                                <button><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="user-notfound">
                            <span>User doesn't exist</span>
                        </div>
                        <div class="input-invalid">
                            <span>Your Input is invalid</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="users-list">
                <div class="user-notavailable">
                    <span>User is not available</span>
                </div>
            </div>
        </section>
    </div>

    <script src="javascript/users.js"></script>

</body>

</html>