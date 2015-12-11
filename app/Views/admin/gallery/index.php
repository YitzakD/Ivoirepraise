<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Les musiques</div>
    <?php $path = 'medias/images/gallery/'; ?>
    <p>
        <a href="?p=admin.gallery.add" class="btn btn-succes"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="?p=admin.home.index" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back home</a>
    </p>
    <table class="daf-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Album</th>
            <th>Action</th>
        </tr>
    </thead>    
    <tbody>
    <?php foreach($photos as $photo) : ?>
        <tr>
            <td><?= $photo->id ?></td>
            <td><img src="<?= $path . $photo->fichier; ?>" alt="<?= $photo->album; ?>" class="admin-gallery" /></td>
            <td><?= $photo->album ?></td>
            <td>
                <a href="?p=admin.gallery.edit&id=<?= $photo->id; ?>" class="btn btn-primary">
                <i class="fa fa-pencil"></i> Edit
                </a>
                <form action="?p=admin.gallery.del" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $photo->id; ?>">
                    <button type="submit" class="btn btn-warm"><i class="fa fa-trash"></i> Suppr</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>   
    </tbody>
    </table>    
    </div>
</div>
</div>
