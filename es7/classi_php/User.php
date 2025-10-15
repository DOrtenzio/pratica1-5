<?php
class User{
    private $user,$psw;

    function __construct($user,$psw){
        $this->user=$user;
        $this->psw=$psw;
    }

    //Get e set
    function get_user(): string { return $this->user; }
    function get_psw(): string { return $this->psw; }

    function set_user(string $user): void{ 
        if(!empty(trim($user)))
            $this->user=$user; 
        else
            $this->user= "null";
    }

    function set_psw(string $psw): void{ 
        if(!empty(trim($psw)))
            $this->psw=$psw; 
        else
            $this->psw= "null";
    }

    //To string
    function __tostring(): string{
        $s= "Nome Utente: $this->user , Password: $this->psw";
        return $s;
    }

    //equals
    function equals(User $userCompleto): bool{
        return $this->user===$userCompleto->get_user() && $this->psw===$userCompleto->get_psw();
    }
}
?>