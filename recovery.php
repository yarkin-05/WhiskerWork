<?php
//this is for sending emails for passwords, it would be an extra elemet
include 'functions.php';
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$msg = '';
function recoverEmail(){
  if(!isset($_POST['email'])) return '';
  $email = $_POST['email'];
  $pdo = pdo_connect_mysql();
  $stmt = $pdo -> prepare('SELECT * FROM users WHERE email = ?');
  $stmt -> execute([$email]);
  return $stmt -> fetch(PDO::FETCH_ASSOC); 
}

$user = recoverEmail();
if($user){
  $id = $user['id'];
  $email = $user['email'];
  $mail = new PHPMailer(true);
  $mailParts = explode("@", $email);
  $domain = end($mailParts);
  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP();

    if ($domain === 'gmail.com') $mail->Host = 'smtp.gmail.com';
    else if ($domain === 'outlook.com') $mail->Host = 'smtp-mail.outlook.com';
   
    $mail->SMTPAuth= true; //Enable SMTP authentication
    $mail->Username= 'uoftmetas@gmail.com'; //SMTP username
    //whiskerworks@httpswhiskerwork-yhtk.me
    $mail->Password = 'amomicarro1';  //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('uoftmetas@gmail.com', 'WhiskerWorks');
    $mail->addAddress($email, 'Reset Password');     //Add a recipient

    $mail->isHTML(true);  //Set email format to HTML
    $mail->Subject = 'Reset Password';
    $mail->Body = 'Click this link to recover password <br> <a href="localhost/WhiskerWorks/recover_password.php?id='.$id.'">Recover password</a>';

    

    $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
  


}else{
  $msg = 'There is no user with that email';
}



?>
<?=template_header('Password Recovery') ?>

<p>
  <?= $msg ?>
</p>
<?= template_footer() ?>