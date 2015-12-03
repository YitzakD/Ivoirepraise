<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-7">
    <div class="alert alert-default titro">Actualités</div>
    <?php foreach ($actus as $actu): ?>
        <p>
            <h2>
                <a href="<?= $actu->url; ?>" class="btn-link"><?= $actu->titre; ?></a> -
                <small>
                </small>
            </h2>
        </p>
        <p><?= $actu->extrait; ?></p>
        <br>
    <?php endforeach; ?>
    </div>
</div>
</div>
