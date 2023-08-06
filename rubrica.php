<?php 

include 'includes/db_connection.php';

if($conn && $conn->connect_error){
    echo "Connection failed" . $conn->connect_error;
    die();
}
$sql =  " SELECT * FROM `users` ";

$result = $conn->query($sql);

if(!$result){
    echo "Nessun risultato disponibile";
    die();
}

$person_users = [];
if($result && $result -> num_rows > 0){
    while($row = $result->fetch_assoc()){
            $person_users[] = $row;
    }
}

$conn->close();
include 'includes/cities.php';
function convertDateFormat($date_of_birth) {
    // Analizza la data iniziale
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Rubrica Famiglia</title>
</head>
<body>
    <div class="container my-4">
    <h1 class="text-center">RUBRICA FAMIGLIA</h1>
    <a href="add_contact.php" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i></a>
    <table class="table my-5 d-offset-md-2 d-md-8 d-sm-10">
  <thead>
    <tr>
        <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">surname</th>
      <th scope="col">phone</th>
      <th scope="col">email</th>
      <th scope="col">birthday</th>
      <th scope="col">sex</th>
      <th scope="col">city</th>
      <th scope="col">actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if(empty($person_users)): ?>
        <tr colspan="4" class="text-center">
            <strong>NESSUN RISULTATO TROVATO</strong>
        </tr>
    <?php else : ?>
    <?php foreach($person_users as $person) : ?>
        <tr>
            <td><? echo $person["id"] ?></td>
            <td><? echo $person["nome"] ?></td>
            <td><? echo $person['cognome'] ?></td>
            <td><? echo $person['telefono'] ?></td>
            <td><? echo $person['email'] ?></td>
            <td><? echo convertDateFormat($person['data_di_nascita']) ?></td>
            <td><? if($person['sesso'] == 0): ?>
                <?php echo 'Maschio' ?>
                <?php else : ?>
                <?php echo 'Femmina' ?>
            <?php endif; ?>
            </td>
            <td><? echo $person['città'] ?></td>
            <td class="d-flex justify-content-between">

            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-eye"></i>
                </button>
            <div class="collapse col-12" id="collapseExample">
                <div class="card card-body">
                    <h3><?php echo $person['nome'] ?></h3>
                    <h3><?php echo $person['cognome'] ?></h3>
                    <h3><?php echo $person['email'] ?></h3>
                    <h3><?php echo $person['telefono'] ?></h3>
                    <h3><?php echo $person['città'] ?></h3>
                    <h3><?php if($person['sesso'] == 0): ?>
                        <?php echo 'Maschio' ?>
                        <?php else : ?>
                        <?php echo 'Femmina' ?>
                        <?php endif; ?>
                    </h3>
                    
                </div>
            </div> -->
            <a href="show_contact.php?id=<?php echo $person['id'] ?>" method="GET" name="id">
                    <input type="hidden">
                    <button class="btn btn-success" type="submit">
                    <i class="fa-solid fa-eye"></i>
                    </button>
                </a>
                <a href="edit_contact.php?id=<?php echo $person['id'] ?>" method="GET" name="id">
                    <input type="hidden">
                    <button class="btn btn-warning" type="submit">
                    <i class="fa-solid fa-pencil"></i>
                    </button>
                </a>
                <form action="delete_contact.php" id="formDelete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $person['id'] ?>">
                    <button class="btn btn-danger" id="deleteButton" type="submit">
                    <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    
   
  </tbody>
</div>
</table>
<div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
<script src="script.js"></script>
</body>
</html>