<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter une catégorie</div>
    <?php
    if($errors){
        if($errors === false){
            ?><div class="alert alert-warm">Impossible d'éffectuer cette opération.</div><?php
        }else{
            ?><div class="alert alert-succes">Opération éfectuée avec succes !</div><?php
        }
    }
    ?>
    <form method="post">
        <?= $form->input('titre', 'Titre de l\'actualités'); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.categs.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
