<?php
    $app = App::getInstance();
    $categ = $app->getTable('Category')->find($_GET['id']);
    if($categ === false){
        $app->notfound();
    }
    $actus = $app->getTable('Actuality')->listBy($_GET['id']);
    $categs = $app->getTable('Category')->all();
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-7">
    <div class="alert alert-default titro"><?= $categ->titre; ?></div>
    <?php foreach ($actus as $actu): ?>
        <p>
            <h2>
                <a href="<?= $actu->url; ?>" class="btn-link"><?= $actu->titre; ?></a> -
                <small>
                    <em><?= $actu->categorie ?></em>
                </small>
            </h2>
        </p>
        <p><?= $actu->extrait; ?></p>
        <br>
    <?php endforeach; ?>
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
