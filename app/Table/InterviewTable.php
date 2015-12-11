<?php
namespace App\Table;
use Core\Table\Table;
/**
 * Classe InterviewTable
 *  @package Ipv
*/

class InterviewTable extends Table{
    protected $table = 'interviews';


    /**
     * findInterview()
     * @return array
     * Permet de récupérer les interviews
    */
    public function findInterview(){
        return $this->query("
        SELECT interviews.*, artistes.pseudo as artiste
        FROM interviews
        LEFT JOIN artistes
            ON interviews.info_hash = artistes.artiste_hash
        ");
    }

}

?>
