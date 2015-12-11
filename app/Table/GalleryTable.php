<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe galleryTable
 *  @package Ipv
*/

class galleryTable extends Table{
    protected $table = 'gallery';

    /**
     * findGallery()
     * @return array
     * Permet de récupérer les photos
    */
    public function findGallery(){
        return $this->query("
        SELECT gallery.*, galbums.titre as album
        FROM gallery 
        LEFT JOIN galbums
            ON galbums.galbum_hash = gallery.galbum_hash
        WHERE gallery.galbum_hash = galbums.galbum_hash
        ");
    }

}

?>
