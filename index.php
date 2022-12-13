<?php
Error_reporting(1);
$ipaddress = getenv("REMOTE_ADDR");
$invalid = 0;

if(isset($_GET['sh'])){
    include 'connect.php';
    $shortcode = $_GET['sh'];
    $sql = "SELECT * FROM `users` WHERE short_code = '$shortcode'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $longlink = $row['long_url'];
        }
    }

    $query = "SELECT * FROM `ip_address` WHERE ip_address = '$ipaddress'";
    $resultx = mysqli_query($con, $query);
    if ( mysqli_num_rows( $resultx ) > 0) {
        header("Location:".$longlink);
        exit();
    } else {
        $sql2 = "UPDATE `users` SET hits = hits + 1 WHERE short_code = '$shortcode'";
        $result2 = mysqli_query($con, $sql2);
        header("Location:".$longlink);
        $mysql = "INSERT INTO ip_address (ip_address) VALUES ('$ipaddress')";
        $results = mysqli_query($con,$mysql);

        exit();
    }

}


if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    if(isset($_POST['generate-btn'])){

        $username = $_POST['username'];
 
        $sql1 = "select long_url from `new-url` limit 1";
        $result1 = mysqli_query($con,$sql1);
        if ($result1) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $long_url = $row1['long_url'];
            }
        }

        //todo: 
        $sql_query = "SELECT * FROM `users` WHERE username = '$username'";
        $sql_result = mysqli_query($con, $sql_query);
        if ( mysqli_num_rows( $sql_result ) > 0) {
            $invalid = 1;
        } else {
            $sql = "insert into `users`(username,long_url,short_code) values('$username','$long_url','$username')";
            $result = mysqli_query($con,$sql);
            $link = "http://localhost:8080//referral/index.php/?sh=".$username;
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
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>Overgeared Referral</title>
</head>
<body>
    <div class="main-container">
        <div class="sub-container1">
            <h2>Enter A Username</h2>
        </div>
        <div class="sub-container2">
            <h4>The username you enter will be used to generate the referral link for you.</h4>
        </div>
        <div class="sub-container3">
            <form action="" method="post" autocomplete="off">
                <input type="text" name="username" class="username" placeholder="Enter username here..." required><br>
                <button type="submit" class="submit-btn" name="generate-btn">Generate Referral Link</button>
            </form>
        </div>
        <div class="sub-container4">
            <input type="text"class="referral-link" id="myInput" value="<?php echo($link); ?>">
            <button onclick="myFunction()" class="copy-btn" id="copy-btn">Copy link</button>
        </div>
    </div>
    <?php 
    if($invalid == 1){
        echo('
            <script>alert("Username already exists, please choose another one");</script>
        ');
    }
    ?>
    <a href="leaderboard.php">
        <div class="leader-board">
            <h3>Leader Board</h3>
        </div>
    </a>
</body>
</html>

