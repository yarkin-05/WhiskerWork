<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'functions.php';

$action = $_POST['action'];
$msg = '';
switch($action){
  case 'register':
    //user credentials
    $username = $_POST['username'];
    $email = $_POST['email'];
    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //insert into db
    $id = register($_POST['name'], $_POST['last_name'], $username, $email, $hashed);

    if($id){
      //user created, set credentials
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $id;
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $hashed;
      $msg = 'User created!';
    }else{
      $msg = -1;
    }
    echo $msg;
    break;

  case 'login':
    $username = $_POST['username'];
    $password = $_POST['password'];
    break;

  case 'reset_password':
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //new, need to update

    $id = get_id_from_username($username);
    if($id){
      if(reset_password($id, $password)){
        $msg = 'Update was a success!';
        $_SESSION['password'] = $password;
      }
      else{
        $msg = -1;
      }

    }else{
      $msg = -1;
    }
    echo $msg;
    break;

}


?>