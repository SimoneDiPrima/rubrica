<?php
// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){    http_response_code(405); //METHOD NOT ALLOWED
    die();

}
 // Otteniamo l'ID dalla richiesta GET
 if (isset($_GET['id'])) {
     $id = $_GET['id'];
 
     // Connessione al database MySQL
     $conn = new mysqli('localhost', 'root', 'root', 'rubrica');
 
     // Verifica della connessione
     if ($conn->connect_error) {
         die("Connessione fallita: " . $conn->connect_error);
     }
 
     // Preparazione della query SQL con un'istruzione parametrica per evitare SQL injection
     $query = "SELECT * FROM users WHERE id = ?";
 
     // Preparazione dello statement
     $stmt = $conn->prepare($query);
 
     // Binding dei parametri e esecuzione della query
     $stmt->bind_param("i", $id); // 
     $stmt->execute();
 
     // Ottieni i risultati
     $result = $stmt->get_result();
     // Verifica se abbiamo ottenuto dei risultati
     if ($result->num_rows > 0) {
         // Loop attraverso i risultati e fare qualcosa con essi
         while ($person = $result->fetch_assoc()) {
            $id = $person["id"];
            $name = $person["nome"];
            $surname = $person["cognome"];
            $email = $person["email"];
            $sex = $person["sesso"];
            if($sex == 0){
                $sex = "Maschio";
            }
            else{
                $sex = "Femmina";
            }
            $date_of_birth = $person["data_di_nascita"];
            $phone = $person["telefono"];
            $city = $person["città"];

            
            ;
         }
     } else {
         echo "Nessun risultato trovato.";
     }
 
     // Chiudiamo la connessione e rilasciamo le risorse
     $stmt->close();
     $conn->close();
 } else {
     echo "ID non fornito nella richiesta.";
 }
 function convertDateFormat($date_of_birth) {
    // Analizza la data iniziale nel formato UNIX timestamp
    $timestamp = strtotime($date_of_birth);
  
    // Formatta il timestamp nel nuovo formato "d-m-Y"
    $newDate = date("d-m-Y", $timestamp);
  
    return $newDate;
  }

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/77b4cc17b1.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="text-center">
    
  <div class="container mb-5">
        <h1>Vedi i dettagli di <?php echo $name ?></h1>

        <h3>Nome: <?php echo $name?></h3>
        <h3>Cognome: <?php echo $surname?></h3>
        <h3>Email: <?php echo $email?></h3>
        <h3>Genere: <?php echo $sex ?></h3>
       
        <h4>Telefono: <?php echo $phone?></h4>
        <h4>Compleanno: <?php echo convertDateFormat($date_of_birth) ?></h4>
        <h4>città: <?php echo $city ?></h4>
          
        <a href="rubrica.php" class="btn btn-primary"><i class="fa-solid fa-house"></i>
        </a>


  </div>

    
</body>
</html>