<?php
namespace Core\Database;
use \PDO;

/**
 * Class MysqlDatabase
 * @package DEVAFRICA
*/

class MysqlDatabase extends Database{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    /**
     * __construct()
     * @param $db_name string => Nom de la BDD
     * @param $db_user string => Nom d'utilisateur d'accès au serveur et à la e la BDD
     * @param $db_pass string => Mot de passe d'accès au serveur et à la e la BDD
     * @param $db_host string => 'Localhost' par défaut
     * Initialise les diférents paramêtres d'accès au serveur
    */
    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost'){
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }


    /**
     * getPDO()
     * Permet la gestion de PDO, et la stock dans le proprétés
    */
    private function getPDO(){
        if($this->pdo === null){
            $pdo = new PDO('mysql:dbname=ivoirepraise;host=localhost', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }

        return $this->pdo;
    }


    /**
     * query()
     * @param $statement  string => Requête Sql à effectuée
     * @param $class_name  string => Le nom de la classe
     * @param $one  bool
     * Permet la récupération des résultats
    */
    public function query($statement, $class_name = null, $one = false){
        $req =  $this->getPDO()->query($statement);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ){
            return $req;
        }

        if($class_name ===  null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }

        return $datas;
    }


    /**
     * prepare()
     * @param $statement  string => Requête Sql à effectuée
     * @param $attributes  string => les options, ou attributs
     * @param $class_name  string => Le nom de la classe
     * @param $one bool
     * Permet la récupération des résultats en préparant la requête afin d'éviter les injections Sql
    */
    public function prepare($statement, $attributes, $class_name = null, $one = false){
        $req =  $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ){
            return $res;
        }

        if($class_name ===  null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }

        return $datas;
    }


    /**
     * lastInsertId()
     * @return int
     * Récupère l'id du dernier enregistrement
    */
    public function lastInsertId(){
        return $this->getPDO()->lastInsertId();
    }

}
?>
