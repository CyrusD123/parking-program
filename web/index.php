<html>
<title>Home - Not-a-Bot Parking</title>
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<?php include 'functions.php';?>
<style>
    body {
        color: white;
        text-align: center;
    }
    input[type=number] {
        padding: 12px 20px;
        box-sizing: border-box;
        border-radius: 6px;
        border-color: black;
    }
    input[type=text] {
        padding: 12px 20px;
        box-sizing: border-box;
        border-radius: 6px;
        border-color: black;
    }
    input[type=submit] {
        -webkit-appearance: none;
        border-radius: 6px;
        padding: 12px 20px;
        color: white;
        font: 14px verdana;
        background: #5CBFFF;
        border-color: #5CBFFF;
    }
    input[type=password] {
        padding: 12px 20px;
        box-sizing: border-box;
        border-radius: 6px;
        border-color: black;
    }
</style>
<body style="background-color:#444444">
    <a href="index.php">
        <img src="logo.png" alt="Not-a-Bot" class="center">
    </a>
    <?php echo "<p style = 'font-family:verdana;font-size:16pt'> $initial </p>"; ?>
    
    <form action="account.php" style="position:absolute;top:10;right:10;">
        <input type="submit" value="Create an Account" style="float: right;" />
    </form>

    <form action="adminCheck.php" style="position:absolute;top:65;right:10;">
        <input type="submit" value="Get a Printout" style="float: right;" />
    </form>

    <form method="post">
        <input type="submit" name="listEmpty" id="listEmpty" value="Update Empty Spaces" /><br/>
    </form>
    <?php
    if(array_key_exists('listEmpty',$_POST)){
        listEmpty();
    }
    ?>
    <form method="post">
        <p style = 'font-family:verdana;font-size:11pt'>
        Leave an Occupied Space: </p>
        <input type="text" name="leave_username" placeholder="Username" required> <br>
        <input type="password" name="leave_password" placeholder="Password" required> <br>
        <input type="number" name="leave_num" min="1" placeholder="Space Number" required>
        <input type="submit" name="leave" id="leave" value="Submit">
    </form>
    <?php
    if(array_key_exists('leave',$_POST)){
        leave($_POST["leave_num"], $_POST["leave_username"], $_POST["leave_password"]);
    }
    ?>
    <br>
    <form method="post">
        <p style = 'font-family:verdana;font-size:11pt'>
        Occupy an Empty Space: </p>
        <input type="text" name="occupy_username" placeholder="Username" required> <br>
        <input type="password" name="occupy_password" placeholder="Password" required> <br>
        <input type="number" name="occupy_num" min="1" placeholder="Space Number" required>
        <input type="submit" name="occupy" id="occupy" value="Submit">
    </form>
    <?php
    if(array_key_exists('occupy',$_POST)){
        occupy($_POST["occupy_num"], $_POST["occupy_username"], $_POST["occupy_password"]);
    }
    ?>
</body>
</html>