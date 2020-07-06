<?php
//CONTROLLER, INTERACT TO CREATE/UPDATE SOMETHING WITH USER IN THE DB.
class TweetController extends Tweet
{
    private function sortArrayOfTweets($allTweets, $allRT) {
        for ($i=0; $i < count($allRT); $i++) { //insérer les retweets
            array_push($allTweets, $allRT[$i]);
        }
        usort($allTweets, function($a, $b) { //trier par id, on display ainsi dans le jquery du plus récent au plus ancien, source https://stackoverflow.com/questions/2699086/how-to-sort-multi-dimensional-array-by-value
            return $a['tweet_id'] <=> $b['tweet_id'];
        });
        return $allTweets;
    }
    private function setNewTagGenerator($content, $tweet_id) {
        $tag = explode(' ', $content); 
        for ( $i = 0; $i < count($tag); $i++) { //enregistrer tous les tags
            if ( substr($tag[$i], 0, 1) == "#" ) {
                $this->setNewTag($tweet_id, $tag[$i]);
            }
        }
    }
    // --- GET INFORMATION IN DB     
    public function showAllTweet()
    {
        return $this->getAllTweet();
    }
    public function trendingTag()
    {
        return $this->getTrendingTag();
    }
    public function searchTweet($search) 
    {
        $search = "%{$search}%"; 
        return $this->getSearchTweet($search);
    }
    public function allTweetsAndRT()
    {
        $allTweets = $this->sortArrayOfTweets( $this->getAllTweetForHome(), $this->getAllRTForHome() );
        return array_reverse($allTweets);
    }
    public function userTweetsAndRT($user_id)
    {
        if ( is_numeric($user_id) ) {
            $allTweets = $this->sortArrayOfTweets( $this->getuserTweet($user_id, 'u1.id'), $this->getuserRT($user_id, 'rt.user_id') );
            $pinned_tweet = $this->getuserPinnedTweet($user_id, 'id'); 
        } else {
            $allTweets = $this->sortArrayOfTweets( $this->getuserTweet($user_id, 'u1.username'), $this->getuserRT($user_id, 'u.username') );
            $pinned_tweet = $this->getuserPinnedTweet($user_id, 'username'); 
        }
        if ( count($pinned_tweet)  ) { 
            array_push($allTweets, $pinned_tweet[0]);
        }
        return array_reverse($allTweets);
    }
    public function userTweetLiked($user_id)
    {
        $allTweets = $this->getuserTweetLiked($user_id);
        return array_reverse($allTweets);
    }
    public function usernameForTweet($cible) {
        if ( $cible == '@' ) {
            return $this->getAllUsernameForTweet();
        } else {
            $cible = substr($cible, 1);
            $cible = "{$cible}%";
            return $this->getUsernameForTweet($cible);
        }
    }

    // --- SET INFORMATION IN DB
    public function createNewTweet($idUser, $content)
    {
        $this->setNewTweet($idUser, $content); //enregitrer le tweet
        $tweet_id = $this->getLastTweetID(); //recuperer l'id du tweet
        $this->setNewTagGenerator($content, $tweet_id[0]['id']);
    }
    public function retweet($data_RT) 
    {
        return $this->setRetweet($data_RT['tweet_id'], $data_RT['user_id']);
    }
    public function reply($data_RT) 
    {
        $this->setNewTagGenerator($data_RT['tweet_id']['reply'], $data_RT['tweet_id']['tweet_id']);
        return $this->setReply($data_RT['user_id'], $data_RT['tweet_id']['tweet_id'], $data_RT['tweet_id']['reply']);
    }

    // --- UPDATE INFORMATION IN DB 
    public function userPinTweet($data_pin) 
    {
        return $this->updateUserPinTweet($data_pin['tweet_id'], $data_pin['user_id']);
    }
    public function userUnpinTweet($data_pin) 
    {
        return $this->updateUserUnpinTweet($data_pin['tweet_id'], $data_pin['user_id']);
    }
    public function delTweet($data_pin) 
    {
        $this->updateUserUnpinTweet($data_pin['tweet_id'], $data_pin['user_id']);
        return $this->deactivateTweet($data_pin['tweet_id'], $data_pin['user_id']);
    }
}