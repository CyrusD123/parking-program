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

function leave($space_num, $username, $password) {
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

function occupy($space_num, $username, $password) {
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

function account($name, $id, $car, $username, $password) {
    global $conn;
    $validConn = $conn->query("SELECT * FROM users");
    $validInt = 0;
    while($row = $validConn->fetch_assoc()) {
        if ($row["id"] == $name) {
            echo "<script type='text/javascript'> alert('ID number has already been used. Please try again.'); </script>";
            $validInt++;
        }
        elseif ($row["username"] == $username) {
            echo "<script type='text/javascript'> alert('Username has already been used. Please try again'); </script>";
            $validInt++;
        }
        if ($validInt == 0) {
            $accountConn = $conn->query("INSERT INTO users (name, id, car, username, password) VALUES ($name, $id, $car, $username, $password)");
        }
    }
}
/*
0 - Occupied (Default)
1 - Empty

TODO:
Add Ads?
Accounts
    - Username and ID don't match any others
    - Username and password match table
Make image clickable to take to home

git add .
git commit -m "comment"
git push heroku master

heroku logs --tail -a parking-program
*/
?>