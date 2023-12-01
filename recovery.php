<?php

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
 
  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP();

    if ($domain === 'gmail.com') $mail->Host = 'smtp.gmail.com';
    else if ($domain === 'outlook.com') $mail->Host = 'smtp-mail.outlook.com';
   
    $mail->SMTPAuth= true; //Enable SMTP authentication
    $mail->Username= 'whiskerworks@httpswhiskerwork-yhtk.me'; //SMTP username
    $mail->Password = '5HAp8W7g4W.rE!Q';  //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('whiskerworks@httpswhiskerwork-yhtk.me', 'WhiskerWorks');
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