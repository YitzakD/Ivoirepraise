<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class MusicsController
 * @package Ivp
*/
class MusicsController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Music');
    }


    /**
     * index()
     * Affiche le contenu de la table songs
     * @return array();
    */
    public function index(){
        $musics = $this->Music->findMusic();

        $this->render('admin.musics.index', compact('musics'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table musics
     * Affiche la page d'ajout des morceaux
     * @return array();
    */
    public function add(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            $song_hash = 'song+' . md5(uniqid());

            if(!empty($_FILES['fichier']['name'])){
                $morceau = $_FILES['fichier']['name'];
                $path = ROOT . '/public/medias/audios/';

                $ext = substr($morceau, strpos($morceau,'.'), strlen($morceau)-1);
                $allowed = array('.mp3','.wave','.MP3','.WAVE');
                $morceau = $_FILES["fichier"]["name"] = $dtime . 'morceau' . uniqid() . rand(1,999) . $ext;
                $filename = $morceau;

                if(!in_array($ext, $allowed)){
                    ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, l'extension de ce fichier n'est pas pris en compte !</div><?php
                }else{
                    if(!is_writable($path)){
                        ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, vous n'avez pas accès à ce dossier !</div><?php
                    }else{
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'],$path.$filename)){
                             $result = $this->Music->create([
                                'titre' => $_POST['titre'],
                                'format' => $ext,
                                'fichier' => $filename,
                                'apropos' => $_POST['apropos'],
                                'artiste_hash' => $_POST['artiste_hash'],
                                'album_hash' => $_POST['album_hash'],
                                'son_hash' => $song_hash,
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
                ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Vous devez choisir un fichier (.mp3, .wave) !</div><?php
            }
        }

        $form = new DafstyleForm($_POST);
        $this->loadModel('Artiste');
        $artistes = $this->Artiste->extractThis('artiste_hash', 'pseudo');
        $this->loadModel('Album');
        $albums = $this->Album->extractThis('album_hash', 'titre');

        $this->render('admin.musics.add', compact('form', 'artistes', 'albums', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des morceaux
     * @return array();
    */
    public function edit(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            if(!empty($_FILES['fichier']['name'])){
            $oldName = $_POST["hideName"];
            $path = ROOT . '/public/medias/audios/';

            $morceau = $_FILES['fichier']['name'];
            $ext = substr($morceau, strpos($morceau,'.'), strlen($morceau)-1);
            $allowed = array('.mp3','.wave','.MP3','.WAVE');
            $morceau = $_FILES["fichier"]["name"] = $dtime . 'morceau' . uniqid() . rand(1,999) . $ext;
            $filename = $morceau;

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
                            $result = $this->Music->update($_GET['id'], [
                                'titre' => $_POST['titre'],
                                'format' => $ext,
                                'fichier' => $filename,
                                'apropos' => $_POST['apropos'],
                                'artiste_hash' => $_POST['artiste_hash'],
                                'album_hash' => $_POST['album_hash'],
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
                $result = $this->Music->update($_GET['id'], [
                    'titre' => $_POST['titre'],
                    'apropos' => $_POST['apropos'],
                    'artiste_hash' => $_POST['artiste_hash'],
                    'album_hash' => $_POST['album_hash'],
                    'dtime' => $dtime,
                    'sdate' => $sdate
                ]);
                if($result){
                    $errors = true;
                }
            }
        }

        $music = $this->Music->find($_GET['id']);
        $this->loadModel('Artiste');
        $artiste = $this->Artiste->extractThis('artiste_hash', 'pseudo');
        $this->loadModel('Album');
        $album = $this->Album->extractThis('album_hash', 'titre');

        $form = new DafstyleForm($music);
        $this->render('admin.musics.edit', compact('form', 'music', 'album', 'artiste', 'errors'));
    }


    /**
    * del()
    * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
    * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Music->delete($_POST['id']);
            return $this->index();
        }
    }
}
?>
