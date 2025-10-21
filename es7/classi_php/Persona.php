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
            <div style='display: flex; gap: 10px; width=100%; '>
                <form method='post' action='funzioni_php/modifica.php' style='width=70%;'>
                    <input type='hidden' name='id' value='$this->codice_fiscale'>
                    <button type='submit' name='modifica'style=' background-color: #ffdddd; color: #0f5939; font-family: Arial, sans-serif; border: 2px solid #0f5939; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.2);'>Modifica i Parametri</button>
                </form>
                <form method='post' action='funzioni_php/cancella.php'>
                    <input type='hidden' name='id' value='$this->codice_fiscale'>
                    <button type='submit' name='cancella' style=' background-color: #ffdddd; color: #a00; font-family: Arial, sans-serif; border: 2px solid #a00; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.2);'>Cancella</button>
                </form>
            </div>
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