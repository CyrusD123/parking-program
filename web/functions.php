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
        // echo "<p> <font face='verdana' size='3pt'> Space: " . $row["Space"]. " - Status: " . $row["Status"]. "</font></p>";
            if ($row["Status"] == 1){
                echo $row["Space"];
            }
        }
    }
    else {
        echo "<p> <font face='verdana' size='3pt'> 0 Spaces Empty </font></p>";
    }
};
// dont forget to change mysql table back
?>