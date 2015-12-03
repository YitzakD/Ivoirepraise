<?php
namespace App\Controller\Admin;

/**
 * Class HomeController
 * @package Ivp
*/

class HomeController extends AppController{

    /**
     * home()
     * Affiche le menu
     */
    public function index(){
        $liens = '<div class="daf-gr-sct">';
        $liens .= '<a href="index.php?p=admin.home.index" class="btn-link"> Dashboard</a> | ';
        $liens .= '<a href="index.php?p=admin.actus.index" class="btn-link"> Actualités</a> | ';
        $liens .= '<a href="index.php?p=admin.categs.index" class="btn-link"> Categories</a> | ';
        $liens .= '<a href="index.php?p=admin.home.out" class="btn-link"> Logout</a></div>';

        $this->render('admin.home.index', compact('liens'));
    }


    /**
     * out()
     * Deconnexion
     */
    public function out(){
        session_destroy();
        header("Location: index.php?p=home.index");
    }
}
?>
