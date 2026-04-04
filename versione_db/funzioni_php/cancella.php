<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    require_once ("../classi_php/Persona.php");
    require ("funzioni.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
            header("location: ../logAcc.php");
            exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"],$conn)){
            $user_arr=query("Persone",$conn);
            if(!isset($_POST["id"]) || !$user_arr[trim($_POST["id"])]){
                header("location: ../errore.php");
                exit();
            } else{
                delete("Persone",trim($_POST["id"]),$conn);
                header("location: ../dashboard.php");
                exit();
            }
        } else{
            header("location: ../logAcc.php");
            exit();
        }
    }