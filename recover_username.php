<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();

?>

<?= template_header('Recover Username') ?>
<form method="post" id="recover_username">
    <input type="email" name='email' placeholder="Email" id="email">
    <input type="submit" value="Recover Username" >
</form>

<div id='alert'>
    <p>

    </p>
</div>

<?= template_footer() ?>
