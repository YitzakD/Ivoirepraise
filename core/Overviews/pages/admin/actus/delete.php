<?php
$app = App::getInstance()->getTable('Actuality');
if(!empty($_POST)){
    $result = $app->delete($_POST['id']);
    header("Location:admin.php?p=actus.home");
}
