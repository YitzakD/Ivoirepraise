<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter un album</div>
    <?php
    if($errors){
        if($errors === false){
            ?><div class="alert alert-warm">Impossible d'éffectuer cette opération.</div><?php
        }else{
            ?><div class="alert alert-succes">Opération éfectuée avec succes !</div><?php
        }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <?= $form->input('titre', 'Titre de l\'album'); ?>
        <?= $form->select('artiste_hash', 'Artiste', $artistes); ?>
        <?= $form->input('parution', 'Année de parution'); ?>
        <?= $form->input('apropos', 'A propos de cet album', ['type' => 'textarea']); ?>
        <?= $form->input('fichier', 'Cover', ['type' => 'file']); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.albums.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
