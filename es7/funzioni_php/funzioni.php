<?php
    function controlloUP($username,$password):bool{
        $logs_arr=json_decode(file_get_contents( __DIR__ . "/../data/user.txt"),true);
        if (!is_array($logs_arr)) {
            $logs_arr = [];
        }
        return (isset($logs_arr[$username]) && password_verify(trim($password), $logs_arr[$username]));
    }