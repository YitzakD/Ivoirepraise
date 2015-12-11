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
        $actus = $this->Actuality->all();

        $this->render('admin.actus.index', compact('actus'));
    }


    /**
    * add()
    * Permet d'ajouter des champs a la table actualites
    * Affiche la page d'ajout des actualites
    * @return array();
    */
    public function add(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $actu_hash = 'actu+' . md5(uniqid());
        $dtime = time();
        $count = 0;

        if(!empty($_POST)){
        if(!empty($_FILES['fichier']['name'])){
        $path = ROOT . '/public/medias/images/actus/';
        $allowed = array('.jpeg','.jpg','.png','.gif','.JPEG','.JPG','.PNG','.GIF');
        foreach($_FILES['fichier']['name'] as $f => $photo){
            $ext = substr($photo, strpos($photo,'.'), strlen($photo)-1);
            $newphoto = $_FILES["fichier"]["name"][$f] = $dtime . 'aphoto' . uniqid() . '_' . rand(1,999999) . $ext;
            $filename = $newphoto;

        if(!in_array($ext, $allowed)){
        ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, l'extension de ce fichier n'est pas pris en compte !</div><?php
        }else{
            if(!is_writable($path)){
                ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, vous n'avez pas accès à ce dossier !</div><?php
            }else{
            if(move_uploaded_file($_FILES["fichier"]["tmp_name"][$f], $path.$filename))
                $count++;
                $this->loadModel('Image');
                $result_ = $this->Image->create([
                    'type' => 'ACTUALITE',
                    'type_id' => '1',
                    'type_hash' => $actu_hash,
                    'format' => $ext,
                    'fichier' => $filename,
                    'dtime' => $dtime,
                    'sdate' => $sdate
                ]);
            }

        }

        }
        $result = $this->Actuality->create([
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'actu_hash' => $actu_hash,
            'source' => $_POST['source'],
            'dtime' => $dtime,
            'sdate' => $sdate
        ]);

        if($result){
            $errors = true;
        }

        }else{
            ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Vous devez choisir un ou plusieurs fichier (.jpeg, .jpg, .gif, .png) !</div><?php
        }

        }

        $form = new DafstyleForm($_POST);
        $this->render('admin.actus.add', compact('form', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des actualités
     * @return array();
    */
    public function edit(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            $result = $this->Actuality->update($_GET['id'], [
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'source' => $_POST['source'],
                'dtime' => $dtime,
                'sdate' => $sdate
            ]);
            if($result){
                $errors = true;
            }
        }
        $actus = $this->Actuality->find($_GET['id']);
        $form = new DafstyleForm($actus);

        $this->render('admin.actus.edit', compact('form', 'actus', 'errors'));
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
