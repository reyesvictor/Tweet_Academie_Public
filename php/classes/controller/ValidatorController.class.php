<?php

class ValidatorController extends Validator
{
    public $res;

// USER
    public function checkInscription() // Le handler pointe ici
    {
        include "../../classes/validator/InscriptionValidator.class.php";
        $inscriptionValidator = new InscriptionValidator();
        //$inscriptionValidator
        $checkNB = $inscriptionValidator->setCheckInscription();
        if($checkNB !== 0)
        {
            $this->res = ["msg" => $this->arrayErrorInscription[$checkNB]]; // on met le message  sous forme d'objet dans la variable $res
            echo json_encode($this->res);
            unset($inscriptionValidator);
            return;
        }
        $this->res = ["msg" => "Votre compte à bien été crée !"]; // on met le message 'ok' sous forme d'objet dans la variable $res
        echo json_encode($this->res); 
        unset($inscriptionValidator);
    }
    public function checkConnexion()
    {
        include "../../classes/validator/ConnexionValidator.class.php";
        $connexionValidator = new ConnexionValidator();
        //$connexionValidator
        $checkNB = $connexionValidator->setCheckConnexion();
        if($checkNB !== 0)
        {
            $this->res = ["msg" => $this->arrayErrorConnexion[$checkNB]]; // on met le message  sous forme d'objet dans la variable $res
            echo json_encode($this->res);
            unset($connexionValidator);
            return;
        }
        $this->res = ["msg" => "Connexion réussi"]; // on met le message 'ok' sous forme d'objet dans la variable $res
        echo json_encode($this->res); 
        unset($connexionValidator);
    }
    public function checkPassword()
    {
        include "../../classes/validator/settings/PasswordValidator.class.php";
        $passwordValidator = new PasswordValidator();
        //$passwordValidator
        $checkNB = $passwordValidator->setCheckPassword();
        if($checkNB !== 0)
        {
            $this->res = ["msg" => $this->arrayErrorPassword[$checkNB]]; // on met le message  sous forme d'objet dans la variable $res
            echo json_encode($this->res);
            unset($passwordValidator);
            return;
        }
        $this->res = ["msg" => "Mot de passe correctement modifié !"]; // on met le message 'ok' sous forme d'objet dans la variable $res
        echo json_encode($this->res); 
        unset($passwordValidator);
    }
    public function checkEmail()
    {
        include "../../classes/validator/settings/EmailValidator.class.php";
        $emailValidator = new EmailValidator();
        //$emailValidator
        $checkNB = $emailValidator->setCheckEmail();
        if($checkNB !== 0)
        {
            $this->res = ["msg" => $this->arrayErrorEmail[$checkNB]]; // on met le message  sous forme d'objet dans la variable $res
            echo json_encode($this->res);
            unset($emailValidator);
            return;
        }
        $this->res = ["msg" => "Email correctement modifié !"]; // on met le message 'ok' sous forme d'objet dans la variable $res
        echo json_encode($this->res); 
        unset($emailValidator);
    }
    public function checkPseudo()
    {
        include "../../classes/validator/settings/PseudoValidator.class.php";
        $pseudoValidator = new PseudoValidator();
        //$pseudoValidator
        $checkNB = $pseudoValidator->setCheckPseudo();
        if($checkNB !== 0)
        {
            $this->res = ["msg" => $this->arrayErrorPseudo[$checkNB]]; // on met le message  sous forme d'objet dans la variable $res
            echo json_encode($this->res);
            unset($pseudoValidator);
            return;
        }
        $this->res = ["msg" => "Pseudo correctement modifié !"]; // on met le message 'ok' sous forme d'objet dans la variable $res
        echo json_encode($this->res); 
        unset($pseudoValidator);
    }

    // TWEET
    public function checkNewTweet()
    {
        include "../../classes/validator/tweet/NewTweetValidator.class.php";
        $NewTweetValidator = new NewTweetValidator();
        //$NewTweetValidator
        $checkNB = $NewTweetValidator->setCheckNewTweet();
        if($checkNB !== 0)
        {
            $this->res = ["msg" => $this->arrayErrorNewTweet[$checkNB]]; // on met le message  sous forme d'objet dans la variable $res
            echo json_encode($this->res);
            unset($NewTweetValidator);
            return;
        }
        $this->res = ["msg" => "Tweet réussi"]; // on met le message 'ok' sous forme d'objet dans la variable $res
        echo json_encode($this->res); 
        unset($NewTweetValidator);
    }
}