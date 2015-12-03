<?php
use Core\HTML\DafstyleForm;
$app = App::getInstance();
$appl = App::getInstance()->getTable('Category');

if(!empty($_POST)){
    $result = $appl->create([
        'titre' => $_POST['titre'],
    ]);
    if($result){
        header('Location: admin.php?p=categs.home');
    }else{
        ?><div class="alert alert-warm">Impossible d'éffectuer cet enregistrement.</div><?php
    }
}

$form = new DafstyleForm($_POST);
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter une catégorie</div>
    <form method="post">
        <?= $form->input('titre', 'Titre de l\'actualités'); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=categs.home" class="btn-link">Retour</a>
    </div>
</div>
