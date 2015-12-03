<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();

if(isset($_GET['p'])){
    $p = $_GET['p'];
}else{
    $p = 'home';
}

ob_start();
if($p === 'home'){
    require ROOT . '/pages/home/index.php';
}elseif($p === 'actus.actualites'){
    require ROOT . '/pages/actus/index.php';
}elseif($p === 'actus.actualite'){
    require ROOT . '/pages/actus/actus.php';
}elseif($p === 'categs.categorie'){
    require ROOT . '/pages/categs/index.php';
}elseif($p === 'users.login'){
    require ROOT . '/pages/users/index.php';
}

$contents = ob_get_clean();
require ROOT . '/pages/layouts/default.php';
?>
