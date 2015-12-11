<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Les albums</div>
    <p>
        <a href="?p=admin.albums.add" class="btn btn-succes"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="?p=admin.home.index" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back home</a>
    </p>
    <table class="daf-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Album</th>
                <th>Artiste</th>
                <th>Genre</th>
                <th>Cover</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $path = 'medias/images/albums/'; ?>
        <?php foreach($albums as $album) : ?>
            <tr>
                <td><?= $album->id ?></td>
                <td><?= $album->titre ?></td>
                <td><?= $album->pseudo ?></td>
                <td><?= $album->genre ?></td>
                <td>
                    <?php
                    if($album->cover != ""){
                        ?><img src="<?= $path . $album->cover; ?>" alt="<?= $album->titre; ?>" class="admin-cover" /><?php
                    }else{
                        ?><img src="<?= $path . 'cover.jpg' ?>" alt="cover" class="admin-cover" /><?php
                    }
                    ?>
                </td>
                <td>
                    <a href="?p=admin.albums.edit&id=<?= $album->id; ?>" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="?p=admin.albums.del" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $album->id; ?>">
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
