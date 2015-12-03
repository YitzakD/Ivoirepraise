<?php
namespace Core\Auth;
use Core\Database\Database;

/**
 * class DBAuth
 * @package DEVAFRICA
*/

class DBAuth{
    private $db;


    /**
     * __construct()
     * @param $db
     * Permet de se connecter à la BDD
    */
    public function __construct(Database $db){
        $this->db =  $db;
    }


    /**
     * login()
     * @param $username string
     * @param $password string
     * @return boolean
     * Permet à un utilsateur possedan des identifiants de se connecter
    */
    public function login($username, $password){
        $user = $this->db->prepare('SELECT * FROM users WHERE username = ?', [$username], null, true);
        if($user){
             if($user->password === sha1($password)){
                 $_SESSION['auth'] = $user->id;

                 return true;
             }
        }

        return false;
    }


    /**
     * logged()
     * @return boolean
     * Verifie si la session est vide ou pas
    */
    public function logged(){
        return isset($_SESSION['auth']);
    }


    /**
     * getUserId()
     * @return int
     * Permet de deviner l'id de l'utilisateur
    */
    public function getUserId(){
       if($this->logged()){
           return $_SESSION['auth'];
       }

       return false;
   }

}

?>
