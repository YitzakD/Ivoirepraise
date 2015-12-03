<?php
    $app = App::getInstance();
    $actu = $app->getTable('Actuality')->findWith($_GET['id']);
    if($actu === false){
        $app->notfound();
    }
    $categs = $app->getTable('Category')->all();
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-7">
    <div class="alert alert-default titro"><?= $actu->titre; ?></div>
        <span><em><b><?= $actu->categorie; ?></b></em></span>
        <p><?= $actu->contenu; ?></p>
        <br>
        <p><a href="?p=actus.actualites" class="btn-link">Retour</a></p>
    </div>
    <div class="daf-gr-3">
        <div class="alert alert-default titro">Catégories</div>
        <div class="list-group">
            <?php foreach ($categs as $categ): ?>
                <a href="<?= $categ->url; ?>" class="list-group-item"><?= $categ->titre; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
