<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

  function Verify_User($email, $token){
    $mail = new PHPMailer(true);
    
    try {
      //Server settings
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
      $mail->isSMTP();
      $mail->Host = 'mail.privateemail.com';
      $mail->SMTPAuth= true; 
      $mail->Username= 'whiskerworks@httpswhiskerwork-yhtk.me'; 
      $mail->Password = '5HAp8W7g4W.rE!Q';  
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
      $mail->Port = 587; 

      //Recipients
      $mail->setFrom('whiskerworks@httpswhiskerwork-yhtk.me', 'WhiskerWorks');
      $mail->addAddress($email); //Add a recipient

      //content
      $mail->isHTML(true);  //Set email format to HTML
      $mail->Subject = 'Verify your account';
      $mail->Body = '<h1>Hi!</h1> <br> 
      <h3>
        This is your verification code, please enter this code where it says user code: <br> <b>'.$token.'</b>
      </h3>';
      $mail->send();
    } catch (Exception $e){
      $_SESSION['error'] = "Failed to send email: " . $mail->ErrorInfo; // Detailed error message      
      exit();
    }
  }

  function send_username($username,$email){
    $mail = new PHPMailer(true);
    
    try {
      //Server settings
      $mail->isSMTP();
      $mail->Host = 'mail.privateemail.com';
      $mail->SMTPAuth= true; //Enable SMTP authentication
      $mail->Username= 'whiskerworks@httpswhiskerwork-yhtk.me'; //SMTP username
      $mail->Password = '5HAp8W7g4W.rE!Q';  //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //TLS encryption
      $mail->Port = 587; //TLS port

      //Recipients
      $mail->setFrom('whiskerworks@httpswhiskerwork-yhtk.me', 'WhiskerWorks');
      $mail->addAddress($email); //Add a recipient

      //content
      $mail->isHTML(true);  //Set email format to HTML
      $mail->Subject = 'Recover username';
      $mail->Body = '<h1>Hi!</h1> <br> 
      <h5>
        This is your username: <b>'.$username.'</b>
      </h5>';
      $mail->send();

    } catch (Exception $e){
      $_SESSION['error'] = $mail->ErrorInfo; // Detailed error message      
    }
  }

  function mail_password_token($email, $token){
    $mail = new PHPMailer(true);
    
    try {

      //Server settings
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
      $mail->isSMTP();
      $mail->Host = 'mail.privateemail.com';
      $mail->SMTPAuth= true; 
      $mail->Username= 'whiskerworks@httpswhiskerwork-yhtk.me'; 
      $mail->Password = '5HAp8W7g4W.rE!Q'; 
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
      $mail->Port = 587; 

      //Recipients
      $mail->setFrom('whiskerworks@httpswhiskerwork-yhtk.me', 'WhiskerWorks');
      $mail->addAddress($email); 

      //content
      $mail->isHTML(true);  //Set email format to HTML
      $mail->Subject = 'Password Recovery';
      $mail->Body = '<h1>Hi!</h1> <br> 
      <h3>
        This is your token for password recovery: <b>'.$token.'</b>, mind that this token will no longer be valid after 30 minutes
      </h3>';
      $mail->send();
      echo 'message sent!';
    } catch (Exception $e){
      $_SESSION['error'] = "Failed to send email: " . $mail->ErrorInfo; // Detailed error message   
      echo 'login.php';   
    }
  }

?>
