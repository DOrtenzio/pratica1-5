<?php
    if(session_status()==PHP_SESSION_NONE)session_start();
    require_once ("funzioni_php/funzioni.php");
    require_once("classi_php/Persona.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
        header("location: logAcc.php");
        exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
            $dati_arr=json_decode(file_get_contents("data/data.txt"),true);
            $dati_utenti="";
            if (!is_array($dati_arr)) {
                $dati_arr = [];
                $dati_utenti="<p>Nessun dato trovato!</p>";
            } else{
                /* Se vogliamo usare tabella
                $dati_utenti='<table border="1" style="margin:auto;">
                                <tr>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Data di Nascita</th>
                                    <th>Codice Fiscale</th>
                                </tr>';
                foreach($dati_arr as $persona){
                    $persona1 = new Persona($persona['nome'], $persona['cognome'], $persona['data_nascita'], $persona['codice_fiscale']);
                    $dati_utenti.=$persona1->toRigaTabella();
                }
                $dati_utenti.="</table>";
                */
                $dati_utenti='';
                foreach($dati_arr as $persona){
                    $persona1 = new Persona($persona['nome'], $persona['cognome'], $persona['data_nascita'], $persona['codice_fiscale']);
                    $dati_utenti.=$persona1->toCard();
                }
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
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                padding-top: 10vh;
                            }

                            .container {
                                text-align: center;
                                background-color: #ffffff;
                                padding: 30px 40px;
                                border-radius: 10px;
                                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                                height: auto;
                                width: 75vw;
                                margin-top: 10vh;
                            }

                            .card {
                                text-align: right;
                                background-color: #ffeaeaff;
                                padding: 30px 40px;
                                border-radius: 10px;
                                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                                height: auto;
                                width: 65vw;
                                margin-bottom: 10px;
                            }

                            .card p:first-child {
                                font-size: 24px;
                                font-weight: bold;
                                margin-bottom: 10px;
                            }

                            .card p:last-child {
                                font-size: 16px;
                                color: #666;
                                margin-bottom: 20px;
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

                            .banner {
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                background-color: #007BFF;
                                color: white;
                                text-align: center; /* centra il testo orizzontalmente */
                                padding: 15px;
                            }

                            .banner h2 {
                                margin: 0;
                            }

                            .banner .button-cont {
                                position: absolute;
                                right: 3vw; 
                                top: 50%;
                                transform: translateY(-50%); 
                            }

                            .button-cont button{
                                background-color: white;
                                color: #007BFF;
                                border: none;
                                border-radius: 5px;
                                padding: 8px 16px;
                                cursor: pointer;
                                margin-left: 1vw;
                            }


                            .banner button:hover {
                                background-color: #e0e0e0;
                            }
                        </style>
                    </head>
                    <body>
                    <div class="banner">
                        <h2>Sito Generico</h2>
                        <div class="button-cont">
                            <a href='.'"funzioni_php/aggiungi.php"'.'><button>Aggiungi</button></a>
                            <a href='.'"funzioni_php/aggiungi.php"'.'><button>Filtra</button></a>
                            <a href='.'"funzioni_php/aggiungi.php"'.'><button>Logout</button></a>
                        </div>
                    </div>
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
    
?>