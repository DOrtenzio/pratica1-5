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
               if(isset($_SESSION["selezione_filtro"]) && $_SESSION["selezione_filtro"]=="cognome"){
                    $_SESSION["selezione_filtro_cognome"]=trim($_POST["filtro"]);
                    header("location: ../dashboard.php");
                    exit();
                } else if (isset($_SESSION["selezione_filtro"]) && $_SESSION["selezione_filtro"]=="data"){
                    $_SESSION["selezione_filtro_data"]=trim($_POST["filtro"]);
                    header("location: ../dashboard.php");
                    exit();
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