<html>
<title>Parking Spaces</title>
<link rel="shortcut icon" href="favicon.ico">
<script src = "parking.js"></script>
<?php include 'functions.php';?>
<body>
    <h1>Empty Spaces:</h1>
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