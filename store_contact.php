<?php 
 include 'includes/cities.php';


if($_SERVER['REQUEST_METHOD'] !== 'POST'){    http_response_code(405); //METHOD NOT ALLOWED
    die();
}
include 'includes/db_connection.php';

 if($conn && $conn->connect_error){
  echo "Connection failed" . $conn->connect_error;
   die();
}   
$nome = $_POST['nome'] ?? '';
$surname = $_POST['cognome'] ?? '';
$email = $_POST['email'] ?? '';
$sex = $_POST['sesso'];
$phone = $_POST['telefono'] ?? '';
$city = $_POST['città'] ?? '';
$date_of_birth = $_POST['data_di_nascita'] ?? '';
function storeUserData($nome, $surname, $email, $sex, $phone, $city, $date_of_birth) {
    global $conn;



    $sql =$conn->prepare("INSERT INTO users (nome,cognome,email,sesso,telefono,città,data_di_nascita) VALUES (?,?,?,?,?,?,?)");
 
     // Binding dei parametri e esecuzione della query
     $sql->bind_param("ssssiss",$nome,$surname,$email,$sex,$phone,$city,$date_of_birth);

     if ($sql->execute()) {
        $sql->close();
        return true; // Aggiornamento riuscito
    } else {
        $sql->close();
        return false; // Aggiornamento fallito
    }
}


    if (storeUserData($nome, $surname, $email, $sex, $phone, $city, $date_of_birth)) {
        // Salvataggio riuscito, reindirizza a rubrica.php
        header("Location: rubrica.php");
        exit();
    } else {
        // Aggiornamento fallito, gestisci l'errore
        echo "Errore durante il salvataggio dei dati.". mysqli_error($conn);
    }

$sql = "INSERT INTO users (nome,cognome,email,sesso,telefono,città,data_di_nascita) VALUES ('$name_sanitizzato', '$surname_sanitizzato','$email_sanitizzato','$sex_sanitizzato','$phone_sanitizzato','$city_sanitizzato','$date_sanitizzato')";


if (mysqli_query($conn,$sql)) {
    header("Location: rubrica.php");
} else {
    echo "Errore durante il salvataggio dei dati: " . mysqli_error($conn);
}


$conn->close();


?>
