<?php
namespace Core\Entity;

/**
 * Classe Entity
 * @package DEVAFRICA
*/

class Entity{


    /**
     * __get($key)
     * @param $key string
     * Récupère la fonction qui correspond au parrametre
    */
    public function __get($key){
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();

        return $this->$key;
    }
}
?>
