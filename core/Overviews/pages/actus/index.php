<div class="daf-gr-ctnr">
    <div class="daf-sct-7">
    <div class="alert alert-default titro">Actualités</div>
    <?php foreach (App::getInstance()->getTable('Actuality')->last() as $actu): ?>
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
            <?php foreach (App::getInstance()->getTable('Category')->all() as $categ): ?>
                <a href="<?= $categ->url; ?>" class="list-group-item"><?= $categ->titre; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
