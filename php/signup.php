<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        // Check whethe r email is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $query = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($query) > 0){//check whether email already exist 
                echo "$email - This email is already exist";
            } else {
                if(isset($_FILES["image"])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name); // return an array of string divide by delimiter '.'
                    $img_ext = end($img_explode); //to get valid extension

                    $extension = ['png', 'jpg', 'jpeg']; //set of valid extension for image file

                    if(in_array($img_ext, $extension)){
                        $time = time(); //get curent time for unique identifier
                        
                        $img_new_name = $time.$img_name;

                        if(move_uploaded_file($tmp_name, "images/".$img_new_name)){
                            $status = "Active now";
                            $random_id = rand(time(), 1000000);

                            $sqlinsert = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$img_new_name}', '{$status}')");

                            if($sqlinsert){
                                $sqlselectuser = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

                                if(mysqli_num_rows($sqlselectuser) > 0){
                                    $row = mysqli_fetch_assoc($sqlselectuser);
                                    $_SESSION["unique_id"] = $row["unique_id"];

                                    echo "success";
                                }
                            } else {
                                echo "Something went wrong please try again later";
                            }
                        }
                        
                    } else {
                        echo "Please select an image file - .png, .jpg, .jpeg";
                    }

                } else {
                    echo "Please select an image file!";
                }
            }

        } else {
            echo "$email - This is not a valid email";
        }
    } else {
        echo "All input fields are required";
    }
?>