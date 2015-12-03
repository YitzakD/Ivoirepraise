<?php
use Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();

if(isset($_GET['p'])){
    $p = $_GET['p'];
}else{
    $p = 'home';
}

// Auth
$app = App::getInstance();
$auth = new DBAuth($app->getDB());
if(!$auth->logged()){
    $app->forbidden();
}

ob_start();
if($p === 'home'){
    require ROOT . '/pages/admin/dashboard/index.php';
}elseif($p === 'actus.home'){
    require ROOT . '/pages/admin/actus/index.php';
}elseif($p === 'actus.add'){
    require ROOT . '/pages/admin/actus/add.php';
}elseif($p === 'actus.edit'){
    require ROOT . '/pages/admin/actus/edit.php';
}elseif($p === 'actus.del'){
    require ROOT . '/pages/admin/actus/delete.php';
}elseif($p === 'categs.home'){
    require ROOT . '/pages/admin/categs/index.php';
}elseif($p === 'categs.add'){
    require ROOT . '/pages/admin/categs/add.php';
}elseif($p === 'categs.edit'){
    require ROOT . '/pages/admin/categs/edit.php';
}elseif($p === 'categs.del'){
    require ROOT . '/pages/admin/categs/delete.php';
}elseif($p === 'dashboard.out'){
    require ROOT . '/pages/admin/dashboard/logout.php';
}

$contents = ob_get_clean();
require ROOT . '/pages/layouts/default.php';
?>
