
<?php 
 include 'includes/cities.php';


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

function updateUserData($id, $nome, $surname, $email, $sex, $phone, $city, $date_of_birth) {
    global $conn;



 $sql = $conn->prepare("UPDATE users SET nome=?, cognome=?, email=?, sesso=?, telefono=?, città=?, data_di_nascita=? WHERE id=?");
 
     // Binding dei parametri e esecuzione della query
     $sql->bind_param("ssssisss",$nome,$surname,$email,$sex,$phone,$city,$date_of_birth,$id);

     if ($sql->execute()) {
        $sql->close();
        return true; // Aggiornamento riuscito
    } else {
        $sql->close();
        return false; // Aggiornamento fallito
    }
}
$id= $_POST['id'] ?? '' ;
$nome = $_POST['nome'] ?? '';
$surname = $_POST['cognome'] ?? '';
$email = $_POST['email'] ?? '';
$sex = $_POST['sesso'];
$phone = $_POST['telefono'] ?? '';
$city = $_POST['città'] ?? '';
$date_of_birth = $_POST['data_di_nascita'] ?? '';


    if (updateUserData($id, $nome, $surname, $email, $sex, $phone, $city, $date_of_birth)) {
        // Aggiornamento riuscito, reindirizza a rubrica.php
        header("Location: rubrica.php");
        exit();
    } else {
        // Aggiornamento fallito, gestisci l'errore
        echo "Errore durante l'aggiornamento dei dati.";
    }
$conn->close();
