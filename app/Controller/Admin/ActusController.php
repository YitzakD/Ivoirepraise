<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class ActusController
 * @package Ivp
*/

class ActusController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Actuality');
    }

    /**
     * index()
     * Affiche le contenu de la table actualites
     * @return array();
    */
    public function index(){
        $items_list_atus = $this->Actuality->all();

        $this->render('admin.actus.index', compact('items_list_atus'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table actualites
     * Affiche la page d'ajout des actualites
     * @return array();
    */
    public function add(){
        $errors = false;
        $saveDate = date('Y-m-d H:i:s');
        if(!empty($_POST)){
            $result = $this->Actuality->create([
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'category_id' => $_POST['category_id'],
                'd_m' => $saveDate
            ]);
            if($result){
                $errors = true;
                // return $this->index();
            }
        }
        $this->loadModel('Category');
        $items_add_cat_actus = $this->Category->extractThis('id', 'titre');
        $form = new DafstyleForm($_POST);

        $this->render('admin.actus.add', compact('form', 'items_add_cat_actus', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des actualités
     * @return array();
    */
    public function edit(){
        $errors = false;
        $saveDate = date('Y-m-d H:i:s');
        if(!empty($_POST)){
            $result = $this->Actuality->update($_GET['id'], [
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'category_id' => $_POST['category_id'],
                'd_m' => $saveDate
            ]);
            if($result){
                $errors = true;
            }
        }
        $items_edit_actus = $this->Actuality->find($_GET['id']);
        $this->loadModel('Category');
        $items_edit_cat_actus = $this->Category->extractThis('id', 'titre');
        $form = new DafstyleForm($items_edit_actus);

        $this->render('admin.actus.edit', compact('form', 'items_edit_actus', 'items_edit_cat_actus', 'errors'));
    }


    /**
     * del()
     * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
     * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Actuality->delete($_POST['id']);
            return $this->index();
        }
    }

}
?>
