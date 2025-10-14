<?php
    if(session_status()==PHP_SESSION_NONE)session_start();

    $pagina_errore='
                <!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito Generico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }

        .container h1 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .subtitle {
            font-size: 16px;
            color: #ed2626;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        input[type="submit"],
        input[type="reset"] {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #007BFF;
            transition: background-color 0.3s ease;
        }

        a button{
            flex: 1;
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-color: rgb(0, 0, 0);
            border-radius: 5px;
            color: rgb(0, 0, 0);
            background-color: #ffffff;
            transition: background-color 0.3s ease;
            margin-top: 5%;
        }

        input[type="reset"] {
            background-color: #6c757d;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="reset"]:hover {
            background-color: #5a6268;
        }
    </style>
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

    function controlloUP($username,$password):bool{
        $logs_arr=json_decode(file_get_contents("user.txt"),true);
        if (!is_array($logs_arr)) {
            $logs_arr = [];
        }
        return (isset($logs_arr[$username]) && password_verify(trim($password), $logs_arr[$username]));
    }
?>