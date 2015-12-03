<?php
namespace App\Controller;
use Core\Auth\DBAuth;
use Core\HTML\DafstyleForm;
use \App;
/**
 * Class UserController
 * @package Ivp
*/

class UserController extends AppController{

    /**
     * login()
     * Connexion à la partie admin
    */
    public function login(){
        $errors = false;
        if(!empty($_POST)){
            $auth = new DBAuth(App::getInstance()->getDb());
            if($auth->login($_POST['username'], $_POST['password'])){
                header('Location: index.php?p=admin.home.index');
            }else{
                $errors = true;
            }
        }
        $form = new DafstyleForm($_POST);

        $this->render('users.index', compact('form', 'errors'));
    }

}
?>
