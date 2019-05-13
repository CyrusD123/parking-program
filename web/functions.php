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
    $result = $conn->query("SELECT * FROM lots");

    if ($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $emptyCount = 0;
            if ($row["Status"] == 1){
                echo "<p> <font face='verdana' size='2pt'>" . $row["Space"] . "</font></p>";
            }
            else {
                $emptyCount++;
            }
            if ($emptyCount == $result->num_rows) {
                echo "<p> <font face='verdana' size='2pt'> 0 Spaces Empty</font></p>"
            }
        }
    }
    else {
        echo "<p> <font face='verdana' size='2pt'> 0 Spaces </font></p>";
    }
};
// dont forget to change mysql table back
?>