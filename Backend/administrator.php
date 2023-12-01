<?php

include 'db.php'; //incluye la base de datos
include 'functions.php'; //incluye algunas funciones de apoyo
session_start();

  /** ------------------------------------
   *  REGISTRATION PROCESS
   *///
  function send_verification_code($name, $last_name, $username, $email){
    
    if (!isValidDomain($email)) {
      $_SESSION['error'] = 'Invalid email address';
      header('Location: ../register.php');
      exit();
    }
  
    $token = bin2hex(random_bytes(50)); // Temporary password
    $expiryTime = date('Y-m-d H:i:s', strtotime('+30 minutes')); // Expiry set to 30 minutes from now
    
    include 'mailer.php';
    Verify_User($email, $token); // Send temporary password
    
    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('INSERT INTO users (name, last_name, username, email, token, token_expiry) VALUES (?, ?, ?, ?, ?, ?)');

    $values = [$name, $last_name, $username, $email, $token, $expiryTime]; 
    
    if ($stmt->execute($values)) {
        $id = $pdo->lastInsertId();
        $_SESSION['info'] = array();
        $_SESSION['info']['id'] = $id;
        $_SESSION['info']['username'] = $username;
        $_SESSION['info']['email'] = $email;
        //var_dump($id);
    } else {
        $errorInfo = $stmt->errorInfo();
        var_dump($errorInfo[2]);
        $_SESSION['error'] = 'Registration failed';
        //echo $_SESSION['error'];
    
        header("Location: ../register.php");
        $stmt->closeCursor();
        $pdo = null;
        exit();
    }
  }

  function check_temp_password($temporary_password){

    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('SELECT token, token_expiry FROM users WHERE id = ?');

    $stmt->execute([$_SESSION['info']['id']]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $token = $userData['token'];
    $expiry = $userData['token_expiry'];
    $Time = date('Y-m-d H:i:s');

    if($userData){
 
      if($token === $temporary_password && $expiry > $Time){
        $query = $pdo->prepare('UPDATE users SET token = NULL, token_expiry = NULL WHERE id = ?');
        $query->execute([$_SESSION['info']['id']]);
        $_SESSION['temporary_registration'] = true;
        $stmt->closeCursor();
        $pdo = null;
        exit();

      }else{
        $_SESSION['error'] = 'Registration failed, temporary password is incorrect, or more than 30 minutes have passed';

        echo $_SESSION['error'];
        $stmt->closeCursor();
        $pdo = null;
        exit();
      }
    }else{
      $_SESSION['error'] = 'Registration failed';
      echo $_SESSION['error'];
      $stmt->closeCursor();
      $pdo = null;
      exit();
    }
    
  }

  function reset_password($password){

    $pdo = pdo_connect_mysql();
    $hash = password_hash($password, PASSWORD_DEFAULT); //secure password

    $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');

    if($stmt -> execute([$hash,$_SESSION['info']['id']])){
      unset($_SESSION['temporary_registration']); // Unset the temp registration because you ar enow registered
      $stmt->closeCursor();
      $pdo = null;
      header('Location: ../dashboard.php');
      exit();
    }else{
      $_SESSION['error'] = 'Something went wrong';
      echo $_SESSION['error'];
      $stmt->closeCursor();
      $pdo = null;
     // header('Location: ../dashboard.php');
      exit();
    }

  }

  /**
   * END OF REGISTRATION PROCESS
   *///-----------------------------------------------


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
    $token = bin2hex(random_bytes(60)); //temporary password
    //var_dump($token);

    
    include 'mailer.php';
    //Verify_User($name, $email, $token); //send temporary email
    
    $hash = password_hash($password, PASSWORD_DEFAULT); //password hash

    /*$pdo = pdo_connect_mysql();
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
    }*/


  }

?>