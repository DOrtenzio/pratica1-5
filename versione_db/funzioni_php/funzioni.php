<?php
require_once("connessione_db.php");

    function controlloUP($username, $password, $conn): bool {
        $stmt = $conn->prepare( "SELECT passwordUtente FROM utenti WHERE nomeUtente = :username");
        $stmt->execute([':username' => $username]);
        $riga = $stmt->fetch(PDO::FETCH_ASSOC);
        return $riga && password_verify(trim($password), $riga["passwordUtente"]);
    }

    function query($tabella, $conn): array {
        $allowed = ['utenti', 'persone'];
        if (!in_array($tabella, $allowed)) throw new Exception("Tabella non valida");
        $righe = $conn->query("SELECT * FROM $tabella")->fetchAll(PDO::FETCH_ASSOC);
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
                VALUES (:codF, :nome, :cognome, :data_nascita)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':codF' => $dati["codice_fiscale"],
            ':nome' => $dati["nome"],
            ':cognome' => $dati["cognome"],
            ':data_nascita' => $dati["data_nascita"]
        ]);
    }

    function update($tabella, $dati, $conn): bool {
        $sql = "UPDATE $tabella SET
                    nome = :nome,
                    cognome = :cognome,
                    data_nascita = :data_nascita
                WHERE codF = :codF";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $dati["nome"],
            ':cognome' => $dati["cognome"],
            ':data_nascita' => $dati["data_nascita"],
            ':codF' => $dati["codice_fiscale"]
        ]);
    }

    function delete($tabella, $id, $conn): bool {
        $stmt = $conn->prepare("DELETE FROM $tabella WHERE codF = :id");
        return $stmt->execute([':id' => $id]);
    }

    function insertUtente($username, $passwordHash, $conn): bool {
        $stmt = $conn->prepare(
            "INSERT INTO utenti (nomeUtente, passwordUtente)
             VALUES (:username, :password)"
        );
        return $stmt->execute([
            ':username' => $username,
            ':password' => $passwordHash
        ]);
    }