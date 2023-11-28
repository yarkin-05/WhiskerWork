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
      $msg = 'Something went wrong';
    }
    echo $msg;
    break;

  case 'login':
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = login($username);
    if($user){
      //user exists
        if($user && password_verify($password, $user['password'])){
          //passwords match
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $user['password'];
          $_SESSION['id'] = $user['id'];
          $_SESSION['email'] = $user['email'];
          $msg = 'User logged in';
        }else{
          $msg = 'Passwords do not match';
        }
    }else{
      $msg = 'Username invalid, please enter a valid username';
    }
    echo $msg;
    break;

  case 'reset_password':
    break;

}


?>