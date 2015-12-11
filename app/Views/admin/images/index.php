<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Les musiques</div>
    <p>
        <a href="?p=admin.home.index" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back home</a>
    </p>
    <table class="daf-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>    
    <tbody>
    <?php foreach($images as $image) : ?>
        <?php
        if($image->type === 'ACTUALITE'){
            $path = 'medias/images/actus/';
        }elseif($image->type === 'EVENEMENT'){
            $path = 'medias/images/events/';
        }
        ?>
        <tr>
            <td><?= $image->id ?></td>
            <td><?= $image->type; ?></td>
            <td><img src="<?= $path . $image->fichier ?>" alt="<?= $image->type ?>" class="admin-cover" /></td>
            <td>
                <a href="?p=admin.images.edit&id=<?= $image->id; ?>" class="btn btn-primary">
                <i class="fa fa-pencil"></i> Edit
                </a>
                <form action="?p=admin.images.del" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $image->id; ?>">
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
