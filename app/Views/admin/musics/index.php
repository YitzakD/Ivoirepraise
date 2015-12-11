<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Les musiques</div>
    <p>
        <a href="?p=admin.musics.add" class="btn btn-succes"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="?p=admin.home.index" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back home</a>
    </p>
    <table class="daf-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Artiste</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Cover</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $path = 'medias/images/albums/'; ?>
        <?php foreach($musics as $music) : ?>
            <tr>
                <td><?= $music->id ?></td>
                <td><?= $music->titre ?></td>
                <td><?= $music->artiste ?></td>
                <td><?= $music->album ?></td>
                <td><?= $music->genre ?></td>
                <td><img src="<?= $path . $music->cover; ?>" alt="<?= $music->album; ?>" class="admin-cover" /></td>
                <td>
                    <a href="?p=admin.musics.edit&id=<?= $music->id; ?>" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="?p=admin.musics.del" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $music->id; ?>">
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
