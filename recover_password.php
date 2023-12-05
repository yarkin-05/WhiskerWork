<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
////ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
logged();
$img = fetchImg();


?>

<?= template_header('Recover Password', 'Reset Password', $img) ?>

    <div class="form">
        <form method='post' id='send_token'>
            <p>
            You will be sent a temporary token that will allow you to change reset your password, please input the email from which you registered
            </p>
            
            <input type="email" name='email' placeholder="Email" id="email">
            <input type="submit" value="Send token" id="send">

            <div id='alert'>
                <p>

                </p>
            </div>
        </form>
    </div>


    <div class="form">
        <form method='post' id='verify_token'>
            <input type="password" name='token' placeholder="Token" id="token">
            <input type="submit" value="Verify token"> 
            
            <div id='code_verification'>
                <p>

                </p>
            </div>
        </form>
    </div>







<?= template_footer() ?>
