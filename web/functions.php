<?php
$url = parse_url("mysql://b72f166e1be699:2d9d504e@us-cdbr-iron-east-02.cleardb.net/heroku_61d5206bca0791a?reconnect=true");

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
// Create connection
$conn = new mysqli($server, $username, $password, $db);

function listEmpty() {
    $result = $conn->query("SELECT * FROM lots");

    if ($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "Space: " . $row["Space"]. " - Status: " . $row["Status"]. "<br>";
        }
    }
    else {
        echo "0 Spaces Empty";
    }
};
?>