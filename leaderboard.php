<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/leaderboard.css">
    <script src="script.js"></script>
    <title>Leaderboard</title>
</head>
<body>
    <div class="main-container">
        <div class="header">
            <h1 class="header-text">Leaderboard</h1>
        </div>
        <section class="table-view">

                <div class="table-content">
                <?php
                    error_reporting(false);
                    $regID = "";
                ?>
                <div style="overflow-x:auto;">
                <table>
                    <tr>
                        <th>Position</th>
                        <th>Username</th>
                        <th>Points</th>
                    </tr>
                <?php
                include 'connect.php';
                $sql = "SELECT username, hits from `users` ORDER BY hits desc";
                $result = mysqli_query($con,$sql);
                $pos = 1;

                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $pos++ . "</td><td>" . $row["username"] . "</td><td>" . $row["hits"] . "</td></tr>";
                }
                echo "</table>";
                } else { echo "0 results"; }
                $con->close();
         ?>
    </section>
    </div>
</body>
</html>

