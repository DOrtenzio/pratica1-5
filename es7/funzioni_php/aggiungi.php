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
                            <link rel="stylesheet" href="../style.css">
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
                                    width: 75vw;
                                    margin-top: 10vh;
                                }

                                h1 {
                                    font-size: 24px;
                                    margin-bottom: 20px;
                                }

                                form {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 15px;
                                    align-items: flex-start;
                                    max-width: 400px;
                                    margin: 0 auto;
                                }

                                label {
                                    font-weight: bold;
                                    margin-bottom: 5px;
                                }

                                input {
                                    width: 100%;
                                    padding: 8px 10px;
                                    border-radius: 5px;
                                    border: 1px solid #ccc;
                                    font-size: 14px;
                                }

                                .form-btn {
                                    display: flex;
                                    justify-content: center;
                                    gap: 20px;
                                    margin-top: 20px;
                                }

                                .form-btn button {
                                    padding: 10px 20px;
                                    font-size: 14px;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    background-color: #007BFF;
                                    color: white;
                                    transition: background-color 0.3s ease;
                                }

                                .form-btn button:hover {
                                    background-color: #0056b3;
                                }
                            </style>
                        </head>
                        <body>
                        <div class="banner">
                            <h2>Sito Generico</h2>
                            <div class="button-cont">
                                <a href="../dashboard.php"><button>Home</button></a>
                                <a href="../funzioni_php/aggiungi.php"><button>Filtra</button></a>
                                <a href="../logout.php"><button>Logout</button></a>
                            </div>
                        </div>

                        <div class="container">
                            <h1>Inserisci Nuovo Utente</h1>
                            <form action="salva_utente.php" method="post">
                                <div>
                                    <label for="nome">Nome:</label>
                                    <input type="text" id="nome" name="nome" required>
                                </div>
                                <div>
                                    <label for="cognome">Cognome:</label>
                                    <input type="text" id="cognome" name="cognome" required>
                                </div>
                                <div>
                                    <label for="data_nascita">Data di Nascita:</label>
                                    <input type="date" id="data_nascita" name="data_nascita" required>
                                </div>
                                <div>
                                    <label for="codice_fiscale">Codice Fiscale:</label>
                                    <input type="text" id="codice_fiscale" name="codice_fiscale" required>
                                </div>
                                <div class="form-btn">
                                    <button type="submit">Salva</button>
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