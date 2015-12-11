<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class MoviesController
 * @package Ivp
*/
class MoviesController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Movie');
    }


    /**
     * index()
     * Affiche le contenu de la table songs
     * @return array();
    */
    public function index(){
        $movies = $this->Movie->findMovie();

        $this->render('admin.movies.index', compact('movies'));
    }


    /**
     * add()
     * Permet d'ajouter des champs a la table musics
     * Affiche la page d'ajout des videos
     * @return array();
    */
    public function add(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            $video_hash = 'video+' . md5(uniqid());

            if(!empty($_FILES['fichier']['name'])){
                $path = ROOT . '/public/medias/movies/';

                $video = $_FILES['fichier']['name'];
                $ext = substr($video, strpos($video,'.'), strlen($video)-1);
                $allowed = array('.mp4','.MP4');
                $video = $_FILES["fichier"]["name"] = $dtime . 'video' . uniqid() . rand(1,999) . $ext;
                $filename = $video;

                if(!in_array($ext, $allowed)){
                    ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, l'extension de ce fichier n'est pas pris en compte !</div><?php
                }else{
                    if(!is_writable($path)){
                        ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Oops, vous n'avez pas accès à ce dossier !</div><?php
                    }else{
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'],$path.$filename)){
                             $result = $this->Movie->create([
                                'artiste' => $_POST['artiste'],
                                'titre' => $_POST['titre'],
                                'apropos' => $_POST['apropos'],
                                'format' => $ext,
                                'fichier' => $filename,
                                'video_hash' => $video_hash,
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
        $this->render('admin.movies.add', compact('form', 'errors'));
    }


    /**
     * edit()
     * Controller qui appelle la page d'édition
     * Affiche la page d'édition des videos
     * @return array();
    */
    public function edit(){
        $errors = false;
        $sdate = date('Y-m-d H:i:s');
        $dtime = time();

        if(!empty($_POST)){
            if(!empty($_FILES['fichier']['name'])){
                $oldName = $_POST["hideName"];
                $path = ROOT . '/public/medias/movies/';

                $video = $_FILES['fichier']['name'];
                $ext = substr($video, strpos($video,'.'), strlen($video)-1);
                $allowed = array('.mp4','.MP4');
                $video = $_FILES["fichier"]["name"] = $dtime . 'video' . uniqid() . rand(1,999) . $ext;
                $filename = $video;

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
                            $result = $this->Movie->update($_GET['id'], [
                                'titre' => $_POST['titre'],
                                'artiste' => $_POST['artiste'],
                                'apropos' => $_POST['apropos'],
                                'format' => $ext,
                                'fichier' => $filename,
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
                $result = $this->Movie->update($_GET['id'], [
                    'titre' => $_POST['titre'],
                    'artiste' => $_POST['artiste'],
                    'apropos' => $_POST['apropos'],
                    'dtime' => $dtime,
                    'sdate' => $sdate
                ]);
                if($result){
                    $errors = true;
                }
            }
        }

        $movie = $this->Movie->find($_GET['id']);

        $form = new DafstyleForm($movie);
        $this->render('admin.movies.edit', compact('form', 'movie', 'errors'));
    }


    /**
    * del()
    * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
    * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Movie->delete($_POST['id']);
            return $this->index();
        }
    }
}
?>
