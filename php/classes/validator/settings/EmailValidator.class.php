<?php

class EmailValidator extends Validator
{
    public function setCheckEmail()
    {
        if(isset($_POST['data_newEmail']))
        {
            $password = hash('ripemd160', substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newEmail']['password'])))), 1, -1));
            $newEmail = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newEmail']['newEmail'])))), 1, -1);
            $idMember = intval(substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newEmail']['idMember'])))), 1, -1));
            $verifPassword = $this->getPassword("id", $idMember); 

            if ($this->verifyPassword($password, $verifPassword['pwd']) !== 0) 
            {
                return 1;
            }
            if ($this->verifyIssetAndNotEmpty($_POST['data_newEmail']['newEmail']) !== 0) 
            {
                return 2;
            }
            if ($this->verifyEmailIsValide($newEmail) !== 0)  
            {
                return 3;
            } 
            if ($this->verifyEmailUnique($newEmail) !== 0)  
            {
                return 4;
            } 
            return 0;
        }
    }
}