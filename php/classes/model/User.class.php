<?php   //MODEL, THE ONLY CLASS PERMIT TO INTERRACT WITH DATABASE. ALLOWS TO GET/SET INFORMATION FROM MY DB.

class User extends Dbh  //  --- MODEL -> USER.CONTROLLER 
{ 
    private function executeThis($sql, $array_values=null) { //changer en array
        $stmt = $this->connect()->prepare($sql);
        if ( !$array_values ) {
            $stmt->execute();
        } else if ( is_string($array_values) || is_int($array_values)) {
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
    protected function setVerifPseudoUnique($pseudo)
    {
        $sql = "SELECT username from user WHERE username = ?";
        return $this->executeThis($sql, $pseudo);

    }
    protected function setVerifEmailUnique($email)
    {
        $sql = "SELECT email from user WHERE email = ?";
        return $this->executeThis($sql, $email);
    }
    protected function findIdWithPseudo($pseudo)
    {
        $sql = "SELECT id from user WHERE username = ?";
        return $this->executeThis($sql, $pseudo);
    }
    protected function findPseudoWithID($idMember)	
    {	
        $sql = "SELECT username from user WHERE id = ?";	
        return $this->executeThis($sql, $idMember);	
    }	
    protected function getPassword($setting, $val)	
    {   	
        $sql = "SELECT pwd from user where $setting = ?";	
        $verifPassword = $this->executeThis($sql, $val);
        foreach($verifPassword as $key => $value)	
        {	
            $verifPassword = $value;	
        }	
        return $verifPassword;	
    }
    protected function getFollowers($user_id, $opt)	
    {	
        $sql = "SELECT u.id as id, u.fullname, u.username, u.bio, u.verified, u.disabled from follow f left join user u on f.subscriber_id = u.id left join user u2 on u2.id=f.subscribed_id where {$opt} = ? order by f.date desc;";	
        return $this->executeThis($sql, $user_id);	
    }	
    protected function getFollowings($user_id, $opt)	
    {	
        $sql = "SELECT u.id as id, u.fullname, u.username, u.bio, u.verified, u.disabled from follow f left join user u on f.subscribed_id = u.id left join user u2 on u2.id=f.subscriber_id where {$opt} = ? order by f.date desc;";	
        return $this->executeThis($sql, $user_id);	
    }	
    protected function getUserCheck($username)	
    {	
        $sql = "SELECT id from user where username = ? ;";	
        return $this->executeThis($sql, $username);
    }
    protected function getUserInfID($user_id) 
    {   
        $sql = "SELECT fullname, username, registerDate, location, verified, banner_img, profil_img, disabled, token, bio, id, 
        (SELECT count(subscriber_id) from follow where subscriber_id = {$user_id}) as 'following',
        (SELECT count(subscribed_id) from follow where subscribed_id = {$user_id}) as 'followers' 
        from user u where u.id = ? ;";
        return $this->executeThis($sql, $user_id);
    }
    protected function getUserInfUsername($username) 
    {    
        $sql = "SELECT fullname, username, registerDate, location, verified, banner_img, profil_img, disabled, token, bio, id, 
        (SELECT count(subscriber_id) from follow left join user u2 on (u2.id=follow.subscriber_id) where u2.username = '{$username}') as 'following',
        (SELECT count(subscribed_id) from follow left join user u3 on (u3.id=follow.subscribed_id) where u3.username = '{$username}') as 'followers' 
        from user u where u.username = ? ;";
        return $this->executeThis($sql, $username);
    }

    // --- SET INFORMATION IN DB
    protected function setUser($pseudo, $email, $name,  $date_birthday, $location, $password) 
    {
        $sql = "INSERT INTO user (username, email, fullname, birthday, location, pwd, registerDate) VALUES (?, ?, ?, ?, ?, ?, UTC_TIMESTAMP)";
        $this->executeThis($sql,[$pseudo, $email, $name,  $date_birthday, $location, $password]);
    }
    protected function deleteFollowings($user_id, $id_sub)	
    {	
        $sql = "DELETE from follow where subscriber_id = ? and subscribed_id = ? ;";	
        return $this->executeThis($sql, [$user_id, $id_sub]);
    }	
    protected function setFollowings($user_id, $id_abo)	
    {	
        $sql = "INSERT into follow (date, subscriber_id, subscribed_id) values (UTC_TIMESTAMP, ?, ?);";	
        return $this->executeThis($sql, [$user_id, $id_abo]);
    }
    // --- UPDATE INFORMATION IN DB 
    protected function setNew($new, $id, $opt)
    {
        $sql = "UPDATE user SET {$opt} = ? WHERE id = ? ;";
        $this->executeThis($sql, [$new, $id]);
    }
}