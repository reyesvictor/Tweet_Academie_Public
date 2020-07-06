<?php
//MODEL, THE ONLY CLASS PERMIT TO INTERRACT WITH DATABASE. ALLOWS TO GET/SET INFORMATION FROM MY DB.

class Tweet extends Dbh  //  --- MODEL -> TWEET.CONTROLLER 
{
    // -- Private execution
    private function executeThis($sql, $array_values=null) {
        $stmt = $this->connect()->prepare($sql);
        if ( !$array_values ) {
            $stmt->execute();
        } else if ( is_string($array_values) || is_int($array_values) ) {
            $stmt->execute([$array_values]);
        } else {
            $stmt->execute($array_values);
        }
        try {
            $results = $stmt->fetchAll();
            return $results;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    // --- GET INFORMATION IN DB     
    protected function getAllTweet()
    {
        $sql = "SELECT user.username, content from tweet 
        LEFT JOIN user ON user.id = tweet.user_id 
        ORDER BY tweet.id DESC";
        return $this->executeThis($sql);
    }
    protected function getLastTweetID() 
    {
        $sql = "SELECT id from tweet order by id desc limit 1;";
        return $this->executeThis($sql);
    }
    protected function getTrendingTag()
    { 
        $sql = "SELECT tagName, count(tagName) as 'Number' 
        FROM tag group by tagName order by count(tagName) desc limit 5;";
        return $this->executeThis($sql);
    }
    protected function getSearchTweet($search)
    {
        $sql = "SELECT t1.id as tweet_id, t1.user_id, t1.content, t1.origin_id, t1.date, t1.is_disabled, u1.fullname, u1.username, u1.verified, 
        t2.id as 'tweet_id_origin', t2.user_id as 'user_id_origin', t2.content as 'content_origin', t2.date as 'date_origin', t2.is_disabled as 'is_disabled_origin', 
        u2.fullname as 'fullname_origin', u2.username as 'username_origin', u2.verified as 'verified_origin' 
        from tweet t1 left join user u1 on (t1.user_id=u1.id) left join tweet t2 on(t2.id=t1.origin_id) left join user u2 on(t2.user_id=u2.id) 
        where t1.content LIKE ? order by t1.id desc";
        return $this->executeThis($sql, $search);
    }
    protected function getuserPinnedTweet($user_id, $opt) 
    {
        $sql = "SELECT pinned_tweet, tweet.id as tweet_id, user_id, content, origin_id, date, fullname, username, verified, is_disabled  
        from tweet left join user on user_id=user.id where tweet.id = (SELECT pinned_tweet from user where $opt = ? and pinned_tweet <> 0 ) ;";
        return $this->executeThis($sql, $user_id);
    }
    protected function getuserTweet($user_id, $opt) 
    {    
        $sql = "SELECT t1.id as tweet_id, t1.user_id, t1.content, t1.origin_id, t1.date, t1.is_disabled, u1.fullname, u1.username, u1.verified, 
        t2.id as 'tweet_id_origin', t2.user_id as 'user_id_origin', t2.content as 'content_origin', t2.date as 'date_origin', t2.is_disabled as 'is_disabled_origin',          
        u2.fullname as 'fullname_origin', u2.username as 'username_origin', u2.verified as 'verified_origin'         
         from tweet t1 left join user u1 on (t1.user_id=u1.id) left join tweet t2 on(t2.id=t1.origin_id) left join user u2 on(t2.user_id=u2.id)  
         where ( {$opt} = ? ) and ( t1.id <> ( SELECT if(pinned_tweet IS NULL, 0, pinned_tweet) from user u3 where u3.id = t1.user_id ) ) 
         order by t1.id desc ";
        return $this->executeThis($sql, $user_id);
        
    }
    protected function getuserRT($user_id, $opt)
    {
        $sql = "SELECT u.username as 'rted_by', rt.id as 'rt_id', rt.user_id as 'rt_user_id', rt.tweet_id, rt.user_id, t1.content, t1.origin_id, t1.date, u2.fullname, u2.username, u2.verified, t1.is_disabled,
        u3.fullname as 'fullname_origin', u3.username as 'username_origin', u3.verified as 'verified_origin', u2.id as 'user_rted_id', 
        t2.id as 'tweet_id_origin', t2.user_id as 'user_id_origin', t2.content as 'content_origin', t2.date as 'date_origin', t2.is_disabled as 'is_disabled_origin', u3.fullname as 'fullname_origin', u3.username as 'username_origin', u3.verified as 'verified_origin'
        from retweet rt left join user u on(rt.user_id=u.id) left join tweet t1 on(rt.tweet_id=t1.id)  left join user u2 on(t1.user_id=u2.id) left join tweet t2 on(t2.id=t1.origin_id) left join user u3 on(t2.user_id=u3.id) where $opt = ? order by rt.id desc";
        return $this->executeThis($sql, $user_id);
    }
    protected function getAllTweetForHome() 
    {
        $sql = "SELECT t1.id as tweet_id, t1.user_id, t1.content, t1.origin_id, t1.date, t1.is_disabled, u1.fullname, u1.username, u1.verified, 
        t2.id as 'tweet_id_origin', t2.user_id as 'user_id_origin', t2.content as 'content_origin', t2.date as 'date_origin', t2.is_disabled as 'is_disabled_origin', 
        u2.fullname as 'fullname_origin', u2.username as 'username_origin', u2.verified as 'verified_origin' 
        from tweet t1 left join user u1 on (t1.user_id=u1.id) left join tweet t2 on(t2.id=t1.origin_id) left join user u2 on(t2.user_id=u2.id) order by t1.id desc";
        return $this->executeThis($sql);
    }
    protected function getAllRTForHome()
    {       
        $sql = "SELECT (SELECT username from retweet rt2 left join user u2 on (rt2.user_id = u2.id) 
        where rt.id=rt2.id) as 'rted_by', rt.id as 'rt_id', rt.user_id as 'rt_user_id', rt.tweet_id, rt.user_id, t1.content, t1.origin_id, t1.date, u.fullname, u.username, u.verified, t1.is_disabled,
        t2.id as 'tweet_id_origin', t2.user_id as 'user_id_origin', t2.content as 'content_origin', t2.date as 'date_origin', t2.is_disabled as 'is_disabled_origin', 
        u2.fullname as 'fullname_origin', u2.username as 'username_origin', u2.verified as 'verified_origin' , u.id as 'user_rted_id'
        from retweet rt left join tweet t1 on(rt.tweet_id=t1.id) left join user u on(t1.user_id=u.id) left join tweet t2 on(t2.id=t1.origin_id) left join user u2 on(t2.user_id=u2.id)";
        return $this->executeThis($sql);
    }
    protected function getAllUsernameForTweet()
    {       
        $sql = "SELECT username from user;";
        return $this->executeThis($sql);
    }
        protected function getUsernameForTweet($cible)
    {       
        $sql = "SELECT username from user where username LIKE ? ;";
        return $this->executeThis($sql, $cible);
    }
    protected function getuserTweetLiked($user_id)
    {       
        if ( is_numeric($user_id) ) {
            $sql = "SELECT t1.id as tweet_id, t1.user_id, t1.content, t1.origin_id, t1.date, t1.is_disabled, u1.fullname, u1.username, u1.verified, 
            t2.id as 'tweet_id_origin', t2.user_id as 'user_id_origin', t2.content as 'content_origin', t2.date as 'date_origin', t2.is_disabled as 'is_disabled_origin', 
            u2.fullname as 'fullname_origin', u2.username as 'username_origin', u2.verified as 'verified_origin' 
            from tweet t1 left join user u1 on (t1.user_id=u1.id) left join tweet t2 on(t2.id=t1.origin_id) left join user u2 on(t2.user_id=u2.id) left join likes l on l.tweet_id=t1.id where l.user_id = ? order by t1.id asc;";
        } else {
            $sql = "SELECT t1.id as tweet_id, t1.user_id, t1.content, t1.origin_id, t1.date, t1.is_disabled, u1.fullname, u1.username, u1.verified, 
            t2.id as 'tweet_id_origin', t2.user_id as 'user_id_origin', t2.content as 'content_origin', t2.date as 'date_origin', t2.is_disabled as 'is_disabled_origin', 
            u2.fullname as 'fullname_origin', u2.username as 'username_origin', u2.verified as 'verified_origin' 
            from tweet t1 left join user u1 on (t1.user_id=u1.id) left join tweet t2 on(t2.id=t1.origin_id) left join user u2 on(t2.user_id=u2.id) 
            left join likes l on l.tweet_id=t1.id left join user u4 on l.user_id=u4.id where u4.username = ? order by t1.id asc";
        }
        return $this->executeThis($sql, $user_id);
    }

    // --- SET INFORMATION IN DB
    protected function setNewTweet($idUser, $content) // TO SET THE INFORMATION OF USER IN MY DB
    {
        $sql = "INSERT INTO tweet (user_id, content, date) VALUES (?, ?, UTC_TIMESTAMP);";
        $this->executeThis($sql, [$idUser, $content]); //remplace les deux lignes inferieures
    }
    protected function setNewTag($tweet_id, $tag) {
        $sql = "INSERT INTO tag (tweet_id, tagName) VALUES (?, ?);";
        $this->executeThis($sql, [$tweet_id, $tag]);
    }
    protected function setRetweet($tweet_id, $user_id) {
        $sql = "INSERT INTO retweet (id) SELECT (id + 1) from retweet order by id desc limit 1;"; //generer id
        $this->executeThis($sql);
        $sql = "UPDATE retweet set tweet_id= ? , `user_id` = ? order by id desc limit 1;"; //ajouter les infos du retweet
        $this->executeThis($sql, [$tweet_id, $user_id]);
    }
    protected function setReply($user_id, $tweet_id, $reply) {
        $sql = "INSERT INTO tweet (`user_id`, origin_id, content) VALUES  ( ? , ? , ? );"; //ajouter les infos du retweet
        $this->executeThis($sql, [$user_id, $tweet_id, $reply]);
    }
    // --- UPDATE INFORMATION IN DB 
    protected function updateUserPinTweet($tweet_id, $user_id) { 
        $sql = "UPDATE user set pinned_tweet = ? where id = ? ;";
        $this->executeThis($sql, [$tweet_id, $user_id]);
    }
    protected function updateUserUnpinTweet($tweet_id, $user_id) { 
        $sql = "UPDATE user set pinned_tweet = NULL where pinned_tweet = ? AND id = ? ;";
        $this->executeThis($sql, [$tweet_id, $user_id]);
    }
    protected function deactivateTweet($tweet_id, $user_id) { 
        $sql = "UPDATE tweet set is_disabled = 1 where id = ? AND user_id = ? ;";
        $this->executeThis($sql, [$tweet_id, $user_id]);
    }
    protected function reactivateTweet($tweet_id, $user_id) { 
        $sql = "UPDATE tweet set is_disabled = 0 where id = ? AND user_id = ? ;";
        $this->executeThis($sql, [$tweet_id, $user_id]);
    }
}