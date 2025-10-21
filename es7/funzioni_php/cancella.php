<?php
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    require_once ("../classi_php/Persona.php");
    require_once ("funzioni.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
            header("location: ../logAcc.php");
            exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
            $user_arr=letturaFile("../data/data.txt");
            if(!isset($_POST["id"]) || !$user_arr[trim($_POST["id"])]){
                header("location: ../errore.php");
                exit();
            } else{
                unset($user_arr[trim($_POST["id"])]);
                scritturaFile("../data/data.txt",$user_arr);
                header("location: ../dashboard.php");
                exit();
            }
        } else{
            header("location: ../logAcc.php");
            exit();
        }
    }