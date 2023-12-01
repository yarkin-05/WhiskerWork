<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include 'administrator.php'; 

  if(isset($_POST)){
    extract($_POST);
      //extract the values of post
    switch($action){
      case 'login':
        login($username, $password);
        break;

      case 'send_verification_code':
        send_verification_code($name, $last_name, $username, $email);
        break;

      case 'check_temporary_password':
        check_temp_password($temporary_password);
        break;

      case 'reset_password':
        reset_password($password);
        break;

      case 'register':
        register($name, $last_name, $username, $email, $password);
        break;
      
    }
    
  }
?>