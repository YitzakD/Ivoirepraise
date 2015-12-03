<?php
$app = App::getInstance()->getTable('Category');
$categs = $app->all();
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-10">
    <div class="alert titro">Les catégories</div>
    <p>
        <a href="?p=categs.add" class="btn btn-succes"><i class="fa fa-plus"></i> Ajouter</a>
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
        <?php foreach($categs as $categ) : ?>
            <tr>
                <td><?= $categ->id ?></td>
                <td><?= $categ->titre ?></td>
                <td>
                    <a href="?p=categs.edit&id=<?= $categ->id; ?>" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="?p=categs.del" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $categ->id; ?>">
                        <button type="submit" class="btn btn-warm" href="?p=categs.del&id=<?= $categ->id; ?>">
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
