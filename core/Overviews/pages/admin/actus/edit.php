<?php
use Core\HTML\DafstyleForm;
$actuTable = App::getInstance()->getTable('Actuality');
$catsTable = App::getInstance()->getTable('Category');
if(!empty($_POST)){
    $result = $actuTable->update($_GET['id'], [
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'category_id' => $_POST['category_id']
    ]);
    if($result){
        ?><div class="alert alert-succes">Modification éffectuée avec succès.</div><?php
    }
}
$actus = $actuTable->find($_GET['id']);
$categs = $catsTable->extractThis('id', 'titre');
$form = new DafstyleForm($actus);
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-10">
    <div class="alert titro">EDITER - " <?= $actus->titre; ?> "</div>
    <form method="post">
        <?= $form->select('category_id', 'Catégorie', $categs); ?>
        <?= $form->input('titre', 'Titre de l\'actualités'); ?>
        <?= $form->input('contenu', 'Contenu de l\'actualité', ['type' => 'textarea']); ?>
        <button class="btn btn-primary">Editer</button>
    </form>
    <br>
    <a href="?p=actus.home" class="btn-link">Retour</a>
    </div>
</div>
