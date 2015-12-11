<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class InterviewsController
 * @package Ivp
*/

class InterviewsController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Interview');
    }

    /**
     * index()
     * Affiche le contenu de la table interviews
     * @return array();
    */
    public function index(){
        $intervs = $this->Interview->findInterview();

        $this->render('admin.interviews.index', compact('intervs'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table interviews
     * Affiche la page d'ajout des actualites
     * @return array();
    */
    public function add(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $interv_hash = 'interv+' . md5(uniqid());
        $dtime = time();

        if(!empty($_POST)){
            $result = $this->Interview->create([
                'titre' => $_POST['titre'],
                'intro' => $_POST['introduction'],
                'contenu' => $_POST['contenu'],
                'resume' => $_POST['resume'],
                'interv_hash' => $interv_hash,
                'info_hash' => $_POST['artiste_hash'],
                'dtime' => $dtime,
                'sdate' => $sdate
            ]);
            if($result){
                $errors = true;
            }
        }
        
        $form = new DafstyleForm($_POST);
        $this->loadModel('Artiste');
        $artistes = $this->Artiste->extractThis('artiste_hash', 'pseudo');
        $this->render('admin.interviews.add', compact('form', 'artistes', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des interviews
     * @return array();
    */
    public function edit(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            $result = $this->Interview->update($_GET['id'], [
                'intro' => $_POST['intro'],
                'contenu' => $_POST['contenu'],
                'resume' => $_POST['resume'],
                'dtime' => $dtime,
                'sdate' => $sdate
            ]);
            if($result){
                $errors = true;
            }
        }
        
        $interview = $this->Interview->find($_GET['id']);
        $form = new DafstyleForm($interview);
        $this->render('admin.interviews.edit', compact('form', 'interview', 'errors'));
    }


    /**
     * del()
     * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
     * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Interview->delete($_POST['id']);
            return $this->index();
        }
    }

}
?>
