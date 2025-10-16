<?php
    session_start();

    //Controllo se il login è già stato effettuato
    if(isset($_SESSION["UserLogin"]) && isset($_SESSION["PaswLogin"])){
        header("location: dashboard.php");
        exit(); //Evito che il resto del codice venga eseguito
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito Generico</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Sito Generico</h1>
        <p class="subtitle">Inserisci le informazioni per accedere!</p>
        <form action="log.php" method="post">
            <label for="username">Nome utente</label>
            <input type="text" id="username" name="username" placeholder="Riccinelli" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password89" required>

            <div class="btn-container">
                <input type="submit" value="Invia">
                <input type="reset" value="Cancella">
            </div>
        </form>
        <a href="index.html"><button class="back-to-home">Torna a Home</button></a>
    </div>
</body>
</html>
