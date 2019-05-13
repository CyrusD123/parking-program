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

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["Status"] == 1){
                echo "<p style = 'font-family:verdana;font-size:11pt'>" . $row["Space"] . "</p>";
            }
            else {
                $emptyCount++;
            }
            if ($emptyCount == $result->num_rows) {
                echo "<p style = 'font-family:verdana;font-size:11pt'> 0 Spaces Empty </p>";
            }
        }
    }
    else {
        echo "<p style = 'font-family:verdana;font-size:11pt'> 0 Spaces </p>";
    }
};

function leave($space_num) {
    global $conn;
    $result = $conn->query("SELECT * FROM lots");
    $existCount = 0;
    while($row = $result->fetch_assoc()) {
        if ($row["Space"] == $space_num && $row["Status"] == 1) {
            $existCount++;
        }
    }
    if ($existCount == 1) {
        $conn_leave = $conn->query("UPDATE lots SET Status = 0 WHERE (Space = $space_num) and (Status = 1)");
    }
    else {
        echo "<script type='text/javascript'> alert('Error! Invalid Space Number'); </script>";
    }
};

function occupy($space_num) {
    global $conn;
    $result = $conn->query("SELECT * FROM lots");
    $existCount = 0;
    while($row = $result->fetch_assoc()) {
        if ($row["Space"] == $space_num && $row["Status"] == 0) {
            $existCount++;
        }
    }
    if ($existCount == 1) {
        $conn_leave = $conn->query("UPDATE lots SET Status = 1 WHERE (Space = $space_num) and (Status = 0)");
    }
    else {
        echo "<script type='text/javascript'> alert('Error! Invalid Space Number'); </script>";
    }
};
// dont forget to change mysql table back
//UPDATE `heroku_61d5206bca0791a`.`lots` SET `Status` = '0' WHERE (`Space` = '13') and (`Status` = '1');
?>