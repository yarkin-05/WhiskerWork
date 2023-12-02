<?php
  include 'administrator.php'; 

  if(isset($_POST)){
    extract($_POST);
      //extract the values of post
    switch($action){

      /**
       * LOGIN BEGINS
       */
      case 'recover_username':
        recover_username($email);
        break;
      
      case 'send_password_token':
        //var_dump($email);
        send_password_token($email);
        break;

      case 'verify_token':
        verify_token($token);
        break;

      case 'login':
        login($username, $password);
        break;

      case 'change_password':
        change_password($password);
        break;
      /**
       * LOGIN ENDS
       */


      /**
       * Registration begins
       */
      case 'send_verification_code':
        send_verification_code($name, $last_name, $username, $email);
        break;

      case 'check_temporary_password':
        check_temp_password($temporary_password);
        break;

      case 'reset_password':
        reset_password($password);
        break;
      /**
       * Registration ends
       */

      case 'register':
        register($name, $last_name, $username, $email, $password);
        break;
      
    }
    
  }
?>