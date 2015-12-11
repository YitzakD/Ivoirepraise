<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe ImageTable
 *  @package Ipv
*/

class ImageTable extends Table{
    protected $table = 'photos';

    /**
     * findImage()
     * @return array
     * Permet de récupérer les images
    */
    public function findImage(){
        return $this->query("SELECT photos.* FROM photos");
    }

}

?>
