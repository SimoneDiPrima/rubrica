<?php
include 'includes/cities.php';

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
     $stmt->bind_param("i", $id); 
     $stmt->execute();
     // Ottieni i risultati
     $result = $stmt->get_result();
     if ($result->num_rows > 0) {
         while ($person = $result->fetch_assoc()) {
            $id = $person["id"];
            $name = $person["nome"];
            $surname = $person["cognome"];
            $email = $person["email"];
            $sex = $person["sesso"];
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
    <div class="container">
    <a href="rubrica.php" class="btn btn-primary text-end my-4">
        <i class="fa-solid fa-house"></i>
    </a>
    <h1>Modifica i dati di <?php echo $name ." ". $surname ?>  </h1>
    <form action="update_contact.php" name="id" method="POST" class="my-5">
        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">  
        <label class="form-label" for="nome">nome:</label><br>
        <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $name ?>" required>  
        <label class="form-label" for="cognome">Cognome:</label><br>
        <input class="form-control" type="text" id="cognome" name="cognome" value="<?php echo $surname ?>"  required><br><br>
        <label class="form-label" for="email">Email:</label><br>
        <input class="form-control" type="email" id="email" name="email" value="<?php echo $email ?>" minlength="8" maxlength="50" required><br><br>
        <label class="form-label" for="sesso">Sesso:</label><br>
        <select name="sesso" class="col-4" id="sesso" required>
            <option value="<? echo $sex ?>">
            <? if( $sex == 0){
                echo 'Maschio';
                }
                else{ echo 'Femmina';} ?>
            </option>
        
            <option value="<?php if($sex == 0){
                echo 1;}
                else{echo 0;}?>">
                <?php if($sex == 0){echo 'Femmina';}else{echo 'Maschio';} ?>
            </option>
       </select><br/>

       
        <label class="form-label mt-5" for="data_di_nascita" >Data di nascita:</label><br>
        <input class="form-control" type="date" id="data_di_nascita" name="data_di_nascita" value="<?php echo $date_of_birth ?>"><br><br>
        <label class="form-label" for="telefono">Telefono:</label><br>
        <input class="form-control" type="text"  id="telefono" name="telefono" value="<?php echo $phone ?>"  minlength="9" maxlength="15"><br><br>
        <label class="form-label" for="città">Citta:</label><br>
        <select class="col-4" name="città" id="città" value="<?php echo $city ?>">

            <option value="<? echo $city ?>"><? echo $city ?></option>
            <?php for($i = 0;$i< count($cities);$i++) : ?>
                <?php if($cities[$i] != $city): ?>
            <option value="<?php echo $cities[$i] ?>"><?php echo $cities[$i] ?></option>
            <?endif; ?>
            <? endfor; ?>
        </select><br>
        <button type="submit" class="btn btn-warning mt-5" ><i class="fa-solid fa-pencil"></i></button>
    </form>

    </div>

    
</body>
</html>