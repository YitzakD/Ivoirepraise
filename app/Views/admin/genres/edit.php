<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Editer \ " <?= $items_edit_genre->titre; ?> "</div>
    <?php
    if($errors){
        if($errors === false){
            ?><div class="alert alert-warm">Impossible d'éffectuer cette opération.</div><?php
        }else{
            ?><div class="alert alert-succes">Opération éffectuée avec succès !</div><?php
        }
    }
    ?>
    <form method="post">
        <?= $form->input('titre', 'Titre du genre'); ?>
        <button class="btn btn-primary">Editer</button>
    </form>
    <br>
    <a href="?p=admin.genres.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
