<?php
namespace Core\Table;
use Core\Database\Database;


/**
 * Classe Table
 *  @package DEVAFRICA
*/

class Table{
    protected $table;
    protected $db;


    /**
     * __construct()
     * Dévine le nom de la table en fonction du nom de la classe
    */
    public function __construct(Database $db){
        $this->db = $db;
        if($this->table === null){
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
        }
    }


    /**
     * query()
     * @param $statement
     * @param $attr = null
     * @param $one = false
     * Fais une requête au niveau de la base de données et récupère le tous
    */
    public function query($statement, $attr = null, $one = false){
        if($attr){
            return $this->db->prepare(
                $statement,
                $attr,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );
        }else{
            return $this->db->query(
                $statement,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );
        }
    }


    /**
     * create()
     * @param $fields string
     * Crée une nouvelle ligne (enregistrement) dans la table qui est définie
    */
    public function create($fields){
        $sql_part = [];
        $attr = [];
        foreach ($fields as $k => $v ) {
             $sql_parts[] = "$k = ?";
             $attr[] = $v;
        }
        $sql_part = implode(', ', $sql_parts);

        return $this->query("INSERT INTO {$this->table} SET $sql_part ", $attr, true);
    }


    /**
     * update()
     * @param $id int
     * @param $fields string
     * Met à jour la ligne (ancien enregistrement) correspondant à l'id qui est passé en paramêtre
    */
    public function update($id, $fields){
        $sql_part = [];
        $attr = [];
        foreach ($fields as $k => $v ) {
            $sql_parts[] = "$k = ?";
            $attr[] = $v;
        }
        $attr[] = $id;
        $sql_part = implode(', ', $sql_parts);

        return $this->query("UPDATE {$this->table} SET $sql_part WHERE id = ? ", $attr, true);
    }


    /**
     * all()
     * Fais une requête au niveau de la base de données et récupère le tous
    */
    public function all(){
        return $this->query('SELECT * FROM ' . $this->table);
    }


    /**
     * find()
     * @param $id int
     * Fais une requête au niveau de la base de données et récupère le tous
    */
    public function find($id){
         return $this->query("SELECT * FROM {$this->table} WHERE id = ? ", [$id], true);
    }


    /**
     * extractThis()
     * @param $key int
     * @param $value string
     * permet de récuperer sous forme d'une liste tous les enregistrements d'un tableau
    */
    public function extractThis($key, $value){
        $records = $this->all();
        $return = [];
        foreach ($records as $v) {
            $return[$v->$key] = $v->$value;
        }

        return $return;
    }

    /**
     * delete()
     * @param $id int
     * Supprime l'enregistrement d'une table en fonction de l'id $id passer en paramêtre
    */
    public function delete($id){
        return $this->query("DELETE FROM {$this->table} WHERE id = ? ", [$id], true);
    }

}
?>
