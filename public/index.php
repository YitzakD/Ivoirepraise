<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();
/**
 * Nouvelle methode
*/
if(isset($_GET['p'])){
    $p = $_GET['p'];
}else{
    $p = 'home.index';
}

$p = explode('.', $p);
if($p[0] == 'admin'){
    $ctrl = '\App\Controller\Admin\\' . ucfirst($p[1]) . 'Controller';
    $action = $p[2];
}else{
    $ctrl = '\App\Controller\\' . ucfirst($p[0]) . 'Controller';
    $action = $p[1];
}
$ctrl = new $ctrl();
$ctrl->$action();


/**
 *
 * 
 * Ancienne methode
 * if(isset($_GET['p'])){
 *    $p = $_GET['p'];
 * }else{
 *    $p = 'home';
 * }
 *
 *
 * if($p === 'home'){
 *    $ctrl = new \App\Controller\HomeController();
 *    $ctrl->home();
 * }elseif($p === 'actus.actualites'){
 *    $ctrl = new \App\Controller\ActusController();
 *    $ctrl->index();
 * }elseif($p === 'actus.actualite'){
 *    $ctrl = new \App\Controller\ActusController();
 *    $ctrl->actuality();
 * }elseif($p === 'categs.categorie'){
 *    $ctrl = new \App\Controller\CategsController();
 *    $ctrl->categoriesList();
 * }elseif($p === 'user.login'){
 *    $ctrl = new \App\Controller\UserController();
 *    $ctrl->login();
 * }elseif($p === 'admin.home'){
 *    $ctrl = new \App\Controller\Admin\HomeController();
 *    $ctrl->home();
 * }elseif($p === 'admin.actus.home'){
 *    $ctrl = new \App\Controller\Admin\ActusController();
 *    $ctrl->actusList();
 * }elseif($p === 'admin.actus.add'){
 *    $ctrl = new \App\Controller\Admin\ActusController();
 *    $ctrl->add();
 * }elseif($p === 'admin.actus.edit'){
 *    $ctrl = new \App\Controller\Admin\ActusController();
 *    $ctrl->edit();
 * }elseif($p === 'user.out'){
 *    $ctrl = new \App\Controller\Admin\UserController();
 *    $ctrl->logout();
 * }
 *
 *
*/


?>
