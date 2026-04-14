<?php

class DBInt {
    private PDO $conn;
    private string $dbName;

    public function __construct($servername, $username, $password, $dbName) {
        $this->dbName = $dbName;

        $this->conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //Lettura delle colonne e delle tabelle da INFORMATION_SCHEMA
    private function checkTable(string $tabella): bool {
        $sql = "SELECT COUNT(*)
                FROM INFORMATION_SCHEMA.TABLES 
                WHERE TABLE_SCHEMA = :db AND 
                      TABLE_NAME = :tab";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':db' => $this->dbName,':tab' => $tabella]);

        return $stmt->fetchColumn() > 0;
    }

    private function getColumns(string $tabella): array {
        $sql = "SELECT COLUMN_NAME 
                FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_SCHEMA = :db AND 
                      TABLE_NAME = :tab";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':db' => $this->dbName,':tab' => $tabella]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN); //["cc1", "cc2", "cc3", "cc4"]
    }

    private function checkColumns(string $tabella, array $dati): array {
        //elimino le colonne passate inesistenti
        $colonne = $this->getColumns($tabella); //controllo colonna
        return $datiFiltrati = array_intersect_key($dati, array_flip($colonne)); //mantengo solo ele con chiavi in comune
    }

    //OPERAZIONI
    public function query(string $tabella): array {
        if (!$this->checkTable($tabella)) throw new Exception("Tabella non valida");
        $stmt = $this->conn->query("SELECT * FROM `$tabella`");
        $righe = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function($riga) { return (object)$riga; }, $righe); //arr di oggetto
    }

    public function insert(string $tabella, array $dati): bool {
        if (!$this->checkTable($tabella)) throw new Exception("Tabella non valida");

        $datiFiltrati=checkColumns($tabella,$dati); //
        $campi = array_keys($datiFiltrati); //k
        $placeholders = array_map(fn($f) => ":$f", $campi);

        $sql = "INSERT INTO `$tabella` (" . implode(",", $campi) . ")
                VALUES (" . implode(",", $placeholders) . ")";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($datiFiltrati);
    }

    public function update(string $tabella, array $dati, string $pk = "id"): bool {
        if (!$this->checkTable($tabella)) throw new Exception("Tabella non valida");
        $datiFiltrati=checkColumns($tabella,$dati);
        if (!isset($datiFiltrati[$pk])) throw new Exception("Chiave primaria mancante");

        $set = [];
        foreach ($datiFiltrati as $col => $val) {
            if ($col !== $pk) {
                $set[] = "`$col` = :$col";
            }
        }

        $sql = "UPDATE `$tabella` SET" . implode(",", $set) . " WHERE `$pk` = :$pk";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($datiFiltrati);
    }

    public function delete(string $tabella, $id, string $pk = "id"): bool {
        if (!$this->checkTable($tabella)) throw new Exception("Tabella non valida");
        $sql = "DELETE FROM `$tabella` WHERE `$pk` = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}