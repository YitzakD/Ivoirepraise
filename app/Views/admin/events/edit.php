<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Editer \ " <?= $items_edit_events->titre; ?> "</div>
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
        <?= $form->input('titre', 'Titre de l\'évenement'); ?>
        <?= $form->input('contenu', 'Contenu de l\'évenement', ['type' => 'textarea']); ?>
        <button class="btn btn-primary">Editer</button>
    </form>
    <br>
    <a href="?p=admin.events.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
