<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter un morceau</div>
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
        <?= $form->input('titre', 'Titre du morceau'); ?>
        <?= $form->select('album_hash', 'Album', $albums); ?>
        <?= $form->select('artiste_hash', 'Artiste', $artistes); ?>
        <?= $form->input('apropos', 'A propos de ce morceau', ['type' => 'textarea']); ?>
        <?= $form->input('fichier', 'Fichier musique', ['type' => 'file']); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.musics.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
