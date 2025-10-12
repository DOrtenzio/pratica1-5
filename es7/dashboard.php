<?php
    session_start();
    require_once("log.php");

    if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
        header("location: logAcc.php");
        exit();
    } else{
        if(controlloUP($_SESSION["UserLogin"],$_SESSION["PaswLogin"])){
            //pagina
        } else{
            header("location: logAcc.php");
            exit();
        }
    }
?>