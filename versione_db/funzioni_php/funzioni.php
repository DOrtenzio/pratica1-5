<?php
require("funzioni_php/connessione_db.php");
    function controlloUP($username, $password, $conn): bool {
        $sql = "SELECT * FROM utenti WHERE nomeUtente = '".$username."' AND cognomeUtente='".password_hash($password, PASSWORD_DEFAULT).";";
        $risultato = $conn->query($sql);
        return $risultato->num_rows()>0;
    }

    function query($tabella, $conn): array {
        $sql = "SELECT * FROM " . $tabella;
        $risultato = $conn->query($sql);
        return $risultato->fetchAll(PDO::FETCH_ASSOC);
    }

    function insert($tabella, $dati, $conn): bool {
        $valori = array_map(fn($v) => "'$v'", array_values($dati));
        $sql = "INSERT INTO $tabella (" . implode(", ", array_keys($dati)) . ") 
                VALUES (" . implode(", ", $valori) . ")";
        return $conn->query($sql) !== false;
    }