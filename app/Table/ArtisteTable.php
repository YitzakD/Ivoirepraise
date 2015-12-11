<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe ArtisteTable
 *  @package Ipv
*/

class ArtisteTable extends Table{
    protected $table = 'artistes';

    /**
     * findArtiste()
     * @return array
     * Permet de récupérer les dernieres actualités
    */
    public function findArtiste(){
        return $this->query("
        SELECT artistes.*, genres.titre as genre
        FROM artistes
        LEFT JOIN genres
            ON artistes.genre_id = genres.id
        ");
    }
    
}

?>
