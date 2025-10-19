<?php
    function controlloUP($username,$password):bool{
        $logs_arr=json_decode(file_get_contents( __DIR__ . "/../data/user.txt"),true);
        if (!is_array($logs_arr)) {
            $logs_arr = [];
        }
        return (isset($logs_arr[$username]) && password_verify(trim($password), $logs_arr[$username]));
    }

    function letturaFile($percorso):array{
        $logs_arr=json_decode(file_get_contents($percorso),true);
        if (!is_array($logs_arr)) {
            $logs_arr = [];
        }
        return $logs_arr;
    }

    function scritturaFile($percorso,$dati): void{
        file_put_contents($percorso, json_encode($dati));
    }