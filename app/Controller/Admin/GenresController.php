<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class GenresController
 * @package Ivp
*/

class GenresController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Genre');
    }

    /**
     * index()
     * Affiche le contenu de la table actualites
     * @return array();
    */
    public function index(){
        $items_list_genres = $this->Genre->all();

        $this->render('admin.genres.index', compact('items_list_genres'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table actualites
     * Affiche la page d'ajout des actualites
     * @return array();
    */
    public function add(){
        $errors = false;

        if(!empty($_POST)){
            $result = $this->Genre->create([
                'titre' => $_POST['titre'],
            ]);
            if($result){
                $errors = true;
            }
        }
        $form = new DafstyleForm($_POST);

        $this->render('admin.genres.add', compact('form', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des actualités
     * @return array();
    */
    public function edit(){
        $errors = false;

        if(!empty($_POST)){
            $result = $this->Genre->update($_GET['id'], [
                'titre' => $_POST['titre'],
            ]);
            if($result){
                $errors = true;
            }
        }
        $items_edit_genre = $this->Genre->find($_GET['id']);
        $form = new DafstyleForm($items_edit_genre);

        $this->render('admin.genres.edit', compact('form', 'items_edit_genre', 'errors'));
    }


    /**
     * del()
     * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
     * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Genre->delete($_POST['id']);
            return $this->index();
        }
    }

}
?>
