<?php
use Core\Config;
use Core\Database\MysqlDatabase;


/**
 * Classe App
 * @package Ipv
*/
class App{
    public $title = 'Ivoirepraise';
    private static $_instance;
    private $db_instance;


    /**
     * getInstance()
     * Permet d'instancier la classe App
    */
    public static function getInstance(){
        if(self::$_instance === null){
            self::$_instance = new App();
        }

        return self::$_instance;
    }

    /**
     * getdb()
     * Charge la configuration à la base de données
    */
    public function getDb(){
        $config = Config::getInstance(ROOT . '/config/config.php');
        if($this->db_instance === null){
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }

        return $this->db_instance;
    }


    /**
     * load()
     * Charge l'autoloader de l'app  et celui du core
    */
    public static function load(){
        session_start();
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }


    /**
     * getTable($name)
     * @param $name string => nom de la table
     * Initialise l'objet automatiquement
    */
    public function getTable($name){
        $class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';

        return new $class_name($this->getDb());
    }


    /**
     * notFound(), forbidden()
     * Renvoi sur une page d'erreur
    */
    public function forbidden(){
        header("HTTP/1.0 403 Forbidden");
        die ('Acces interdit');
    }

    public function notFound(){
        header("HTTP/1.0 404 Not Found");
        header("Location:index.php?p=404");
    }

}
?>
