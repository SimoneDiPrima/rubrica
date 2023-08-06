<?php 
include 'includes/db_connection.php';
$sql = 'SELECT * FROM users';

$conn->close();

header('Content-type:application/json');
echo json_encode($sql);
?>