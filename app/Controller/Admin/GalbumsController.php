<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class GalbumsController
 * @package Ivp
*/

class GalbumsController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Galbum');
    }

    /**
     * index()
     * Affiche le contenu de la table galbums
     * @return array();
    */
    public function index(){
        $galbums = $this->Galbum->findGalbum();

        $this->render('admin.galbums.index', compact('galbums'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table galbums
     * Affiche la page d'ajout des albums-photos
     * @return array();
    */
    public function add(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $gal_hash = 'gal+' . md5(uniqid());
        $dtime = time();

        if(!empty($_POST)){
            $result = $this->Galbum->create([
                'titre' => $_POST['titre'],
                'apropos' => $_POST['apropos'],
                'galbum_hash' => $gal_hash,
                'dtime' => $dtime,
                'sdate' => $sdate
            ]);
            if($result){
                $errors = true;
            }
        }
        
        $form = new DafstyleForm($_POST);
        $this->render('admin.galbums.add', compact('form', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des albums-photos
     * @return array();
    */
    public function edit(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            $result = $this->Galbum->update($_GET['id'], [
               'titre' => $_POST['titre'],
                'apropos' => $_POST['apropos'],
                'dtime' => $dtime,
                'sdate' => $sdate
            ]);
            if($result){
                $errors = true;
            }
        }
        
        $galbum = $this->Galbum->find($_GET['id']);
        $form = new DafstyleForm($galbum);
        $this->render('admin.galbums.edit', compact('form', 'galbum', 'errors'));
    }


    /**
     * del()
     * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
     * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Galbum->delete($_POST['id']);
            return $this->index();
        }
    }

}
?>
