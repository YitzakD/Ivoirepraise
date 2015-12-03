<?php
namespace App\Controller;
use Core\Controller\Controller;

/**
 * Class HomeController
 * @package Ivp
*/

class HomeController extends AppController{

    /**
     * home()
     * Affiche le contenu du fichier actus/index.php (La liste des actualités)
     */
    public function index(){
        $liens = '<div class="daf-gr-sct">';
        $liens .= '<a href="index.php?p=home.index" class="btn-link"> Accueil</a> | ';
        $liens .= '<a href="index.php?p=actus.index" class="btn-link"> Actualités</a> | ';
        $liens .= '<a href="index.php?p=user.login" class="btn-link"> Login</a></div>';

        $this->render('home.index', compact('liens'));
    }
}
?>
