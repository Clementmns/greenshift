<?php
echo view("templates/header");
?>
<?php $failMessage = session()->getFlashdata('fail'); ?>
<?php if ($failMessage) : ?>
    <div style="color: red;">
        <?= esc($failMessage) ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('auth/loginUser') ?>" method="post">
    <?= csrf_field(); ?>
    <span></span>
    <div>
        <label for="pseudo">Pseudo</label>
        <input value="<?= set_value('pseudo'); ?>" id="pseudo" type="text" name="pseudo" placeholder="Ex: titlah">
        <span><?= isset($validation) ? display_form_errors($validation, 'pseudo') : ''; ?></span>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input value="<?= set_value('password'); ?>" id="password" type="password" name="password" placeholder="Ex: motdepasse1234">
        <span><?= isset($validation) ? display_form_errors($validation, 'password') : ''; ?></span>
    </div>
    <br>
    <div>
        <button class="bg-blue-400 text-white p-2 rounded-md">Se connecter</button>
    </div>
</form>
<br><br>
<a href="<?= base_url('auth/register'); ?>">Vous n'avez toujours pas de compte ? Créer un compte</a>
<?php
echo view("templates/footer");
?>