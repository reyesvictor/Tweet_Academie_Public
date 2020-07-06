<?php

class Validator extends UserController
{
            //   ------------------------------------USER------------------------------------

//                              --- VERIFICATION POUR LE MOT DE PASSE AVEC SON ARRAY

    public $arrayErrorPassword = 
        [   0 => 'Erreur non définie.', 
            1 => 'Erreur 1 : Mauvais mot de passe.', 
            2 => 'Erreur 2 : Veuillez renseigner un nouveau mot de passe.',
            3 => 'Erreur 3 : Les nouveaux mots de passe ne correspondent pas.', 
            4 => 'Erreur 4 : Votre nouveau mot de passe doit contenir au moins 8 carractère.',
            5 => 'Erreur 5 : Le nouveau mot de passe ne peux pas être identique à l\'ancien.', 
            6 => 'Erreur 6: Mot de passe trop long (max 25 caractères).'
        ];

    protected function verifyPassword($password, $passwordHashed) // vérifie si l'user rentre le bon mdp du compte (verif avec le mdp non hashé et le mdp hashé)
    {
        if(!password_verify($password, $passwordHashed))
        {
            return 1; // Mauvais mot de passe (1)
        }
        return 0;
    }
    protected function verifyIssetAndNotEmpty($val) // vérifie si la variable en paramètre existe et qu'elle n'est pas vide 
    {
        if(isset($val) && !empty($val))
        {
            return 0; // Veuillez renseigner le champs $val (1)
        } 
        return 2;
    }
    // ERREUR 03 GERER AVEC ((verifyPassword)
    protected function verifyMinLengthIs8($val) // vérifie si la variable fait au moins 8 caractères 
    {
        if(strlen($val) < 8)
        {
            return 4;
        }
        return 0;
    }
    protected function verifyIsNotIdentical($val, $val2) // vérifie si la première variable en paramètre n'est pas identique à la deuxième (return 0 si elle est différente)
    {
        if($val == $val2)
        {
            return 5; // Veuillez renseigner le champs $val (1)
        } 
        return 0;
    }
    protected function verifyMaxLengthIs25($val) // vérifie si la variable fait au moins 8 caractères 
    {
        if(strlen($val) > 25)
        {
            return 6;
        }
        return 0;
    }
//                              --- VERIFICATION POUR L'EMAIL AVEC SON ARRAY
    public $arrayErrorEmail = 
    [   0 => 'Erreur non définie', 
        1 => 'Erreur 1 : Mauvais mot de passe.', 
        2 => 'Erreur 2 : Veuillez renseigner un nouveau mail.',
        3 => 'Erreur 3 : L\'email n\'est pas valide.', 
        4 => 'Erreur 4 : L\'email renseigné est déjà utilisée.',
        5 => 'Erreur 5 : Le nouveau mot de passe ne peux pas être identique à l\'ancien.'
    ];
    
    // ERREUR 1 EST GERER DANS 'VERIFICATION POUR LE MOT DE PASSE' (verifyPassword)
    // ERREUR 2 EST GERER DANS 'VERIFICATION POUR LE MOT DE PASSE' (verifyIssetAndNotEmpty)
    protected function verifyEmailIsValide($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return 3;
        }
        return 0;
    }
    protected function verifyEmailUnique($email)
    {
        if($this->verifEmailUnique($email) !== true)
        {
            return 4;
        }
        return 0;
    }
//                              --- VERIFICATION POUR LE PSEUDO AVEC SON ARRAY

    public $arrayErrorPseudo = 
    [   0 => 'Erreur non définie.', 
        1 => 'Erreur 1 : Le pseudo existe déjà.', 
        2 => 'Erreur 2 : Veuillez renseigner un pseudo.',
        3 => 'Erreur 3 : Votre pseudo doit contenir au minimum 3 caractères.',
        4 => 'Erreur 4 : Pseudo trop long il ne peut pas contenir plus de 25 caractères.'

    ];
    protected function verifyPseudoUnique($pseudo)
    {
        if($this->verifPseudoUnique($pseudo) !== true)
        {
            return 1;
        }
        return 0;
    }
    // ERREUR 2 EST GERER DANS 'VERIFICATION POUR LE MOT DE PASSE' (verifyIssetAndNotEmpty)
    protected function verifyMinLengthIs3($pseudo) // vérifie si la variable fait au moins 8 caractères 
    {
    if(strlen($pseudo) < 3)
    {
        return 3;
    }
    return 0;
    }
    // ERREUR 6 EST GERER DANS 'VERIFICATION POUR LE MOT DE PASSE' (verifyMaxLengthIs25)

//                              --- VERIFICATION POUR L'INSCRIPTION AVEC SON ARRAY

    public $arrayErrorInscription = 
    [   0 => 'Erreur non définie.', 
        1 => 'Erreur 1 : Ce pseudo est déjà utilisé.', 
        2 => 'Erreur 12 : Votre pseudo n\'est pas valide celui ci doit contenir au minimum 3 caractères.',
        3 => 'Erreur 3 : Votre pseudo n\'est pas valide celui ci ne peux pas contenir plus de 25 caractères.',
        4 => 'Erreur 4 : L\'email n\'est pas valide.', 
        5 => 'Erreur 5 : Cette email est déjà utiliser.', 
        6 => 'Erreur 6 : Votre nom n\'est pas valide celui ci doit contenir au minimum 3 caractères.', 
        7 => 'Erreur 7 : Votre nom n\'est pas valide celui ci ne peux pas contenir plus de 25 caractères.', 
        8 => 'Erreur 8 : Il faut avoir minimum 16ans pour pouvoir s\'inscrire petite tapette.', 
        9 => 'Erreur 9 : Localisation non valide.', 
        10 => 'Erreur 10 : Localisation non valide.', 11 => 'Erreur 11 : Le mot de passe doit contenir au minimum 8 caractères.',  
        12 => 'Erreur 12 : Le mot de passe ne peux pas contenir plus de 25 caractères.', 
        13 => 'Erreur 13 : Les mots de passe ne correspondent pas.'
    ];
    // ERREUR 01 EST GERER DANS 'VERIFICATION POUR LE PSEUDO' (verifyPseudoUnique)
    // ERREUR 02 EST GERER DANS 'VERIFICATION POUR L'EMAIL' (verifyEmailIsValide)
    // ERREUR 03 EST GERER DANS 'VERIFICATION POUR L'EMAIL' (verifyEmailUnique)
    // ERREUR 04 EST GERER DANS 'VERIFICATION POUR LE PSEUDO' (verifyMinLengthIs3)
    // ERREUR 05 EST GERER DANS 'VERIFICATION POUR LE PASSWORD' (verifyMaxLengthIs25)
    protected function verifyAgeOverSixTeen($date_birthday)
    {
        $date = new DateTime();
        $date_16 = $date->sub(new DateInterval('P16Y'));
        $date_birthdayVerif = new DateTime($date_birthday);
        if($date_birthdayVerif <= $date_16)
        {
            return 0;
        }
        return 6;
    }
    // ERREUR 07 EST GERER DANS 'VERIFICATION POUR LELE PSEUDO' (verifyMinLengthIs3)
    // ERREUR 08 EST GERER DANS 'VERIFICATION POUR LE PASSWORD' (verifyMaxLengthIs25)
    // ERREUR 09 EST GERER DANS 'VERIFICATION POUR LE PASSWORD' (verifyMinLengthIs8)
    // ERREUR 10 EST GERER DANS 'VERIFICATION POUR LE PASSWORD' (verifyMaxLengthIs25)
    // ERREUR 11 EST GERER DANS 'VERIFICATION POUR LE PASSWORD' (verifyIdentical)
    // ERREUR 12 EST GERER DANS 'VERIFICATION POUR LELE PSEUDO' (verifyMinLengthIs3)
    // ERREUR 13 EST GERER DANS 'VERIFICATION POUR LE PASSWORD' (verifyMaxLengthIs25)

//                              --- VERIFICATION POUR LA CONENXION AVEC SON ARRAY

    public $arrayErrorConnexion = 
    [   0 => 'Erreur non définie.', 
        1 => 'Erreur 1 : Mauvais pseudo.', 
        2 => 'Erreur 2 : Mauvais mot de passe.',
    ];
    protected function verifyPseudoExist($pseudo)
    {
        if($this->verifPseudoUnique($pseudo) !== true)
        {
            return 0;
        }
        return 1;
    }
      // ERREUR 2 EST GERER DANS 'VERIFICATION POUR LE PASSWORD' (verifyPassword)

//                          ------------------------------------TWEET------------------------------------
    public $arrayErrorNewTweet = 
    [   0 => 'Erreur non définie.', 
        1 => 'Erreur 1 : Tweet trop long (max 140 caractères).', 
        2 => 'Vous ne pouvez pas envoyé un tweet vide !',
    ];
    protected function verifyMaxLengthIs140($tweetContent) // vérifie si la variable fait au moins 140 caractères 
    {
        if(strlen($tweetContent) > 140)
        {
            return 1;
        }
        return 0;
    }
    protected function verifyTweetNotVoid($tweetContent) // vérifie si la variable fait au moins 140 caractères 
    {
        if($tweetContent == "" || strlen($tweetContent) < 1)
        {
            return 2;
        }
        return 0;
    }
}