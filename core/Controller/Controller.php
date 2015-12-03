<?php
namespace Core\Controller;

/**
 * Classe Controller
 * @package DEVAFRICA
*/

class Controller{
    protected $viewPath;
    protected $layout;


    /**
     * render()
     * @param $view => la vue à afficher
     *
    */
    protected function render($view, $elmts = []){
        ob_start();
        extract($elmts);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $contents = ob_get_clean();
        require($this->viewPath . 'layouts/' . $this->layout . '.php');
    }


    /**
     * forbidden() & notFound()
     * Redirige correctement quand la page est inconnue ou nécessite un accès particulier
    */
    protected function forbidden(){
        header("HTTP/1.0 403 Forbidden");
        die ('Acces interdit');
    }

    protected function notFound(){
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php?p=404");
    }
}
?>
