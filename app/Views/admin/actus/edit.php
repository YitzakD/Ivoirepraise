<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Editer \ " <?= $items_edit_actus->titre; ?> "</div>
    <?php
    if($errors){
        if($errors === false){
            ?><div class="alert alert-warm">Impossible d'éffectuer cette opération.</div><?php
        }else{
            ?><div class="alert alert-succes">Opération éffectue=ée avec succès !</div><?php
        }
    }
    ?>
    <form method="post">
        <?= $form->select('category_id', 'Catégorie', $items_edit_cat_actus); ?>
        <?= $form->input('titre', 'Titre de l\'actualités'); ?>
        <?= $form->input('contenu', 'Contenu de l\'actualité', ['type' => 'textarea']); ?>
        <button class="btn btn-primary">Editer</button>
    </form>
    <br>
    <a href="?p=admin.actus.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
