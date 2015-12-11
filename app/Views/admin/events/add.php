<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter un évenement</div>
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
    <form method="post" enctype="multipart/form-data">
        <?= $form->input('titre', 'Titre de l\'événement'); ?>
        <?= $form->input('contenu', 'Contenu de l\'événement', ['type' => 'textarea']); ?>
        <div class="form-group">
            <label>Fichier de type image</label>
            <input type="file" name="fichier[]" class="daf-form-ctrl" multiple />
        </div>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.events.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
