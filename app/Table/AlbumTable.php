<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe AlbumTable
 *  @package Ipv
*/

class AlbumTable extends Table{
    protected $table = 'albums';

    /**
     * findAlbums()
     * @return array
     * Permet de récupérer les albums
    */
    public function findAlbums(){
        return $this->query("
        SELECT albums.*, artistes.pseudo, genres.titre as genre
        FROM albums
        INNER JOIN artistes ON artistes.artiste_hash = albums.artiste_hash
        LEFT JOIN genres ON genres.id = artistes.genre_id
        ");
    }

}

?>
