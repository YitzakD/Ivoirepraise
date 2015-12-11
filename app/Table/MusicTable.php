<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe MusicTable
 *  @package Ipv
*/

class MusicTable extends Table{
    protected $table = 'musics';

    /**
     * findMusic()
     * @return array
     * Permet de récupérer les chansons
    */
    public function findMusic(){
        return $this->query("
        SELECT musics.*, albums.titre as album, albums.cover, artistes.pseudo as artiste, genres.titre as genre
        FROM musics
        LEFT JOIN albums
            ON musics.album_hash = albums.album_hash
        LEFT JOIN artistes
            ON musics.artiste_hash = artistes.artiste_hash
        LEFT JOIN genres
            ON artistes.genre_id = genres.id
        ");
    }

}

?>
