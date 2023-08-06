<?php

if($_SERVER['REQUEST_METHOD'] !== 'POST'){    http_response_code(405); //METHOD NOT ALLOWED
    die();
}
const DB_SERVERNAME = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "root";
const DB_NAME = "rubrica";
 $conn = new mysqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);

 if($conn && $conn->connect_error){
  echo "Connection failed" . $conn->connect_error;
   die();
}   
$id = $_POST['id'] ?? '';

$sql = "DELETE FROM users WHERE id = '$id' ";

// Esegui la query di cancellazione
if ($conn->query($sql) === TRUE) {
    header("Location:rubrica.php");
} else {
    echo "Errore nella cancellazione: " . $conn->error;
}

// Chiudi la connessione al database
$conn->close();
?>



