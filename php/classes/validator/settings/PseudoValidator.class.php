<?php

class PseudoValidator extends Validator
{
    public function setCheckPseudo()
    {
        if(isset($_POST['data_newPseudo']))
        {
            $newPseudo = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_newPseudo']['pseudo'])))), 1, -1);
            if ($this->verifyPseudoUnique($newPseudo) !== 0)  
            {
                return 1;
            } 
            if ($this->verifyIssetAndNotEmpty($_POST['data_newPseudo']['pseudo']) !== 0) 
            {
                return 2;
            }
            if($this->verifyMinLengthIs3($newPseudo) !== 0)
            {
                return 3;
            }
            if($this->verifyMaxLengthIs25($newPseudo) !== 0)
            {
                return 4;
            }
            return 0;
        }
    }
}