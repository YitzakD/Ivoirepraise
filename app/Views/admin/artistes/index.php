<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Les artistes</div>
    <p>
        <a href="?p=admin.artistes.add" class="btn btn-succes"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="?p=admin.home.index" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back home</a>
    </p>
    <table class="daf-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Image / photo</th>
                <th>Genre</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $path = 'medias/images/interviews/' ?>
        <?php foreach($artistes as $artiste) : ?>
            <tr>
                <td><?= $artiste->id ?></td>
                <td><?= $artiste->pseudo ?></td>
                <td><img src ="<?= $path . $artiste->photo ?>" alt="<?= $artiste->pseudo ?>" class="admin-cover" /></td>
                <td><?= $artiste->genre ?></td>
                <td>
                    <a href="?p=admin.artistes.edit&id=<?= $artiste->id; ?>" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="?p=admin.artistes.del" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $artiste->id; ?>">
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
