<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include 'administrator.php'; //class User

  if(isset($_POST)){
    extract($_POST);
      //extract the values of post
    switch($action){
      case 'login':
        login($username, $password);
        break;
      case 'register':
        //var_dump($action.$name. $last_name. $username. $email. $password);
        register($name, $last_name, $username, $email, $password);
        break;
    }
    
  }
?>