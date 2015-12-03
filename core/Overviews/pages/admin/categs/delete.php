<?php
$app = App::getInstance()->getTable('Category');
if(!empty($_POST)){
    $result = $app->delete($_POST['id']);
    header("Location:admin.php?p=categs.home");
}
