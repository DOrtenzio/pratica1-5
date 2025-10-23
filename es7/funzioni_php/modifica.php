<?php
    if(session_status() == PHP_SESSION_NONE) session_start();
    require_once ("../classi_php/Persona.php");
    require_once ("funzioni.php");

    if(isset($_POST["id"]) && !empty(trim($_POST["id"]))){
        if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
            header("location: ../logAcc.php");
            exit();
        } else{
            if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
                $user_arr=letturaFile("../data/data.txt");
                if($user_arr[$_POST["id"]]){ //modifica
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
                                    <a href="../dashboard.php"><button>Home</button></a>
                                    <a href="filtra.php"><button>Filtra</button></a>
                                    <a href="../logout.php"><button>Logout</button></a>
                                </div>
                            </div>
    
                            <div class="container">
                                <h1>Modifica Utente</h1>
                                <form action="modifica_utente.php" method="post">
                                    <div>
                                        <label for="nome">Nome:</label>
                                        <input type="text" id="nome" name="nome" value="'.($user_arr[$_POST["id"]])['nome'].'" required>
                                    </div>
                                    <div>
                                        <label for="cognome">Cognome:</label>
                                        <input type="text" id="cognome" name="cognome" value="'.($user_arr[$_POST["id"]])['cognome'].'" required>
                                    </div>
                                    <div>
                                        <label for="data_nascita">Data di Nascita:</label>
                                        <input type="date" id="data_nascita" name="data_nascita" value="'.($user_arr[$_POST["id"]])['data_nascita'].'" required>
                                    </div>
                                    <div>
                                        <label for="codice_fiscale">Codice Fiscale:</label>
                                        <input type="text" id="codice_fiscale" name="codice_fiscale" value="'.($user_arr[$_POST["id"]])['codice_fiscale'].'" required>
                                    </div>
                                    <div class="form-btn">
                                        <button type="submit">Salva</button>
                                        <button type="reset">Reset</button>
                                    </div>
                                </form>
                            </div>
                            </body>
                            </html>';
                } else{ //errore elemento non presente
                    $_SESSION["msg_errore"] = "true";
                    header("location: ../errore.php");
                    exit();
                }
            } else{
                header("location: ../logAcc.php");
                exit();
            }
        }
    } else{
        $_SESSION["msg_errore"] = "true";
        header("location: ../errore.php");
        exit();
    }