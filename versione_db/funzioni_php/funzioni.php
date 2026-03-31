<?php
    function controlloUP($username,$password):bool{  //CAMBIARE
        $logs_arr=json_decode(file_get_contents( __DIR__ . "/../data/user.json"),true);
        if (!is_array($logs_arr)) {
            $logs_arr = [];
        }
        return (isset($logs_arr[$username]) && password_verify(trim($password), $logs_arr[$username]));
    }

    function query($percorso):array{ //CAMBIARE
        $logs_arr=json_decode(file_get_contents($percorso),true);
        if (!is_array($logs_arr)) {
            $logs_arr = [];
        }
        return $logs_arr;
    }

    function insert($percorso,$dati): void{ //CAMBIARE
        file_put_contents($percorso, json_encode($dati));
    }