<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VanillChat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="form signup">
            <header>VanillChat</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" name="fname" id="" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" id="" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" id="" placeholder="Enter new password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label for="">Select Image</label>
                    <input type="file" name="image" id="" required>
                </div>
                <div class="field button"><input type="submit" value="Start Chatting"></div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Log in</a></div>
        </div>
    </div>

    

    <script src="javascript/passs-show-hide.js"></script>
    <script src="javascript/signup.js"></script>

</body>

</html>