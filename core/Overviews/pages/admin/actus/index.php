<?php
    $actus = App::getInstance()->getTable('Actuality')->all();
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-10">
    <div class="alert titro">Les actualités</div>
    <p>
        <a href="?p=actus.add" class="btn btn-succes"><i class="fa fa-plus"></i> Ajouter</a>
        <a href="?p=home" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back home</a>
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
        <?php foreach($actus as $actu) : ?>
            <tr>
                <td><?= $actu->id ?></td>
                <td><?= $actu->titre ?></td>
                <td>
                    <a href="?p=actus.edit&id=<?= $actu->id; ?>" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="?p=actus.del" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $actu->id; ?>">
                        <button type="submit" class="btn btn-warm" href="?p=actus.del&id=<?= $actu->id; ?>">
                            <i class="fa fa-trash"></i> Suppr
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
