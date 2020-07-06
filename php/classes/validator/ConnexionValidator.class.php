<?php

class ConnexionValidator extends Validator
{
    public function setCheckConnexion()
    {
        if(isset($_POST['data_connexion']))
        {
            $pseudo = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_connexion']['pseudo'])))), 1, -1);
            $password = hash('ripemd160', substr(json_encode($_POST['data_connexion']['password']), 1, -1));
            if ($this->verifyPseudoExist($pseudo) !== 0)  
            {
                return 1;
            } 
            $verifPassword = $this->getPassword("username", $pseudo);
            if ($this->verifyPassword($password, $verifPassword['pwd']) !== 0) 
            {
                return 2;
            }    
            return 0;
        }
    }
}