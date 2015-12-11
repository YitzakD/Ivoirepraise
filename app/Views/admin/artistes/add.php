<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Ajouter un artiste</div>
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
        <?= $form->input('pseudo', 'Pseudonyme de l\'artiste'); ?>
        <?= $form->input('noms', 'Nom et prénoms'); ?>
        <?= $form->select('jour', 'Jour de naissance', array(
            '01' => '01',
            '02'=>'02',
            '03'=>'03',
            '04'=>'04',
            '05'=>'05',
            '06'=>'06',
            '07'=>'07',
            '08'=>'08',
            '09'=>'09',
            '10'=>'10',
            '11'=>'11',
            '12'=>'12',
            '13'=>'13',
            '14'=>'14',
            '15'=>'15',
            '16'=>'16',
            '17'=>'17',
            '18'=>'18',
            '19'=>'19',
            '21'=>'21',
            '22'=>'22',
            '23'=>'23',
            '24'=>'24',
            '25'=>'25',
            '26'=>'26',
            '27'=>'27',
            '28'=>'28',
            '29'=>'29',
            '30'=>'30',
            '31'=>'31',
            )
        ); ?>
        <?= $form->select('mois', 'Mois de naissance', array(
            '01' => 'Janvier',
            '02' => 'Fevrier',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre',
            )
        ); ?>
        <?= $form->input('annee', 'Année de naissance'); ?>
        <?= $form->select('genre', 'Genre musical', $genres); ?>
        <?= $form->input('biographie', 'La petite biographie', ['type' => 'textarea']); ?>
        <?= $form->input('fichier', 'Fichier image (.JPEG, .PNG)', ['type' => 'file']); ?>
        <button class="btn btn-primary">Ajouter</button>
    </form>
    <br>
    <a href="?p=admin.artistes.index" class="btn-link">Retour</a>
    </div>
</div>
</div>
