<?php include 'functions.php';

$conn_reset = $conn->query("UPDATE lots SET Status = 0 WHERE (Status = 1)");
?>