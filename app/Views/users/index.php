<div class="daf-gr-ctnr container">
<div class="daf-gr-sct">
    <div class="daf-sct-10">
    <div class="alert titro">Connexion au back-office</div>
    <?php if ($errors): ?>
        <div class="alert alert-warm">Identifiant ou mot de passe incorrect.</div>
    <?php endif; ?>
    <form method="post">
        <?= $form->input('username', 'Nom d\'utilisateur'); ?>
        <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
        <button class="btn btn-primary">Connexion</button>
    </form>
    </div>
</div>
</div>
