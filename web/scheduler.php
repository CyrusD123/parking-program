<?php include 'functions.php';

$conn_reset = $conn->query("UPDATE lots SET Status = 0 WHERE (Status = 1)");
$conn_resetOlduser = $conn->query("UPDATE lots SET Usual_Username = NULL WHERE (Status = 1) OR (Status = 0)");
$conn_resetNewuser = $conn->query("UPDATE lots SET New_Username = NULL WHERE (Status = 1) OR (Status = 0)");
?>