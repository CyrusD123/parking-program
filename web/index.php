<html>
<title>Parking Spaces</title>
<link rel="shortcut icon" href="favicon.ico">
<script src = "parking.js"></script>
<?php include 'functions.php';?>
<body>
    <h1>Not-a-Bot</h1>
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
        <p style = 'font-family:verdana;font-size:9pt'>
        Leave a Space: </p>
        <input type="number" name="leave_num" min="1" max="20" value="1">
        <input type="submit" name="leave" id="leave" value="Submit" />
    </form>
    <?php
    if(array_key_exists('leave',$_POST)){
        leave($_POST["leave_num"]);
    }
    ?>
    <br>
    <form>
        Occupy an Empty Space: <br>
        <input type="number" name="occupy_num" min="1" max="20" value="1">
        <input type="button" onclick=occupySpace(); value="Submit">
    </form>

</body>
</html>