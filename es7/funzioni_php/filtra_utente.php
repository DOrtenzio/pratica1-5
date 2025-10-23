<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    require_once ("../classi_php/Persona.php");
    require_once ("funzioni.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
        header("location: ../logAcc.php");
        exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
            if(!empty(trim($_POST["filtro"])) && isset($_POST["filtro"])){
                $paginabase='<!DOCTYPE html>
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
                                <a href="../dashboard.php"><button>Home</button></a>
                                <a href="filtra.php"><button>Filtra</button></a>
                                <a href="../logout.php"><button>Logout</button></a>
                            </div>
                        </div>

                        <div class="container">
                            <h1>Inserisci le condizioni per il filtro</h1>
                            ';
                $paginaconclusione='
                                <div class="form-btn">
                                    <button type="submit">Filtra</button>
                                    <button type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                        </body>
                        </html>';

                if($_POST["filtro"]=="tutto"){
                    $_SESSION["selezione_filtro"]="tutto";
                    header("location: ../dashboard.php");
                    exit();
                } else if($_POST["filtro"]=="cognome"){
                    $_SESSION["selezione_filtro"]="cognome";
                    echo $paginabase.'
                    <form action="filtra_utente_specifica.php" method="post">
                                <div>
                                    <label for="cognome">Filtra per cognome</label>
                                    <input type="text" name="filtro" placeholder="Viapiana" required>
                                </div>
                                '.$paginaconclusione;
                } else if ($_POST["filtro"]=="data"){
                    $_SESSION["selezione_filtro"]="data";
                    echo $paginabase.'
                    <form action="filtra_utente_specifica.php" method="post">
                                <div>
                                    <label for="cognome">Filtra per data</label>
                                    <input type="date" name="filtro" required>
                                </div>
                                '.$paginaconclusione;
                } else{
                    $_SESSION["msg_errore"] = "true";
                    header("location: ../errore.php");
                    exit();
                }
            }
        } else{
            header("location: ../logAcc.php");
            exit();
        }
    }