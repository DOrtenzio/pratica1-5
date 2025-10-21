<?php
    require_once ("funzioni_php/funzioni.php");

    if(session_status()==PHP_SESSION_NONE)session_start();

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
        <p class="subtitle">Errore, reinserisci le informazioni per accedere!</p>
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
        <a href="index.html"><button>Torna a Home</button></a>
    </div>
</body>
</html>
            ';

    if(isset($_POST["username"]) && !empty(trim($_POST["username"])) && isset($_POST["password"]) && !empty(trim($_POST["password"]))){
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        

        if (controlloUP($username,$password)){
            $_SESSION["UserLogin"] = $username;
            $_SESSION["PaswLogin"] = $password;
            header("location: dashboard.php");
        } else{
            echo $pagina_errore;
        }
    } else{
        echo $pagina_errore;
    }
?>