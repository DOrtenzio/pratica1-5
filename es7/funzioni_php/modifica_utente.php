<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    require_once ("../classi_php/Persona.php");
    require_once ("funzioni.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
            header("location: ../logAcc.php");
            exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
            if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["data_nascita"]) && isset($_POST["codice_fiscale"]) && !empty(trim($_POST["nome"])) && !empty(trim($_POST["cognome"])) && !empty(trim($_POST["data_nascita"])) && !empty(trim($_POST["codice_fiscale"]))){
                $user_arr=letturaFile("../data/data.json");
                $persona=new Persona($_POST["nome"],$_POST["cognome"],$_POST["data_nscita"],$_POST["codice_fiscale"]);
                if( !$user_arr[trim($_POST["codice_fiscale"])]){
                    header("location: ../errore.php");
                    exit();
                } else{
                    $user_arr[trim($_POST["codice_fiscale"])]=$persona->toArray();
                    scritturaFile("../data/data.json",$user_arr);
                    header("location: ../dashboard.php");
                    exit();
                }
            } else{
                header("location: ../errore.php");
                exit();
            }
        } else{
            header("location: ../logAcc.php");
            exit();
        }
    }
