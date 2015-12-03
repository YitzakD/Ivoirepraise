<?php
namespace Core;

/**
 * Class Config
 * @package DEVAFRICA
*/

class Config{
    private $settings = [];
    private static $_instance;


    /**
     * __construct()
     * Lis le fichier 'config.php' présent dans le dossier 'config/' qui e trouve à la racine
    */
    public function __construct($file){
        $this->settings = require($file);
    }


    /**
     * getInstance()
     * Permet d'instancier la class Config
    */
    public static function getInstance($file){
        if(self::$_instance === null){
            self::$_instance = new Config($file);
        }

        return self::$_instance;
    }


    /**
     * get($key)
     * @param $key string
     * Permet de récuperer les éléments de la configuration
    */
    public function get($key){
        if(!isset($this->settings[$key])){
            return null;
        }

        return $this->settings[$key];
    }


}
?>
