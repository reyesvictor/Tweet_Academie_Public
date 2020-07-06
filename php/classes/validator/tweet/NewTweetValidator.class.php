<?php

class NewTweetValidator extends Validator 
{
    public function setCheckNewTweet()
    {
        if(isset($_POST['data_newTweet']))
        {
            $newTweetContent = substr(json_encode(strip_tags($_POST['data_newTweet']['content-tweet'])), 1, -1);
            if ($this->verifyMaxLengthIs140($newTweetContent) !== 0)  
            {
                return 1;
            } 
            if ($this->verifyTweetNotVoid($newTweetContent) !== 0) 
            {
                return 2;
            }    
            return 0;
        }
    }
}