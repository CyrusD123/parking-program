<html>
<title>Printout - Not-a-Bot Parking</title>
<link rel="shortcut icon" href="icon.ico">
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

    <form method="post">
        <p style = 'font-family:verdana;font-size:11pt'>
        Enter the Admin Username and Password to Contiue: </p>
        <input type="text" name="admin_username" placeholder="Username" required> <br>
        <input type="password" name="admin_password" placeholder="Password" required> <br>
        <input type="submit" name="admin" id="admin" value="Submit">
    </form>
    <?php
    if(array_key_exists('admin',$_POST)){
        adminCheck($_POST["admin_username"], $_POST["admin_password"]);
    }
    ?>

</body>
</html>