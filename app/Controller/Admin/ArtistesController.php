<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class ArtistesController
 * @package Ivp
*/
class ArtistesController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Artiste');
    }


    /**
     * index()
     * Affiche le contenu de la table artistes
     * @return array();
    */
    public function index(){
        $artistes = $this->Artiste->findArtiste();

        $this->render('admin.artistes.index', compact('artistes'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table musics
     * Affiche la page d'ajout des artistes
     * @return array();
    */
    public function add(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            $artiste_hash = 'artiste+' . md5(uniqid());
            if(!empty($_FILES['fichier']['name'])){
                $art_photo = $_FILES['fichier']['name'];
                $path = ROOT . '/public/medias/images/interviews/';
                $ext = substr($art_photo, strpos($art_photo,'.'), strlen($art_photo)-1);
                $allowed = array('.jpeg','.jpg','.png','.GIF','.JPEG','.JPG','.PNG','.GIF');
                $art_photo = $_FILES["fichier"]["name"] = $dtime . 'iphoto' . uniqid() . rand(1,99999) . $ext;
                $filename = $art_photo;
                if(!in_array($ext, $allowed)){
                    ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, l'extension de ce fichier n'est pas pris en compte !</div><?php
                }else{
                    if(!is_writable($path)){
                        ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, vous n'avez pas accès à ce dossier !</div><?php
                    }else{
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'],$path.$filename)){
                            $naissdate = $_POST['annee'] . '-' . $_POST['mois'] . '-' . $_POST['jour'];
                            $result = $this->Artiste->create([
                                'pseudo' => $_POST['pseudo'],
                                'noms' => $_POST['noms'],
                                'annee' => $naissdate,
                                'photo' => $filename,
                                'bio' => $_POST['biographie'],
                                'genre_id' => $_POST['genre'],
                                'artiste_hash' => $artiste_hash,
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
                ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Vous devez choisir un fichier (.mp4) !</div><?php
            }
        }

        $form = new DafstyleForm($_POST);

        $this->loadModel('Genre');
        $genres = $this->Genre->extractThis('id', 'titre');

        $this->render('admin.artistes.add', compact('form', 'genres', 'errors'));
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
                $path = ROOT . '/public/medias/images/interviews/';

                $art_photo = $_FILES['fichier']['name'];
                $ext = substr($art_photo, strpos($art_photo,'.'), strlen($art_photo)-1);
                $allowed = array('.jpeg','.jpg','.png','.GIF','.JPEG','.JPG','.PNG','.GIF');
                $art_photo = $_FILES["fichier"]["name"] = $dtime . 'iphoto' . uniqid() . rand(1,99999) . $ext;
                $filename = $art_photo;

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
                             $result = $this->Artiste->update($_GET['id'], [
                                 'pseudo' => $_POST['pseudo'],
                                 'noms' => $_POST['noms'],
                                 'annee' => $_POST['annee'],
                                 'photo' => $filename,
                                 'bio' => $_POST['bio'],
                                 'genre_id' => $_POST['genre_id'],
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
                $result = $this->Artiste->update($_GET['id'], [
                    'pseudo' => $_POST['pseudo'],
                    'noms' => $_POST['noms'],
                    'annee' => $_POST['annee'],
                    'bio' => $_POST['bio'],
                    'genre_id' => $_POST['genre_id'],
                    'dtime' => $dtime,
                    'sdate' => $sdate
               ]);
                if($result){
                    $errors = true;
                }
            }
        }

        $artiste = $this->Artiste->find($_GET['id']);
        $this->loadModel('Genre');
        $genre = $this->Genre->extractThis('id', 'titre');

        $form = new DafstyleForm($artiste);
        $this->render('admin.artistes.edit', compact('form', 'artiste', 'genre', 'errors'));
    }


    /**
    * del()
    * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
    * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Artiste->delete($_POST['id']);
            return $this->index();
        }
    }
}
?>
