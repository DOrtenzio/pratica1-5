<?php
    session_start();
    require_once ("funzioni.php");

    $pagina_errore='
    <!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito Generico</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_reglog.css">
</head>
<body>
    <div class="container">
        <h1>Sito Generico</h1>
        <p class="subtitle">Errore reinserisci le informazioni per Registrarti!</p>
        <form action="reg.php" method="post">
            <label for="username">Nome utente</label>
            <input type="text" id="username" name="username" placeholder="Riccinelli" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password89" required>
            <label for="password">Ripeti</label>
            <input type="password" id="password2" name="password2" placeholder="Password89" required>
            <div class="btn-container">
                <input type="submit" value="Invia">
                <input type="reset" value="Cancella">
            </div>
        </form>
        <a href="index.html"><button>Torna a Home</button></a>
    </div>
</body>
</html>

';

    if(isset($_POST["username"]) && !empty(trim($_POST["username"])) && isset($_POST["password"]) && !empty(trim($_POST["password"]) && isset($_POST["password2"]) && !empty(trim($_POST["password2"])) && trim($_POST["password2"])===trim($_POST["password"]))){
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        //lettura da file
        $logs_arr=letturaFile("data/user.txt");
        if (!isset($logs_arr[$username])){ 
            $logs_arr[$username]=password_hash($password,PASSWORD_DEFAULT); 
            scritturaFile("data/user.txt",$logs_arr);
            header("location: logAcc.php");
        } else
            echo $pagina_errore;
    } else{
        echo $pagina_errore;
    }
?>