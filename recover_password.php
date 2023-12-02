<?php
include 'Backend/templates.php';
////ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


?>

<?= template_header('Recover Password') ?>
<p>
  You will be sent a temporary token that will allow you to change reset your password, please input the email from which you registered
</p>

<form method='post' id='send_token'>
    <input type="email" name='email' placeholder="Email" id="email">
    <input type="submit" value="Send token" id="send">
</form>

<form method='post' id='verify_token'>
    <input type="password" name='token' placeholder="Token" id="token">
    <input type="submit" value="Verify_token">
</form>

<div id='alert'>
    <p>

    </p>
</div>



<?= template_footer() ?>
