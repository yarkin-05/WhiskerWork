<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();

logged();

?>

<?= template_header('Recover Username', 'Recover Username') ?>

<div class="form">
    <form method="post" autocomplete="off" id="recover_username">
        <input type="email" name='email' placeholder="Email" id="email">
        <input type="submit" value="Recover Username" >
        <div id='alert'>
            <p>

            </p>
        </div>
    </form>
</div>

<?= template_footer() ?>
