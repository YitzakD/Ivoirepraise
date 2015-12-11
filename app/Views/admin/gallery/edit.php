<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Editer - [ cette photo }</div>
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
            <label>Image actuelle</label>
            <?php $path = 'medias/images/gallery/'; ?>
            <img src="<?= $path . $photo->fichier ?>" class="admin-egallery" />
        </div>
        <?= $form->select('galbum_hash', 'Album', $galbum); ?>
        <?= $form->input('fichier', 'Nouveau fichier image', ['type' => 'file']); ?>
        <div class="form-group">
            <input type="hidden" name="hideName" value="<?= $photo->fichier ?>">
        </div>
        <button class="btn btn-primary">Editer</button>
    </form>
    <br>
    <a href="?p=admin.gallery.index" class="btn-link">Retour</a>
    </div>
</div>
</div>