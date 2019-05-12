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

echo "<p> <font face='verdana' size='3pt'> Press the \"Update\" button to show all empty spaces. </font></p>";

function listEmpty() {
    global $conn;
    global $initial;
    $result = $conn->query("SELECT * FROM lots");
    
    echo substr_replace($initial," ",0);

    if ($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "<p> <font face='verdana' size='3pt'> Space: " . $row["Space"]. " - Status: " . $row["Status"]. "</font></p>";
        }
    }
    else {
        echo "<p> <font face='verdana' size='3pt'> 0 Spaces Empty </font></p>";
    }
};
?>