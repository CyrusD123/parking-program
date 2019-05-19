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
    $doneCount = 0;
    while($row = $result->fetch_assoc()) {
        if ($row["Space"] == $space_num && $row["Status"] == 0 && $row["New_Username"] == NULL) {
            $existCount++;
        }
        if ($row["Usual_Username"] == $username) {
            $doneCount++;
        }
    }
    if ($existCount == 0) {
        echo "<script type='text/javascript'> alert('Error! Invalid Space Number'); </script>";
    }
    if ($doneCount == 1) {
        echo "<script type='text/javascript'> alert('You\'ve Already Left a Space!'); </script>";
    }

    $userResult = $conn->query("SELECT * FROM users");
    $existTwo = 0;
    while($row = $userResult->fetch_assoc()) {
        if ($row["username"] == $username && $row["password"] == $password) {
            $existTwo++;
        }
    }
    if ($existTwo == 0) {
        echo "<script type='text/javascript'> alert('Error! Invalid Username or Password'); </script>";
    }

    if ($existCount == 1 && $existTwo == 1 && $doneCount == 0) {
        $conn_leave = $conn->query("UPDATE lots SET Status = 1 WHERE (Space = $space_num) and (Status = 0)");
        $conn_leave2 = $conn->query("UPDATE lots SET Usual_Username = '$username' WHERE (Space = $space_num)");
    }
};

function occupy($space_num, $username, $password) {
    global $conn;
    $result = $conn->query("SELECT * FROM lots");
    $existCount = 0;
    $doneCount = 0;
    while($row = $result->fetch_assoc()) {
        if ($row["Space"] == $space_num && $row["Status"] == 1 && $row["New_Username"] == NULL) {
            $existCount++;
        }
        if ($row["New_Username"] == $username) {
            $doneCount++;
        }
    }
    if ($existCount == 0) {
        echo "<script type='text/javascript'> alert('Error! Invalid Space Number'); </script>";
    }
    if ($doneCount == 1) {
        echo "<script type='text/javascript'> alert('You\'ve Already Occupied a Space!'); </script>";
    }

    $userResult = $conn->query("SELECT * FROM users");
    $existTwo = 0;
    while($row = $userResult->fetch_assoc()) {
        if ($row["username"] == $username && $row["password"] == $password) {
            $existTwo++;
        }
    }
    if ($existTwo == 0) {
        echo "<script type='text/javascript'> alert('Error! Invalid Username or Password'); </script>";
    }

    if ($existCount == 1 && $existTwo == 1 && $doneCount == 0) {
        $conn_leave = $conn->query("UPDATE lots SET Status = 0 WHERE (Space = $space_num) and (Status = 1)");
        $conn_leave2 = $conn->query("UPDATE lots SET New_Username = '$username' WHERE (Space = $space_num)");
    }
};

function account($name, $id, $car, $username, $password) {
    global $conn;
    $validConn = $conn->query("SELECT * FROM users");
    $validInt = 0;
    $quoteInt = 0;
    $singleQuote = "\'";
    $doubleQuote = "\"";
    while($row = $validConn->fetch_assoc()) {
        if ($row["id"] == $id) {
            echo "<script type='text/javascript'> alert('ID number has already been used. Please try again.'); </script>";
            $validInt++;
        }
        if ($row["username"] == $username) {
            echo "<script type='text/javascript'> alert('Username has already been used. Please try again'); </script>";
            $validInt++;
        }
        /*
        if (strpos($name, $singleQuote) === false && strpos($name, $doubleQuote) === false && 
            strpos($id, $singleQuote) === false && strpos($id, $doubleQuote) === false && 
            strpos($car, $singleQuote) === false && strpos($car, $doubleQuote) === false && 
            strpos($username, $singleQuote) === false && strpos($username, $doubleQuote) === false && 
            strpos($password, $singleQuote) === false && strpos($password, $doubleQuote) === false) {
            $quoteInt++;
        }
        else {
            echo "<script type='text/javascript'> alert('Single quotes or double quotes are not allowed in your account information. Please omit them to continue.'); </script>";
        }
        */
    }
    if ($validInt == 0) {
        $accountConn = $conn->query("INSERT INTO users (name, id, car, username, password) VALUES ('$name', '$id', '$car', '$username', '$password')");
        header("Location:index.php");
    }
};

function printout() {
    global $conn;
    $lotsConn = $conn->query("SELECT * FROM lots");
    $lotsConn2 = $conn->query("SELECT * FROM lots");

    $emptyInt = 0;
    while ($rowEmpty = $lotsConn2->fetch_assoc()) {
        if ($rowEmpty["Usual_Username"] == NULL) {
            $emptyInt++;
        }
    }
    if ($emptyInt == $lotsConn2->num_rows) {
        echo "<p style = 'font-family:verdana;font-size:14pt'> No parking spaces have been changed. </p>";
    }

    while ($rowLots = $lotsConn->fetch_assoc()) {
        $nameOld = $rowLots["Usual_Username"];
        $nameNew = $rowLots["New_Username"];
        if ($rowLots["Usual_Username"] != NULL && $rowLots["New_Username"] == NULL) {
            $usersConn = $conn->query("SELECT name, id, car FROM users WHERE (username = '$nameOld')");

            while ($rowUsers = $usersConn->fetch_assoc()) {
                echo "<p style = 'font-family:verdana;font-size:11pt'> Space " . $rowLots['Space'] . " - Freed up by " . $rowUsers["name"] . "(ID: " . $rowUsers["id"] . ", Car: " . $rowUsers["car"] . ")</p>";
            }
        }
        if ($rowLots["Usual_Username"] != NULL && $rowLots["New_Username"] != NULL) {
            $usersConn = $conn->query("SELECT name, id, car FROM users WHERE (username = '$nameOld')");
            $newUsersConn = $conn->query("SELECT name, id, car FROM users WHERE (username = '$nameNew')");

            while ($rowUsers = $usersConn->fetch_assoc()) {
                while ($rowNewUsers = $newUsersConn->fetch_assoc()) {
                    echo "<p style = 'font-family:verdana;font-size:11pt'> Space " . $rowLots['Space'] . " - Freed up by " . $rowUsers["name"] . "(ID: " . $rowUsers["id"] . ", Car: " . $rowUsers["car"] . "), occupied by " . $rowNewUsers["name"] . "(ID: " . $rowNewUsers["id"] . ", Car: " . $rowNewUsers["car"] . ")</p>";
                }
            }
        }
    }
};
/*
0 - Occupied (Default)
1 - Empty

TODO:
Add Ads?

git add .
git commit -m "comment"
git push heroku master

heroku logs --tail -a parking-program
*/
?>