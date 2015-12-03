<?php
namespace App\Controller;
use App\Controller\AppController;
/**
 * Class ActualityController
 * @package Ivp
*/

class ActusController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadModel('Actuality');
    }

    /**
     * index()
     * Affiche le contenu du fichier actus/index.php (La liste des actualités)
    */
    public function index(){
        $actus = $this->Actuality->last();
        // $categs = $this->Category->all();

        $this->render('actus.index', compact('actus','categs'));
    }


    /**
     * actualite()
     * Affiche le contenu du fichier categs/actus.php (L'actualité qui est choisie)
    */
    public function actualite(){
        $actu = $this->Actuality->findWith($_GET['id']);
        if($actu === false){
            $this->notfound();
        }
        $categs = $this->Category->all();

        $this->render('actus.actualite', compact('actu','categs'));
    }

}
?>
