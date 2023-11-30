<?php

include 'db.php'; //incluye la base de datos
include 'functions.php'; //incluye algunas funciones de apoyo
session_start();



  /*-------------------------------------
      LOGIN --------------------
  *///------------------------------
  function login($username, $password){

    $pdo = pdo_connect_mysql();
    $stmt = $pdo -> prepare('SELECT * FROM users WHERE username = ?');

    if(!$stmt){
      $_SESSION['error'] = 'Log in error: please try again.';
      header('Location: ../login.php');
      exit();
    }
    
    if(!$stmt -> execute([$username])){
      $_SESSION['error'] = 'Enter valid username';
      header('Location: ../login.php');
      exit();
    }
    
    $user = $stmt -> fetch(PDO::FETCH_ASSOC); //fetch the user
    $hashed_password = $user['password']; //password of the user
    
    if(password_verify($password, $hashed_password)){
          //passwords match
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $user['password'];
      $_SESSION['id'] = $user['id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['logged'] = true;
      header('Location: ../dashboard.php'); //Redireccion al dashboard
    }else{
      $_SESSION['error'] = 'Incorrect password';
      header('Location: ../login.php');
    }
  }

  /** --------------------
   * REGISTRATION
   */// ---------------

  function register($name, $last_name, $username, $email, $password){

    if(!isValidDomain($email)){
      $_SESSION['error'] = 'Invalid email address';
      header('Location: ../register.php');
      exit();
    }
    
    var_dump($email);
    /*$token = bin2hex(random_bytes(50)); //verification token
    include 'mailer.php';
    Verify_User($name, $email, $token); //send verification email
    */
    $hash = password_hash($password, PASSWORD_DEFAULT); //password hash

    $pdo = pdo_connect_mysql();
    $stmt = $pdo -> prepare('INSERT INTO users (name, last_name, username, email, password) VALUES (?,?,?,?,?)');
    $values = [$name, $last_name, $username, $email, $hash];

    
    if ($stmt->execute($values)) {
      $_SESSION['id'] = $pdo->lastInsertId();
      $_SESSION['logged'] = true;
      var_dump( 'Registration successful!'); // Debug output
      header("Location: ../index.php");
      $stmt->closeCursor();
      $pdo = null;
      exit();
    } else {
        $errorInfo = $stmt->errorInfo(); 
        var_dump($errorInfo[2]);
        $_SESSION['error'] = 'Registration failed';
        echo $_SESSION['error'];

        //header("Location: ../register.php");
        $stmt->closeCursor();
        $pdo = null;
        exit();
    }


  }

?>