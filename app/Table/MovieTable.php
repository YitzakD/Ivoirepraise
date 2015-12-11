<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe MovieTable
 *  @package Ipv
*/

class MovieTable extends Table{
    protected $table = 'movies';

    /**
     * findVideo()
     * @return array
     * Permet de récupérer les videos
    */
    public function findMovie(){
        return $this->query("SELECT * FROM movies ORDER BY artiste ASC");
    }

}

?>
