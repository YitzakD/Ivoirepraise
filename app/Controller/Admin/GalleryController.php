<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class GalleryController
 * @package Ivp
*/

class GalleryController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Gallery');
    }

/**
 * index()
 * Affiche le contenu de la table gallery
 * @return array();
*/
public function index(){
    $photos = $this->Gallery->findGallery();

    $this->loadModel('Galbum');
    $photos_album = $this->Galbum->findGalbum();

    $this->render('admin.gallery.index', compact('photos', 'photos_album'));
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
        $dtime = time();
        $count = 0;

    if(!empty($_POST)){
        if(!empty($_FILES['fichier']['name'])){
            $path = ROOT . '/public/medias/images/gallery/';
            $allowed = array('.jpeg','.jpg','.png','.gif','.JPEG','.JPG','.PNG','.GIF');
        foreach($_FILES['fichier']['name'] as $f => $photo){
                $ext = substr($photo, strpos($photo,'.'), strlen($photo)-1);
                $newphotowphoto = $_FILES["fichier"]["name"][$f] = $dtime . 'photo' . uniqid() . '_' . rand(1,999999) . $ext;
                $filename = $newphoto;

                if(!in_array($ext, $allowed)){
                    ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, l'extension de ce fichier n'est pas pris en compte !</div><?php
                }else{
                    if(!is_writable($path)){
                        ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, vous n'avez pas accès à ce dossier !</div><?php
                    }else{
                        if(move_uploaded_file($_FILES["fichier"]["tmp_name"][$f], $path.$filename))
                        $count++;
                        $result = $this->Gallery->create([
                           'format' => $ext,
                           'fichier' => $newphoto,
                           'galbum_hash' => $_POST['galbum_hash'],
                           'dtime' => $dtime,
                           'sdate' => $sdate
                       ]);
                       if($result){
                           $errors = true;
                       }
                    }
                }
            }

        }else{
            ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Vous devez choisir un ou plusieurs fichier (.jpeg, .jpg, .png, .gif) !</div><?php
        }
    }

        $form = new DafstyleForm($_POST);
        $this->loadModel('Galbum');
        $galbums = $this->Galbum->extractThis('galbum_hash', 'titre');

        $this->render('admin.gallery.add', compact('form', 'galbums', 'errors'));
    }





    /**
    * edit()
    * Controller qui appelle la page d'édition
    * Affiche la page d'édition des image
    * @return array();
    */
    public function edit(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

    if(!empty($_POST)){
        if(!empty($_FILES['fichier']['name'])){
            $oldName = $_POST["hideName"];
            $path = ROOT . '/public/medias/images/gallery/';

            $photo = $_FILES['fichier']['name'];
            $ext = substr($photo, strpos($photo,'.'), strlen($photo)-1);
            $allowed = array('.jpeg','.jpg','.png','.gif','.JPEG','.JPG','.PNG','.GIF');
            $photo = $_FILES["fichier"]["name"] = $dtime . 'photo' . uniqid() . '_' . rand(1,999999) . $ext;
            $filename = $photo;

            if(!in_array($ext, $allowed)){
                ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, l'extension de ce fichier n'est pas pris en compte !</div><?php
            }else{
                if(!is_writable($path)){
                    ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, vous n'avez pas accès à ce dossier !</div><?php
            }else{
                if(move_uploaded_file($_FILES['fichier']['tmp_name'],$path.$filename)){
                    if($oldName != ""){
                        unlink($path . $oldName);
                    }
                    $result = $this->Gallery->update($_GET['id'], [
                        'format' => $ext,
                        'fichier' => $filename,
                        'galbum_hash' => $_POST['galbum_hash'],
                        'dtime' => $dtime,
                        'sdate' => $sdate
                    ]);

                    if($result){
                        $errors = true;
                    }
                }else{
                    ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, Impossible d'uploader ce fichier !</div><?php
                }
            }

        }

        }else{
            $result = $this->Gallery->update($_GET['id'], [
                'galbum_hash' => $_POST['galbum_hash'],
                'dtime' => $dtime,
                'sdate' => $sdate
            ]);

            if($result){
                $errors = true;
            }
        }
    }

        $photo = $this->Gallery->find($_GET['id']);
        $this->loadModel('Galbum');
        $galbum = $this->Galbum->extractThis('galbum_hash', 'titre');

        $form = new DafstyleForm($photo);
        $this->render('admin.gallery.edit', compact('form', 'photo', 'galbum', 'errors'));
    }




/**
 * del()
 * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
 * Page de suppression
*/
public function del(){
    if(!empty($_POST)){
        $result = $this->Gallery->delete($_POST['id']);
        return $this->index();
    }
}

}
?>
