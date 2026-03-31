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
    $codiceFiscale = $this->codice_fiscale;
    
    return "
    <div class='card'>
        <p><strong>Nome:</strong> $this->nome</p>
        <p><strong>Cognome:</strong> $this->cognome</p>
        <p><strong>Data di Nascita:</strong> ".date("d-m-Y", strtotime($this->dataNascita))."</p>
        <p><strong>Codice Fiscale:</strong> $this->codice_fiscale</p>
        <div style='display: flex; gap: 10px; width: 100%;'>
            <form method='post' action='funzioni_php/modifica.php' style='width: 20%;'>
                <input type='hidden' name='id' value='$this->codice_fiscale'>
                <button type='submit' name='modifica' style='background-color: #ffdddd; color: #0f5939; font-family: Arial, sans-serif; border: 2px solid #0f5939; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.2);'>
                    Modifica i Parametri
                </button>
            </form>
            <button type='button' 
                    onclick='mostraConfermaCancellazione(\"$codiceFiscale\")'
                    style='background-color: #ffdddd; color: #a00; font-family: Arial, sans-serif; border: 2px solid #a00; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.2); width: 20%;'>
                Cancella
            </button>
        </div>
    </div>
    <script>
    function mostraConfermaCancellazione(codiceFiscale) {
        // Crea l'overlay di sfondo
        const overlay = document.createElement('div');
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        `;

        // Crea il popup
        const popup = document.createElement('div');
        popup.style.cssText = `
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.3);
            text-align: center;
            min-width: 300px;
            position: relative;
            font-family: Arial, sans-serif;
        `;

        // Crea il messaggio
        const messaggioElement = document.createElement('p');
        messaggioElement.textContent = 'Sei sicuro di voler cancellare questo elemento?';
        messaggioElement.style.cssText = `
            margin-bottom: 25px;
            font-size: 16px;
            color: #333;
        `;

        // Crea il contenitore dei bottoni
        const buttonContainer = document.createElement('div');
        buttonContainer.style.cssText = `
            display: flex;
            justify-content: center;
            gap: 15px;
        `;

        // Crea il bottone Annulla
        const btnAnnulla = document.createElement('button');
        btnAnnulla.textContent = 'Annulla';
        btnAnnulla.className = 'btn-comune';
        btnAnnulla.style.cssText = `
            background-color: #f0f0f0;
            color: #333;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        `;

        // Crea il bottone Conferma
        const btnConferma = document.createElement('button');
        btnConferma.textContent = 'Conferma';
        btnConferma.className = 'btn-comune';
        btnConferma.style.cssText = `
            background-color: #ffdddd;
            color: #a00;
            border: 2px solid #a00;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        `;

        // Crea il bottone X (chiudi)
        const btnChiudi = document.createElement('button');
        btnChiudi.textContent = '×';
        btnChiudi.style.cssText = `
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        `;

        // Aggiungi elementi al DOM
        buttonContainer.appendChild(btnAnnulla);
        buttonContainer.appendChild(btnConferma);
        
        popup.appendChild(btnChiudi);
        popup.appendChild(messaggioElement);
        popup.appendChild(buttonContainer);
        
        overlay.appendChild(popup);
        document.body.appendChild(overlay);

        // Funzione per rimuovere il popup
        function rimuoviPopup() {
            document.body.removeChild(overlay);
        }

        // Event listeners
        btnAnnulla.addEventListener('click', rimuoviPopup);
        btnChiudi.addEventListener('click', rimuoviPopup);
        
        btnConferma.addEventListener('click', function() {
            rimuoviPopup();
            // Crea e invia il form per la cancellazione
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'funzioni_php/cancella.php';
            form.style.display = 'none';
            
            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'id';
            inputId.value = codiceFiscale;
            
            const inputCancella = document.createElement('input');
            inputCancella.type = 'hidden';
            inputCancella.name = 'cancella';
            inputCancella.value = '1';
            
            form.appendChild(inputId);
            form.appendChild(inputCancella);
            document.body.appendChild(form);
            form.submit();
        });

        // Chiudi cliccando sull'overlay
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                rimuoviPopup();
            }
        });
    }
    </script>
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