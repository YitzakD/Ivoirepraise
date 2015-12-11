<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Editer - [ <?= $movie->titre . ' - ' . $movie->artiste ?> }</div>
    <?php
    if($errors){
        if($errors === false){
            ?>
                <div class="alert alert-warm">
                    <span class="fa fa-ban" ></span> Oops, impossible d'éffectuer cette opération.
                </div>
            <?php
        }else{
            ?>
                <div class="alert alert-succes">
                    <span class="fa fa-check" ></span> Opération éfectuée avec succes !
                </div>
            <?php
        }
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Video actuelle</label>
            <?php $path = 'medias/movies/'; ?>
            <video src="<?= $path . $movie->fichier ?>" controls class="admin-evideo"></video>
        </div>
        <?= $form->input('titre', 'Titre'); ?>
        <?= $form->input('artiste', 'Nom de l\'artiste'); ?>
        <?= $form->input('apropos', 'A propos', ['type' => 'textarea']); ?>
        <?= $form->input('fichier', 'Nouveau fichier video', ['type' => 'file']); ?>
        <div class="form-group">
            <input type="hidden" name="hideName" value="<?= $movie->fichier ?>">
        </div>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.movies.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
