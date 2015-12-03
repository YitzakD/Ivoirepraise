<?php
use Core\HTML\DafstyleForm;
use Core\Auth\DBAuth;

if(!empty($_POST)){
    $auth = new DBAuth(App::getInstance()->getDb());
    if($auth->login($_POST['username'], $_POST['password'])){
        header('Location:admin.php');
    }else{
        ?><div class="alert alert-warm">Identifiant ou mot de passe incorrect.</div><?php
    }
}
$form = new DafstyleForm($_POST);
?>
<div class="daf-gr-ctnr">
    <div class="daf-sct-10">
    <div class="alert titro">Connexion au back-office</div>
    <form method="post">
        <?= $form->input('username', 'Nom d\'utilisateur'); ?>
        <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
        <button class="btn btn-primary">Connexion</button>
    </form>
    </div>
</div>
