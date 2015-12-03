<?php
namespace App;

/**
 * Class Autoloader
 * @package Ivp
*/

class Autoloader{

    /**
    * register()
    * Permet l'enregistrement de l'Autoloader
    */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
    * autoload()
    * @param $class string => Le nom de la classe
    * Permet d'inclure le fichier correspondant à notre classe
    */
    static function autoload($class){
        if(strpos($class, __NAMESPACE__ . '\\') === 0){
             $class = str_replace(__NAMESPACE__ . '\\', '', $class);
             $class = str_replace('\\', '/', $class);

             require __DIR__ . '/' . $class . '.php';
        }
    }

}
?>
