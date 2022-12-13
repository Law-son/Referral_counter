<?php
Error_reporting(0);
include '../connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_POST['submit-btn'])){

        $url = $_POST['long_url'];

        $sql = "update `new-url` set long_url = ('$url') where id = 0";
        $result = mysqli_query($con,$sql);

        $sql4 = "TRUNCATE `users`"; 
        $result4 = mysqli_query($con,$sql4);

        $sql5 = "TRUNCATE `ip_address`"; 
        $result5 = mysqli_query($con,$sql5);

    }
}

        $sql1 = "select long_url from `new-url` limit 1";
        $result1 = mysqli_query($con,$sql1);
        if ($result1) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $long_url = $row1['long_url'];
            }
            
        }

        $sql2 = "select count(short_code) as no_codes from `users`";
        $result2 = mysqli_query($con,$sql2);
        if ($result2) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $no_codes = $row2['no_codes'];
            }
            
        }
        
        $sql3 = "select sum(hits) as no_hits from `users`";
        $result3 = mysqli_query($con,$sql3);
        if ($result3) {
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $no_hits = $row3['no_hits'];
            }
            
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-page.css">
    <title>Admin</title>
</head>
<body>
    <div class="main-container">
        <div class="input-container">
            <form action="admin-page.php" method="post" autocomplete="off">
                <input type="text" class="long_url" name="long_url" placeholder="Enter new URL here..." required>
                <input type="submit" name="submit-btn" class="submit-btn">
            </form>
        </div>
        <div class="analytics">
            <h2 class="no-links">Total number of referrals: <b><?php echo($no_codes); ?></b></h2><br>
            <h2 class="no-clicks">Total number of clicks: <b><?php echo($no_hits); ?></b></h2><br>
        </div>
    </div>
</body>
</html>