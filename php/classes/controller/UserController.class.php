<?php
//CONTROLLER, INTERACT TO CREATE/UPDATE SOMETHING WITH USER IN THE DB.
class UserController extends User
{
    // --- GET INFORMATION IN DB
    public function verifPseudoUnique($pseudo)
    {
        $results = $this->setVerifPseudoUnique($pseudo);
        if ($results == null || empty($results))
        {
            return true;
        }
        else
        {
            return $results[0];
        }
    }
    public function verifEmailUnique($email)
    {
        $results = $this->setVerifEmailUnique($email);
        if ($results == null || empty($results))
        {
            return true;
        }
        else
        {
            return $results[0];
        }
    }
    public function getIdWithPseudo($pseudo)
    {
        $results = $this->findIdWithPseudo($pseudo);
        return $results;
    }
    public function getPseudoWithId($pseudo)
    {
        $results = $this->findPseudoWithId($pseudo);
        return $results;
    }
    public function followers($user_id) {
        if ( is_numeric($user_id) ) {
            return $this->getFollowers($user_id, 'u2.id');
        } else {
            return $this->getFollowers($user_id, 'u2.username');
        }
    }
    public function followings($user_id) {
        if ( is_numeric($user_id) ) {
            return $this->getFollowings($user_id, 'u2.id');
        } else {
            return $this->getFollowings($user_id, 'u2.username');
        }
    }
    public function delFollowings($user_id, $id_sub) {
        return $this->deleteFollowings($user_id, $id_sub);
    }
    public function createFollowings($user_id, $id_abo) {
        return $this->setFollowings($user_id, $id_abo);
    }
    public function userCheck($username) {
        return $this->getUserCheck($username);
    }
    // --- SET INFORMATION IN DB
    public function createUser($pseudo, $email, $name,  $date_birthday, $location, $password)
    {
        $this->setUser($pseudo, $email, $name,  $date_birthday, $location, $password);
    }
    // --- UPDATE INFORMATION IN DB 
    public function newPassword($newPassword, $idMember)
    {
        $this->setNew($newPassword, $idMember, 'pwd');
    }
    public function newEmail($newEmail, $idMember)
    {
        $this->setNew($newEmail, $idMember, 'email');
    }
    public function newPseudo($newPseudo, $idMember)
    {
        $this->setNew($newPseudo, $idMember, 'username');
    }
    public function userInf($user_id) 
    {
        if ( is_numeric($user_id) ) {
            return $this->getUserInfID($user_id); //get user inf + following + followers
        } else {
            return $this->getUserInfUsername($user_id); //get user inf + following + followers
        }
    }
}