<html>
<title>Not-a-Bot Parking</title>
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
    <?php echo "<p style = 'font-family:verdana;font-size:16pt'> $initial </p>"; ?>
    <!--<h2 id="emptyList"></h2>
    <script>
        listEmpty();
    </script>-->
    
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
        <input type="number" name="leave_num" min="1">
        <input type="submit" name="leave" id="leave" value="Submit">
    </form>
    <?php
    if(array_key_exists('leave',$_POST)){
        leave($_POST["leave_num"]);
    }
    ?>
    <br>
    <form method="post">
        <p style = 'font-family:verdana;font-size:11pt'>
        Occupy an Empty Space: </p>
        <input type="number" name="occupy_num" min="1">
        <input type="submit" name="occupy" id="occupy" value="Submit">
    </form>
    <?php
    if(array_key_exists('occupy',$_POST)){
        occupy($_POST["occupy_num"]);
    }
    ?>
</body>
</html>