<?php
if(session_status() == PHP_SESSION_NONE) session_start();

if(!isset($_SESSION["UserLogin"]) || !isset($_SESSION["PaswLogin"])){
    header("location: logAcc.php");
    exit();
} else{
    unset($_SESSION["UserLogin"]);
    unset($_SESSION["PaswLogin"]);
    header("location: index.html");
    exit();
}