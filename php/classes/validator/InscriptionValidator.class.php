<?php

class InscriptionValidator extends Validator
{
    public function setCheckInscription()
    {
        if(isset($_POST['data_inscription']))
        {
            $optionsHash = array(
                'salt' => 'vive le projet tweet_academy',
                'cost' => 11
            );

            $pseudo = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['pseudo'])))), 1, -1);
            $email = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['email'])))), 1, -1);
            $name = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['name'])))), 1, -1);
            $date_birthday = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['date_birthday'])))), 1, -1);
            $location = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['location'])))), 1, -1);
            $password = hash('ripemd160', substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['password'])))), 1, -1));
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT, $optionsHash);
            $passwordConfirmation = hash('ripemd160', substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['passwordConfirmation'])))), 1, -1));
            $passwordConfirmationHashed = password_hash($passwordConfirmation, PASSWORD_DEFAULT, $optionsHash);

            if ($this->verifyPseudoUnique($pseudo) !== 0)  
            {
                return 1;
            } 
            if($this->verifyMinLengthIs3($pseudo) !== 0)
            {
                return 2;
            }
            if($this->verifyMaxLengthIs25($pseudo) !== 0)
            {
                return 3;
            }
            if ($this->verifyEmailIsValide($email) !== 0)  
            {
                return 4;
            } 
            if ($this->verifyEmailUnique($email) !== 0)  
            {
                return 5;
            } 
            if($this->verifyMinLengthIs3($name) !== 0)
            {
                return 6;
            }
            if($this->verifyMaxLengthIs25($name) !== 0)
            {
                return 7;
            }
            if($this->verifyAgeOverSixTeen($date_birthday) !== 0)
            {
                return 8;
            }
            if($this->verifyMinLengthIs3($location) !== 0)
            {
                return 9;
            }
            if($this->verifyMaxLengthIs25($location) !== 0)
            {
                return 10;
            }
            if($this->verifyMinLengthIs8($_POST['data_inscription']['password']) !== 0)
            {
                return 11;
            }
            if($this->verifyMaxLengthIs25($_POST['data_inscription']['password']) !== 0)
            {
                return 12;
            }
            if($this->verifyPassword($password, $passwordConfirmationHashed) !== 0)
            {
                return 13;
            }
            return 0;
        }
    }
}