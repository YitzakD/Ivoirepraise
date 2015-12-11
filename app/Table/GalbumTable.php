<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe GalbumTable
 *  @package Ipv
*/

class GalbumTable extends Table{
    protected $table = 'galbums';

    /**
     * findGalbums()
     * @return array
     * Permet de récupérer les albums photos
    */
    public function findGalbum(){
        return $this->query("SELECT galbums.* FROM galbums");
    }

}

?>