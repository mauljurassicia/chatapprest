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
        <section class="form login">
            <header>VanillChat</header>
            <form action="#">
                <div class="error-txt">This is error message!</div>
                <div class="field input">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" id="" placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button"><input type="submit" value="Start Chatting"></div>
            </form>
            <div class="link">Not yet signed up? <a href="index.php">Sign up</a></div>
        </section>
    </div>

    <script src="javascript/passs-show-hide.js"></script>
    <script src="javascript/login.js"></script>

</body>

</html>