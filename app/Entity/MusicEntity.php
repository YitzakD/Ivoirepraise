<?php
namespace App\Entity;
use Core\Entity\Entity;
/**
 * Classe MusicEntity
 *  @package Ipv
*/

class MusicEntity extends Entity{


    /**
     * getExtrait()
     * Génere un extrait d'un contenu donnée
    */
    public function getExtrait(){
        $html = '<p>' . substr($this->apropos, 0, 250) . ' ... ';
        $html .= '<span> <a href="'. $this->getUrl() .'" class="btn-link">Lire la suite</a> </span></p>';
        return nl2br($html);
    }
}
?>
