<?php
require_once("connessione_db.php");

    function controlloUP($username, $password, $conn): bool {
        $sql = "SELECT passwordUtente FROM utenti WHERE nomeUtente = '$username'";
        $riga = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        return isset($riga) && password_verify(trim($password), $riga["passwordUtente"]);
    }

    function query($tabella, $conn): array {
        $sql="SELECT * FROM $tabella";
        $righe = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $arr = [];

        foreach ($righe as $riga) {
            if (isset($riga["codF"])) {
                $riga["codice_fiscale"] = $riga["codF"];
                unset($riga["codF"]);
                $arr[$riga["codice_fiscale"]] = $riga;
            } elseif (isset($riga["nomeUtente"])) {
                $arr[$riga["nomeUtente"]] = $riga["passwordUtente"];
            } else {
                $arr[] = $riga;
            }
        }

        return $arr;
    }

    function insert($tabella, $dati, $conn): bool {
        $sql = "INSERT INTO $tabella (codF, nome, cognome, data_nascita)
                VALUES (
                    '{$dati["codice_fiscale"]}',
                    '{$dati["nome"]}',
                    '{$dati["cognome"]}',
                    '{$dati["data_nascita"]}')";

        return $conn->query($sql) !== false;
    }

    function update($tabella, $dati, $conn): bool {
        $sql = "UPDATE $tabella SET
                    nome = '{$dati["nome"]}',
                    cognome = '{$dati["cognome"]}',
                    data_nascita = '{$dati["data_nascita"]}'
                WHERE codF = '{$dati["codice_fiscale"]}'";

        return $conn->query($sql) !== false;
    }

    function delete($tabella, $id, $conn): bool {
        return $conn->query("DELETE FROM $tabella WHERE codF = '$id'") !== false;
    }

    function insertUtente($username, $passwordHash, $conn): bool {
        return $conn->query(
            "INSERT INTO utenti (nomeUtente, passwordUtente)
            VALUES ('$username', '$passwordHash')"
        ) !== false;
    }