<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Les evenements</div>
    <p>
        <a href="?p=admin.events.add" class="btn btn-succes"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="?p=admin.home.index" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back home</a>
    </p>
    <table class="daf-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($events as $event) : ?>
            <tr>
                <td><?= $event->id ?></td>
                <td><?= $event->titre ?></td>
                <td>
                    <a href="?p=admin.events.edit&id=<?= $event->id; ?>" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="?p=admin.events.del" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $event->id; ?>">
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
