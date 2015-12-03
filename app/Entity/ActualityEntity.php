<?php
namespace App\Entity;
use Core\Entity\Entity;
/**
 * Classe ActualityEntity
 *  @package Ipv
*/

class ActualityEntity extends Entity{

    /**
     * getUrl()
     * Crée et génere les urls à la volet
    */
    public function getUrl(){
        return 'index.php?p=actus.actualite&id=' . $this->id;
    }


    /**
     * getExtrait()
     * Génere un extrait d'un contenu donnée
    */
    public function getExtrait(){
        $html = '<p>' . substr($this->contenu, 0, 250) . ' ... ';
        $html .= '<span> <a href="'. $this->getUrl() .'" class="btn-link">Lire la suite</a> </span></p>';
        return nl2br($html);
    }
}

?>
