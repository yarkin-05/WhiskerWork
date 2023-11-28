<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'functions.php';
$action = $_POST['action'];
$msg = '';
switch($action){
  case 'register':
    $name = $_POST['name'];

    $last_name = $_POST['last_name'];

    $username = $_POST['username'];

    $email = $_POST['email'];

    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $id = register($name, $last_name, $username, $email, $hashed);

    if($id !== false){
      //user created
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $id;
      $msg = 'User created!';
    }else{
      $msg = 'Something went wrong';
    }
    break;
}


?>