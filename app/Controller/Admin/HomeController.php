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
        $liens .= '<a href="index.php?p=admin.events.index" class="btn-link"> Evenements</a> | ';
        $liens .= '<a href="index.php?p=admin.interviews.index" class="btn-link"> Interviews</a> | ';
        $liens .= '<a href="index.php?p=admin.images.index" class="btn-link"> Images</a> | ';
        $liens .= '<a href="index.php?p=admin.galbums.index" class="btn-link"> Albums-Photos</a> | ';
        $liens .= '<a href="index.php?p=admin.gallery.index" class="btn-link"> Photos</a> | ';
        $liens .= '<a href="index.php?p=admin.genres.index" class="btn-link"> Genres Musicaux</a> | ';
        $liens .= '<a href="index.php?p=admin.artistes.index" class="btn-link"> Artistes</a> | ';
        $liens .= '<a href="index.php?p=admin.albums.index" class="btn-link"> Albums-Artistes</a> | ';
        $liens .= '<a href="index.php?p=admin.musics.index" class="btn-link"> Musiques</a> | ';
        $liens .= '<a href="index.php?p=admin.movies.index" class="btn-link"> Vidéos</a> | ';
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
