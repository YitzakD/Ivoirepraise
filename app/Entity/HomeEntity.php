<?php
namespace App\Entity;
use Core\Entity\Entity;
/**
 * Classe HomeEntity
 *  @package Ipv
*/

class HomeEntity extends Entity{

    /**
     * getLiens()
     * Génere un extrait d'un contenu donnée
    */
    public function getLiens(){
        $html = '<div class="daf-gr-ctnr">';
        $html .= '<a href="index.php?p=home" class="btn-link">Accueil</a> |';
        $html .= '<a href="index.php?p=actus.actualites" class="btn-link">Actualités</a> |';
        $html .= '<a href="index.php?p=users.login" class="btn-link">Login</a></div>';
        return $html;
    }
}

?>
