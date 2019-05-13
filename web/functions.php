<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

// Create connection
$conn = new mysqli($server, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$initial = "Press the \"Update\" button to show all empty spaces.";

function listEmpty() {
    global $conn;
    $emptyCount = 0;
    $result = $conn->query("SELECT * FROM lots");

    if ($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["Status"] == 1){
                echo "<p style = 'font-family:verdana;font-size:16pt'>" . $row["Space"] . "</p>";
            }
            else {
                $emptyCount++;
            }
            if ($emptyCount == $result->num_rows) {
                echo "<p style = 'font-family:verdana;font-size:16pt'> 0 Spaces Empty </p>";
            }
        }
    }
    else {
        echo "<p style = 'font-family:verdana;font-size:16pt'> 0 Spaces </p>";
    }
};
// dont forget to change mysql table back
//UPDATE `heroku_61d5206bca0791a`.`lots` SET `Status` = '0' WHERE (`Space` = '13') and (`Status` = '1');
?>