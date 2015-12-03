<?php
use Core\HTML\DafstyleForm;
$actuTable = App::getInstance()->getTable('Actuality');
$catsTable = App::getInstance()->getTable('Category');
if(!empty($_POST)){
    $result = $actuTable->create([
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'category_id' => $_POST['category_id']
    ]);
    if($result){
        header('Location: admin.php?p=actus.home');
    }else{
        ?><div class="alert alert-warm">Impossible d'éffectuer cet enregistrement.</div><?php
    }
}
$categs = $catsTable->extractThis('id', 'titre');
$form = new DafstyleForm($_POST);
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter une actualité</div>
    <form method="post">
        <?= $form->select('category_id', 'Catégorie', $categs); ?>
        <?= $form->input('titre', 'Titre de l\'actualité'); ?>
        <?= $form->input('contenu', 'Contenu de l\'actualité', ['type' => 'textarea']); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=actus.home" class="btn-link">Retour</a>
    </div>
</div>
