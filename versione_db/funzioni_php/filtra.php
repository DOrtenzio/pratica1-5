<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    require_once ("../classi_php/Persona.php");
    require_once ("funzioni.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
        header("location: ../logAcc.php");
        exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
                 echo '<!DOCTYPE html>
                        <html lang="it">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Sito Generico - Aggiungi Utente</title>
                            <link rel="stylesheet" href="../style/style.css">
                            <link rel="stylesheet" href="../style/style_page.css">
                        </head>
                        <body>
                        <div class="banner">
                            <h2>Sito Generico</h2>
                            <div class="button-cont">
                                <a href="../dashboard.php"><button>🏠</button></a>
                                <a href="aggiungi.php"><button>➕</button></a>
                                <a href="filtra.php"><button>🔎</button></a>
                                <a href="../logout.php"><button>👋</button></a>
                            </div>
                        </div>

                        <div class="container">
                            <h1>Inserisci le condizioni per il filtro</h1>
                            <form action="filtra_utente.php" method="post">
                                <div>
                                    <label for="cognome">Filtra per cognome</label>
                                    <input type="radio" id="cognome" name="filtro" value="cognome">
                                </div>
                                <div>
                                    <label for="data">Filtra per data:</label>
                                    <input type="radio" id="data" name="filtro" value="data">
                                </div>
                                <div>
                                    <label for="data">Visualizza tutto:</label> 
                                    <input type="radio" id="tutto" name="filtro" value="tutto" checked>
                                </div>
                                <div class="form-btn">
                                    <button type="submit">Continua</button>
                                    <button type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                        </body>
                        </html>';
        } else{
            header("location: ../logAcc.php");
            exit();
        }
    }