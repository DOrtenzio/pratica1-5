<?php
    session_start();
    require_once("log.php");
    require_once("Persona.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
        header("location: logAcc.php");
        exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
            $dati_arr=json_decode(file_get_contents("data.txt"),true);
            $dati_utenti="";
            if (!is_array($dati_arr)) {
                $dati_arr = [];
                $dati_utenti="<p>Nessun dato trovato!</p>";
            } else{
                $dati_utenti='<table border="1" style="margin:auto;">
                                <tr>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Data di Nascita</th>
                                    <th>Codice Fiscale</th>
                                </tr>';
                foreach($dati_arr as $persona){
                    $dati_utenti.=$persona->toRigaTabella();
                }
                $dati_utenti.="</table>";
            }
            echo '<!DOCTYPE html>
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
                                text-align: center;
                                background-color: #ffffff;
                                padding: 30px 40px;
                                border-radius: 10px;
                                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                                height: 25vh;
                                width: 25vw;
                            }

                            .container p:first-child {
                                font-size: 24px;
                                font-weight: bold;
                                margin-bottom: 10px;
                            }

                            .container p:last-child {
                                font-size: 16px;
                                color: #666;
                                margin-bottom: 20px;
                            }

                            .btn-container {
                                display: flex;
                                justify-content: center;
                                gap: 20px;
                            }

                            button {
                                padding: 10px 20px;
                                font-size: 14px;
                                border: none;
                                border-radius: 5px;
                                cursor: pointer;
                                background-color: #007BFF;
                                color: white;
                                transition: background-color 0.3s ease;
                            }

                            button:hover {
                                background-color: #0056b3;
                            }

                            a {
                                text-decoration: none;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <p>Sito Generico</p>
                            <p>Ecco i Dati relativi agli utenti!</p>
                            '.$dati_utenti.'
                        </div>
                    </body>
                    </html>';
        } else{
            header("location: logAcc.php");
            exit();
        }
    }

    function aggiuntaNuovaPersona(Persona $persona) : bool {
        $user_arr=json_decode(file_get_contents("data.txt"),true);
        if(isset($user_arr[$persona->get_codice_fiscale()])){
            return false;
        } else{
            $user_arr[$persona->get_codice_fiscale()]=$persona;
            file_put_contents("data.txt",json_encode($user_arr));
            return true;
        }
    }
?>