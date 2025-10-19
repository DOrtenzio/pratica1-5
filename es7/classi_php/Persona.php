<?php
class Persona{
    private $nome,$cognome,$dataNascita,$codice_fiscale;

    function __construct($nome,$cognome,$dataNascita,$codice_fiscale){
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->dataNascita=$dataNascita;
        $this->codice_fiscale=$codice_fiscale;
    }

    //Get e set
    function get_nome(): string { return $this->nome; }
    function get_cognome(): string { return $this->cognome; }
    function get_dataNascita(): string { return $this->dataNascita; }
    function get_codice_fiscale(): string { return $this->codice_fiscale; }

    function set_nome(string $nome): void{ 
        if(!empty(trim($nome)))
            $this->nome=$nome; 
        else
            $this->nome= "null";
    }

    function set_cognome(string $cognome): void{ 
        if(!empty(trim($cognome)))
            $this->cognome=$cognome; 
        else
            $this->cognome= "null";
    }

    function set_dataNascita(string $dataNascita): void{ 
        if(!empty(trim($dataNascita)))
            $this->dataNascita=$dataNascita; 
        else
            $this->dataNascita= "null";
    }

    function set_codice_fiscale(string $codice_fiscale): void{ 
        if(!empty(trim($codice_fiscale)) && strlen(trim($codice_fiscale))==16) //Controllo solo lunghezza per semplificare
            $this->codice_fiscale=$codice_fiscale; 
        else
            $this->codice_fiscale= "null";
    }

    //To string
    function __tostring(): string{
        $s= "Nome: $this->nome , Cognome: $this->cognome , Data di Nascita: $this->dataNascita , Codice Fiscale: $this->codice_fiscale";
        return $s;
    }

    //equals
    function equals(Persona $personaCompleta): bool{
        return $this->nome===$personaCompleta->get_nome() && $this->cognome===$personaCompleta->get_cognome() && $this->dataNascita===$personaCompleta->get_dataNascita() && $this->codice_fiscale===$personaCompleta->get_codice_fiscale();
    }

    function toRigaTabella(): string{
        return "<tr><td>$this->nome</td><td>$this->cognome</td><td>$this->dataNascita</td><td>$this->codice_fiscale</td></tr>";
    }

    function toCard(): string {
        return "
        <div class='card'>
            <p><strong>Nome:</strong> $this->nome</p>
            <p><strong>Cognome:</strong> $this->cognome</p>
            <p><strong>Data di Nascita:</strong> $this->dataNascita</p>
            <p><strong>Codice Fiscale:</strong> $this->codice_fiscale</p>
            <form method='post' action='funzioni_php/modifica.php'>
                <input type='hidden' name='id' value='$this->codice_fiscale'>
                <button type='submit' name='modifica'>Modifica i Parametri</button>
            </form>
        </div>
        ";
    }
    

    function toArray(): array {
        return [
            'nome'=> $this->nome,
            'cognome'=> $this->cognome,
            'data_nascita'=> $this->dataNascita,
            'codice_fiscale'=> $this->codice_fiscale
        ];
    }
    
}