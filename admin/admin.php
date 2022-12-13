<?php
Error_reporting(0);
    $invalid = 0;

        if($_SERVER['REQUEST_METHOD']=='POST'){
            include 'connect.php';

            if(isset($_POST['submit-btn'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $my_email = "admin@overgeared.tech";
                $my_password = "admin@overgeared123";

                if($email == $my_email && $password == $my_password){
                    session_start();
                    header('location: admin-page.php');
                }else{
                    $invalid = 1;
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-login.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="login-container">
        <h1 class="container-title">Admin Login</h1>
        <form action="admin.php" method="post" autocomplete="off">
            <input type="text" name="email" class="email-field" placeholder="Enter email..."><br>
            <input type="password" name="password" class="password-field" placeholder="Enter password..."><br>
            <button type="submit" name="submit-btn" class="submit-btn">Login</button><br>
            <?php
            if($invalid == 1){
                echo('<p class="error-message">Wrong email or password. Please try again.</p>');
            }
            ?>
        </form>
    </div>
</body>
</html>