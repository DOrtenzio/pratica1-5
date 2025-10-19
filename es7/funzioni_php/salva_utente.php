<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    require_once ("../classi_php/Persona.php");
    require_once ("funzioni.php");

    if(isset($_POST["nome"]) && !empty(trim($_POST["nome"])) && isset($_POST["cognome"]) && !empty(trim($_POST["cognome"])) && isset($_POST["data_nascita"]) && !empty(trim($_POST["data_nascita"])) && isset($_POST["codice_fiscale"]) && !empty(trim($_POST["codice_fiscale"]))){
        if(aggiuntaNuovaPersona(new Persona(trim($_POST["nome"]),trim($_POST["cognome"]),trim($_POST["data_nascita"]),trim($_POST["codice_fiscale"])))){
            header("location: ../dashboard.php");
            exit();
        } else{
            $_SESSION["msg_errore"]="true";
            header("location: ../errore.php");
            exit();
        }
            
    } else{
        $_SESSION["msg_errore"]="true";
        header("location: ../errore.php");
        exit();
    }

    function aggiuntaNuovaPersona(Persona $persona) : bool {
        $user_arr = letturaFile("../data/data.txt");
        if (isset($user_arr[$persona->get_codice_fiscale()])) {
            return false;
        } else {
            $user_arr[$persona->get_codice_fiscale()] = $persona->toArray(); //salvo array associativo di Persona nell'array di arrayassociativi nel file
            scritturaFile("../data/data.txt", $user_arr);
            return true;
        }
    }