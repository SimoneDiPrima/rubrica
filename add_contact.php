<?php include 'includes/cities.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/77b4cc17b1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container text-center">
    <h1 class="text-center">RUBRICA FAMIGLIA</h1>
    <a href="rubrica.php" class="btn btn-primary">
        <i class="fa-solid fa-house"></i>
    </a>
        <h1 class="my-5">REGISTRA UN NUOVO PARENTE</h1>
    <form class="d-flex flex-column" action="store_contact.php" method="POST" class="my-5">
        <label class="form-label" for="nome">Nome:</label>
        <input class="form-control" type="text" id="nome" name="nome" required maxlength="29" >
        <label class="form-label" for="cognome">Cognome:</label>
        <input class="form-control" type="text" id="cognome" name="cognome"  required maxlength="29">
        <label class="form-label" for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required minlength="8" maxlength="50">
        <label class="form-label" for="sesso">Sesso:</label>
       <select class="offset-4 col-4" name="sesso" id="sesso">
            <option value="0">Maschio</option>
            <option value="1">Femmina</option>
       </select><br>
        <label class="form-label" for="data_di_nascita">Data di nascita:</label>
        <input class="form-control" type="date" id="data_di_nascita" name="data_di_nascita">
        <label class="form-label" for="telefono">Telefono:</label>
        <input class="form-control" type="text" id="telefono" name="telefono" minlength="9" maxlength="15">
        <label class="form-label" for="città">Città:</label>
        <select class="offset-4 col-4" name="città" id="città">
        <?php foreach($cities as $city) : ?>
       <option value="<?php echo $city ?>"><?php echo $city ?></option>
       <? endforeach; ?>
        </select>
        <button class="my-5 btn btn-primary offset-4 col-4" type="submit"><i class="fa-solid fa-user-plus"></i></button>
    </form>

    </div>

    
</body>
</html>