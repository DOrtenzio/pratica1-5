<?php
    if(session_status()==PHP_SESSION_NONE)session_start();
    if(!isset($_SESSION["selezione_filtro"])) $_SESSION["selezione_filtro"] = "tutto";

    require_once ("funzioni_php/funzioni.php");
    require_once("classi_php/Persona.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
        header("location: logAcc.php");
        exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
            $dati_arr=letturaFile("data/data.json");
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
                    if($_SESSION["selezione_filtro"] == "tutto") $dati_utenti.=$persona1->toCard();
                    else if($_SESSION["selezione_filtro"] == "cognome") {
                        if(isset($_SESSION["selezione_filtro_cognome"]) && !empty(trim($_SESSION["selezione_filtro_cognome"])) && $_SESSION["selezione_filtro_cognome"]==($persona1->get_cognome())){
                            $dati_utenti.=$persona1->toCard();
                        }
                    }
                    else if($_SESSION["selezione_filtro"] == "data") {
                        if(isset($_SESSION["selezione_filtro_data"]) && !empty(trim($_SESSION["selezione_filtro_data"])) && $_SESSION["selezione_filtro_data"]==($persona1->get_dataNascita())){
                            $dati_utenti.=$persona1->toCard();
                        }
                    } else{
                        header("location: logout.php");
                        exit();
                    }
            }
            echo '<!DOCTYPE html>
                    <html lang="it">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Sito Generico</title>
                        <link rel="stylesheet" href="style/style.css">
                        <link rel="stylesheet" href="style/style_dash.css">
                    </head>
                    <body style="padding-top: 18vh;">
                    <div class="banner">
                        <h2>Sito Generico</h2>
                        <div class="button-cont">
                            <a href="funzioni_php/aggiungi.php"><button>Aggiungi</button></a>
                            <a href="funzioni_php/filtra.php"><button>Filtra</button></a>
                            <a href="logout.php"><button>Logout</button></a>
                        </div>
                    </div>
                    <div class="container-dash">
                        <p>Sito Generico</p>
                        <p>Ecco i Dati relativi agli utenti!</p>
                        '.$dati_utenti.'
                    </div>
                    </body>
                    </html>';
        }
        } else{
            header("location: logAcc.php");
            exit();
        }
    }
    
?>