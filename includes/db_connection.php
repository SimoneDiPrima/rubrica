<?php 

include 'includes/db_create.php';
$conn = new mysqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn && $conn->connect_error){
    echo "Connection failed" . $conn->connect_error;
    die();
}
?>