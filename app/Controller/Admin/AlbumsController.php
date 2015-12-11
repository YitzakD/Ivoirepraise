<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class AlbumsController
 * @package Ivp
*/
class AlbumsController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Album');
    }

    /**
     * index()
     * Affiche le contenu de la table albums
     * @return array();
    */
    public function index(){
        $albums = $this->Album->findAlbums();

        $this->render('admin.albums.index', compact('albums'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table albums
     * Affiche la page d'ajout des albums
     * @return array();
    */
    public function add(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            $album_hash = 'album+' . md5(uniqid());

            if(!empty($_FILES['fichier']['name'])){
            $cover = $_FILES['fichier']['name'];
            $path = ROOT . '/public/medias/images/albums/';
            $ext = substr($cover, strpos($cover,'.'), strlen($cover)-1);
            $allowed = array('.jpeg','.png','.jpg','.gif','.JPEG','.JPG','.PNG','.GIF');
            $cover = $_FILES["fichier"]["name"] = $dtime . 'cover' . uniqid() . rand(1,99999) . $ext;
            $filename = $cover;
                if(!in_array($ext, $allowed)){
                    ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, l'extension de ce fichier n'est pas pris en compte !</div><?php
                }else{
                    if(!is_writable($path)){
                        ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, vous n'avez pas accès à ce dossier !</div><?php
                    }else{
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'],$path.$filename)){
                            $result = $this->Album->create([
                                'titre' => $_POST['titre'],
                                'parution' => $_POST['parution'],
                                'apropos' => $_POST['apropos'],
                                'cover' => $filename,
                                'artiste_hash' => $_POST['artiste_hash'],
                                'album_hash' => $album_hash,
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
                $result = $this->Album->create([
                    'titre' => $_POST['titre'],
                    'parution' => $_POST['parution'],
                    'apropos' => $_POST['apropos'],
                    'artiste_hash' => $_POST['artiste_hash'],
                    'album_hash' => $album_hash,
                    'dtime' => $dtime,
                    'sdate' => $sdate
                ]);
                if($result){
                    $errors = true;
                }
            }
        }
        $form = new DafstyleForm($_POST);
        $this->loadModel('Artiste');
        $artistes = $this->Artiste->extractThis('artiste_hash', 'pseudo');
        $this->render('admin.albums.add', compact('form', 'artistes', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des artistes
     * @return array();
    */
    public function edit(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            if(!empty($_FILES['fichier']['name'])){
                $oldName = $_POST["hideName"];
                $path = ROOT . '/public/medias/images/albums/';

                $cover = $_FILES['fichier']['name'];
                $ext = substr($cover, strpos($cover,'.'), strlen($cover)-1);
                $allowed = array('.jpeg','.png','.jpg','.gif','.JPEG','.JPG','.PNG','.GIF');
                $cover = $_FILES["fichier"]["name"] = $dtime . 'cover' . uniqid() . rand(1,99999) . $ext;
                $filename = $cover;

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
                            $result = $this->Album->update($_GET['id'], [
                                'titre' => $_POST['titre'],
                                'parution' => $_POST['parution'],
                                'apropos' => $_POST['apropos'],
                                'cover' => $filename,
                                'artiste_hash' => $_POST['artiste_hash'],
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
                $result = $this->Album->update($_GET['id'], [
                   'titre' => $_POST['titre'],
                   'parution' => $_POST['parution'],
                   'apropos' => $_POST['apropos'],
                   'artiste_hash' => $_POST['artiste_hash'],
                   'dtime' => $dtime,
                   'sdate' => $sdate
               ]);
               if($result){
                   $errors = true;
               }
            }
        }

        $album = $this->Album->find($_GET['id']);
        $this->loadModel('Artiste');
        $artiste = $this->Artiste->extractThis('artiste_hash', 'pseudo');

        $form = new DafstyleForm($album);
        $this->render('admin.albums.edit', compact('form', 'album', 'artiste', 'errors'));
    }


    /**
    * del()
    * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
    * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Album->delete($_POST['id']);
            return $this->index();
        }
    }

}
?>
