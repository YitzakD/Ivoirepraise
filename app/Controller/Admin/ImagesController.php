<?php
namespace App\Controller\Admin;

use Core\HTML\DafstyleForm;

/**
 * Class ImagesController
 * @package Ivp
*/

class ImagesController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Image');
    }

    /**
     * index()
     * Affiche le contenu de la table gallery
     * @return array();
    */
    public function index(){
        $images = $this->Image->findImage();

        $this->render('admin.images.index', compact('images'));
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
            $type = $_POST["hideType"];
            $oldName = $_POST["hideName"];
            if($type === 'ACTUALITE'){

                $path = ROOT . '/public/medias/images/actus/';

            }elseif($type === 'EVENEMENT'){

                $path = ROOT . '/public/medias/images/events/';

            }

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
                        $result = $this->Image->update($_GET['id'], [
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
            ?><div class="alert alert-warm"><span class="fa fa-ban" ></span> Vous devez choisir un fichier !</div><?php
        }

        }

        $photo = $this->Image->find($_GET['id']);

        $form = new DafstyleForm($photo);
        $this->render('admin.images.edit', compact('form', 'photo', 'errors'));
    }


    /**
     * del()
     * Controller qui éfface l'enregistrement dont l'id est rentré en paramêtre
     * Page de suppression
    */
    public function del(){
        if(!empty($_POST)){
            $result = $this->Image->delete($_POST['id']);
            return $this->index();
        }
    }

}
?>
