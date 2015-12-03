<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe ActualityTable
 *  @package Ipv
*/

class ActualityTable extends Table{
    protected $table = 'actualites';


    /**
     * last()
     * @return array
     * Permet de récupérer les dernieres actualités
    */
    public function last(){
        return $this->query("
        SELECT actualites.id, actualites.titre, actualites.contenu
        FROM actualites
        ORDER BY actualites.sdate DESC");
    }

    /*public function last(){
        return $this->query("
        SELECT actualites.id, actualites.titre, actualites.contenu, categories.titre as categorie
        FROM actualites
        LEFT JOIN categories
            ON category_id = categories.id
        ORDER BY actualites.d_m DESC");
    }*/


    /**
     * findWith($id)
     * @param $id int
     * @return \App\Entity\ActualityEntity
     * Permet de récupérer une seule actualité en liant la catégorie associée
    */
    public function findWith($id){
        return $this->query("
        SELECT actualites.id, actualites.titre, actualites.contenu, categories.titre as categorie
        FROM actualites
        LEFT JOIN categories ON actualites.category_id = categories.id
        WHERE actualites.id = ?", [$id], true);
    }


    /**
     * listBy($categ_id)
     * @param $categ_id int
     * @return array
     * Permet de récupérer les actualités en fonction de la catégorie demandée
    */
    public function listBy($categ_id){
        return $this->query("
        SELECT actualites.id, actualites.titre, actualites.contenu, categories.titre as categorie
        FROM actualites
        LEFT JOIN categories ON category_id = categories.id
        WHERE actualites.category_id = ?
        ORDER BY actualites.d_m DESC", [$categ_id]);
    }
}

?>
