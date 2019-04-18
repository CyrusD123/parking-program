<html>
<title>Parking Spaces</title>
<script src = "parking.js"></script>
<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
?>
<body>
    <h1>Empty Spaces:</h1>
    <h2 id="emptyList"></h2>
    <script>
        listEmpty();
    </script>
    <button type="button" onclick=listEmpty();>Update Empty Spaces</button>
    <form>
        <br>
        Leave a Space: <br>
        <input type="number" id="leave_num" min="1" max="20" value="1">
        <input type="button" onclick=emptySpace(); value="Submit">
    </form>
    <br>
    <form>
        Occupy an Empty Space: <br>
        <input type="number" id="occupy_num" min="1" max="20" value="1">
        <input type="button" onclick=occupySpace(); value="Submit">
    </form>

</body>
</html>