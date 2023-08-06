<?php 


const DB_SERVERNAME = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "root";
const DB_NAME = "rubrica";

$conn = new mysqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn && $conn->connect_error){
    echo "Connection failed" . $conn->connect_error;
    die();
}
?>