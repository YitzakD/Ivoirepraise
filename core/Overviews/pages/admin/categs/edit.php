<?php
use Core\HTML\DafstyleForm;

$app = App::getInstance()->getTable('Category');
if(!empty($_POST)){
    $result = $app->update($_GET['id'], [
        'titre' => $_POST['titre']
    ]);
    if($result){
        header('Location: admin.php?p=categs.home');
    }else{
        ?><div class="alert alert-warm">Impossible d'éffectuer cet enregistrement.</div><?php
    }
}
$categs = $app->find($_GET['id']);

$form = new DafstyleForm($categs);
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-10">
    <div class="alert titro">EDITER - " <?= $categs->titre; ?> "</div>
    <form method="post">
        <?= $form->input('titre', 'Titre de la catégorie'); ?>
        <button class="btn btn-primary">Editer</button>
    </form>
    <br>
    <a href="?p=categs.home" class="btn-link">Retour</a>
    </div>
</div>
