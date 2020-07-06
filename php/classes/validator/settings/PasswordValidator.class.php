<?php

class PasswordValidator extends Validator
{
    public function setCheckPassword()
    {
        if(isset($_POST['data_newPassword']))
        {
            $optionsHash = array(
                'salt' => 'vive le projet tweet_academy',
                'cost' => 11
            );
            $password = hash('ripemd160', substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newPassword']['password'])))), 1, -1));
            $newPassword = hash('ripemd160', (substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newPassword']['newPassword'])))), 1, -1)));
            $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT, $optionsHash);
            $newPasswordConfirmation = hash('ripemd160', (substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newPassword']['newPasswordConfirmation'])))), 1, -1)));
            $newPasswordConfirmationHashed = password_hash($newPasswordConfirmation, PASSWORD_DEFAULT, $optionsHash);
            $idMember = intval(substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newPassword']['idMember'])))), 1, -1));
            $verifPassword = $this->getPassword("id", $idMember); 

            if ($this->verifyPassword($password, $verifPassword['pwd']) !== 0) 
            {
                return 1;
            }           
            //return var_dump($this->verifyIssetAndNotEmpty($newPassword)."-----". $_POST['data_newPassword']['newPassword']);
            if ($this->verifyIssetAndNotEmpty($_POST['data_newPassword']['newPassword']) !== 0) 
            {
                return 2;
            }
            if ($this->verifyPassword($newPassword, $newPasswordConfirmationHashed) !== 0) 
            {
                return 3;
            }    
            if($this->verifyMinLengthIs8($_POST['data_newPassword']['newPassword']) !== 0)
            {
                return 4;
            }
            if($this->verifyIsNotIdentical($_POST['data_newPassword']['password'], $_POST['data_newPassword']['newPassword']) !== 0)
            {
                return 5;
            }
            if($this->verifyMaxLengthIs25($_POST['data_newPassword']['newPassword']) !== 0)
            {
                return 6;
            }
            return 0;
        }
    }
}