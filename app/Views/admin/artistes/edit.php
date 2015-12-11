<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Editer [ <?= $artiste->pseudo; ?> ]</div>
    <?php
    if($errors){
        if($errors === false){
            ?><div class="alert alert-warm">Impossible d'éffectuer cette opération.</div><?php
        }else{
            ?><div class="alert alert-succes">Opération éffectuée avec succès !</div><?php
        }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Photo actuelle</label>
            <?php $path = 'medias/images/interviews/'; ?>
            <img src="<?= $path . $artiste->photo ?>" class="admin-egallery" />
        </div>
        <?= $form->input('pseudo', 'Pseudonyme de l\'artiste'); ?>
        <?= $form->input('noms', 'Nom et prénoms'); ?>
        <?= $form->input('annee', 'Date de naissance'); ?>
        <?= $form->select('genre_id', 'Genre musical', $genre); ?>
        <?= $form->input('bio', 'La petite biographie', ['type' => 'textarea']); ?>
        <?= $form->input('fichier', 'Fichier musique', ['type' => 'file']); ?>
        <div class="form-group">
            <input type="hidden" name="hideName" value="<?= $artiste->photo ?>">
        </div>
        <button class="btn btn-primary">Editer</button>
    </form>
    <br>
    <a href="?p=admin.artistes.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
