<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter une interview</div>
    <div class="alert alert-info">
        Les balises HTML sont utilisable dans ce formulaire !
    </div>
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
    <form method="post">
        <?= $form->select('artiste_hash', 'Choisir un artiste', $artistes); ?>
        <?= $form->input('titre', 'Titre de l\'interview'); ?>
        <?= $form->input('introduction', 'Introduction', ['type' => 'textarea']); ?>
        <?= $form->input('contenu', 'Contenu de l\'interview', ['type' => 'textarea']); ?>
        <?= $form->input('resume', 'Résumé', ['type' => 'textarea']); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.interviews.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
