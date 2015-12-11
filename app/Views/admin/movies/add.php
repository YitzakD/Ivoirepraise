<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter une vidéos</div>
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
        <?= $form->input('artiste', 'Nom de l\'artiste'); ?>
        <?= $form->input('apropos', 'A propos de ce morceau', ['type' => 'textarea']); ?>
        <?= $form->input('fichier', 'Fichier Videos (.MP4)', ['type' => 'file']); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.movies.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
