<html>
<title>Create an Account - Not-a-Bot Parking</title>
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
</style>
<body style="background-color:#444444">
    <img src="logo.png" alt="Not-a-Bot" class="center">

    <form method="post">
        <p style = 'font-family:verdana;font-size:16pt'>
        Create an Account </p>
        <input type="text" name="account_name" placeholder="Your Name" required> <br>
        <input type="number" name="account_id" min="1" placeholder="Your School ID" required> <br>
        <input type="text" name="account_car" placeholder="Make and Model of Car" required> <br>
        <input type="text" name="account_username" placeholder="Username" required> <br>
        <input type="password" name="account_password" placeholder="Password" required> <br>
        <input type="submit" name="create" id="create" value="Create">
    </form>

    <?php
    if(array_key_exists('create',$_POST)){
        account($_POST["account_name"], $_POST["account_id"], $_POST["account_car"], $_POST["account_username"], $_POST["account_password"]);
    }
    ?>
</body>
</html>