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

function listEmpty() {
    $sql = "SELECT * FROM lots";
    $result = $conn->query($sql);

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