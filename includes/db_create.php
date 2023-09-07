<?php 

$servername = "localhost:3306"; // Nome del server MySQL
$username = "root"; // Nome utente di accesso al database
$password = "root"; // Password del database
$database_name = "rubrica"; // Nome del nuovo database

// Crea una connessione al server MySQL
$conn = new mysqli($servername, $username, $password);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Query SQL per creare il nuovo database
$sql = "CREATE DATABASE $database_name";

if ($conn->query($sql) === TRUE) {
    "Database creato con successo!";
} else {
    "Errore nella creazione del database: " . $conn->error;
}
$conn->close();


const DB_SERVERNAME = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "root";
const DB_NAME = "rubrica";

$conn = new mysqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn && $conn->connect_error){
    echo "Connection failed" . $conn->connect_error;
    die();
}

$table = "CREATE TABLE users(
    id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    cognome VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    telefono VARCHAR(15) DEFAULT NULL,
    sesso BOOLEAN NOT NULL,
    città VARCHAR(30) NULL,
    data_di_nascita DATE NULL
)";


if ($conn->query($table) === TRUE) {
    "Tabella users creata con successo!";
} 
else {
    "Errore nella creazione della tabella users: " . $conn->error;
}

?>

