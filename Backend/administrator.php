<?php
include 'db.php'; //incluye la base de datos
include 'functions.php'; //incluye algunas funciones de apoyo
ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
session_start();

  /** ------------------------------------
   *  REGISTRATION PROCESS
   *///

  function send_verification_code($name, $last_name, $username, $email){
    
    if (!isValidDomain($email)) {
      $_SESSION['error'] = 'Invalid email address';
      echo('register.php');
      exit();
    }
  
    $token = bin2hex(random_bytes(50)); 
    $expiryTime = date('Y-m-d H:i:s', strtotime('+30 minutes')); // Expiry set to 30 minutes from now
    
    include 'mailer.php';
    Verify_User($email, $token); // Send temporary password
    
    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('INSERT INTO users (name, last_name, username, email, token, token_expiry) VALUES (?, ?, ?, ?, ?, ?)');

    $values = [$name, $last_name, $username, $email, $token, $expiryTime]; 
    
    if ($stmt->execute($values)) {
        $id = $pdo->lastInsertId();
        if(!isset($_SESSION['info'])) $_SESSION['info'] = array();
        $_SESSION['info']['id'] = $id;
        $_SESSION['info']['username'] = $username;
        $_SESSION['info']['email'] = $email;
        $stmt->closeCursor();
        $pdo = null;
        exit();
    }else {
      $errorInfo = $stmt->errorInfo();
      $_SESSION['error'] = $errorInfo[2] . ' ' . $errorInfo[1];
  
      echo("register.php");
      $stmt->closeCursor();
      $pdo = null;
      exit();
    }
  }

  function check_temp_password($temporary_password){

    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('SELECT token, token_expiry FROM users WHERE id = ?');

    
    if($stmt->execute([$_SESSION['info']['id']])){
      $userData = $stmt->fetch(PDO::FETCH_ASSOC);
      if($userData){
        $token = $userData['token'];
        $expiry = $userData['token_expiry'];
        $Time = date('Y-m-d H:i:s');
        if($token === $temporary_password && $expiry >= $Time){
          $query = $pdo->prepare('UPDATE users SET token = NULL, token_expiry = NULL WHERE id = ?');
          $query->execute([$_SESSION['info']['id']]);
          $_SESSION['logged'] = true;
          $stmt->closeCursor();
          $pdo = null;
          echo('change_password.php');
          exit();
  
        }else{
          $_SESSION['error'] = 'Registration failed, temporary password is incorrect, or more than 30 minutes have passed';
          $stmt->closeCursor();
          $pdo = null;
          echo('register.php');
          exit();
        }
      }else{
        $errorInfo = $stmt->errorInfo();
        $_SESSION['error'] = $errorInfo[2] . ' ' . $errorInfo[2];
        $stmt->closeCursor();
        echo('register.php');
        $pdo = null;
        exit();
      }
    }else{
      $errorInfo = $stmt->errorInfo();
      $_SESSION['error'] = $errorInfo[2] . ' ' . $errorInfo[2];
      $stmt->closeCursor();
      echo('register.php');
      $pdo = null;
      exit();
    }
    
  }

  /**
   * END OF REGISTRATION PROCESS
   *///-----------------------------------------------


  /*-------------------------------------
      LOGIN --------------------
  *///------------------------------

  function recover_username($email){

    if(!isValidDomain($email)){
      $_SESSION['error'] = 'Email domain not valid';
      echo('login.php');
      exit();
    }

    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT username FROM users WHERE email = ?');

    if($stmt -> execute([$email])){
      $rows = $stmt->rowCount();
      if($rows > 0){
        $username = $stmt -> fetch(PDO::FETCH_ASSOC);
  
        if($username){
          include 'mailer.php';
          send_username($username['username'],$email);
          echo('login.php');
          exit();
  
        }
      }else{
        $errorInfo = 'There is no username associated with that email';
        $_SESSION['error'] = $errorInfo;
        $stmt->closeCursor();
        echo('login.php');
        $pdo = null;
        exit();
      }
    }else{
      $errorInfo = 'There is no username associated with that email';
      $_SESSION['error'] = $errorInfo;
      $stmt->closeCursor();
      echo('login.php');
      $pdo = null;
      exit();
    }
    
  }

  function send_password_token($email){

    if(!isValidDomain($email)){
      $_SESSION['error'] = 'email domain not valid';
      header('Location: ../login.php');
      exit();
    }

    $token = bin2hex(random_bytes(50)); // Temporary token
    $expiryTime = date('Y-m-d H:i:s', strtotime('+30 minutes')); // Expiry set to 30 minutes from now
    
    include 'mailer.php';
    mail_password_token($email, $token); // Send temporary token
    
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('UPDATE users SET token = ?, token_expiry = ? WHERE email = ?');

    $values = [$token, $expiryTime, $email]; 

    //DEBUGGING ECHOS
     echo($stmt->queryString); 
     echo($token); 
     echo($expiryTime);
     echo($email);
     
    

    if ($stmt->execute($values)) {

      if($stmt->rowCount() > 0){
        if(!isset($_SESSION['info'])) $_SESSION['info'] = array(); 
        $_SESSION['info']['email'] = $email;
        $stmt->closeCursor();
        $pdo = null;
        echo('recover_password.php');
        exit();
      }else{
        $errorInfo = 'There is no username associated with that email';
        $_SESSION['error'] = $errorInfo;
        $stmt->closeCursor();
        $pdo = null;
        echo('login.php');
        exit();
      }
    } else {
      $errorInfo = $stmt->errorInfo();
      $_SESSION['error'] = $errorInfo[2];
      $stmt->closeCursor();
      $pdo = null;
      echo('login.php');
      exit();
    }
    
  }

  function verify_token($token){
    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('SELECT token, token_expiry FROM users WHERE email = ?');

    $stmt->execute([$_SESSION['info']['email']]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if($userData){
      $db_token = $userData['token'];
      $expiry = $userData['token_expiry'];
      $Time = date('Y-m-d H:i:s');
      $_SESSION['info']['id'] = $userData['id'];
      $_SESSION['info']['username'] = $userData['username'];
      $_SESSION['info']['name'] = $userData['name'];
      $_SESSION['info']['last_name'] = $userData['last_name'];
      /** DEBUGGING
       *       echo($db_token. ' ');
       *       var_dump($token);
       *       var_dump('\n' . $expiry. ' ');
       *       var_dump($Time . '\n');
       *       var_dump($_SESSION['info']['email']);
       */

      if($token === $db_token and $expiry >= $Time){

        $query = $pdo->prepare('UPDATE users SET token = NULL, token_expiry = NULL WHERE email = ?');
        $query->execute([$_SESSION['info']['email']]);
        $_SESSION['logged'] = true;        
        $stmt->closeCursor();
        echo('change_password.php');
        exit();

      }else{
        $_SESSION['error'] = 'Tokens do not match';
        $stmt->closeCursor();
        $pdo = null;
        echo('login.php');
        exit();
      }

    }else{
      $errorInfo = $stmt->errorInfo();
      $_SESSION['error'] = $errorInfo[2];
      $stmt->closeCursor();
      $pdo = null;
      echo('login.php');
      exit();
    }
   
  }

  function change_password($password){

    $pdo = pdo_connect_mysql();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = null;
    //here there is 2 options, by email(password change) or by id(registration)
    if(isset($_SESSION['info']['id'])){
      $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');

      if($stmt -> execute([$hash,$_SESSION['info']['id']])){
        $stmt->closeCursor();
        $pdo = null;
        echo('dashboard.php');
        exit();
      }else{
        $errorInfo = $stmt->errorInfo();
        $_SESSION['error'] = $errorInfo[2] . ' ' . $errorInfo[1];
        $stmt->closeCursor();
        $pdo = null;
        echo('registration.php');
        exit();
      }

    }else if(isset($_SESSION['info']['email'])){

      $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');

      if($stmt -> execute([$hash,$_SESSION['info']['email']])){
        $stmt->closeCursor();
        $pdo = null;
        echo('dashboard.php');
        exit();
      }else{
        $errorInfo = $stmt->errorInfo();
        $_SESSION['error'] = $errorInfo[2] . ' ' . $errorInfo[1];
        $stmt->closeCursor();
        $pdo = null;
        echo('login.php');
        exit();
      }

    }else{
      $_SESSION['error'] = 'Something went wrong';
      echo('welcome.html');
      exit();
    }
  }


  function login($username, $password){

    $pdo = pdo_connect_mysql();
    $stmt = $pdo -> prepare('SELECT * FROM users WHERE username = ?');

    if(!$stmt){
      $_SESSION['error'] = 'Log in error: please try again.';
      echo('login.php');
      exit();
    }
    
    if(!$stmt -> execute([$username])){
      $_SESSION['error'] = 'Enter valid username';
      echo('login.php');
      exit();
    }
    
    $user = $stmt -> fetch(PDO::FETCH_ASSOC); //fetch the user
    $hashed_password = $user['password']; //password of the user
    
    if(password_verify($password, $hashed_password)){
      $_SESSION['info'] = array();
      $_SESSION['info']['username'] = $username;
      $_SESSION['info']['id'] = $user['id'];
      $_SESSION['info']['email'] = $user['email'];
      $_SESSION['logged'] = true;
      $stmt->closeCursor();
      $pdo = null;
      echo('dashboard.php');
      exit();
    }else{
      $_SESSION['error'] = 'Incorrect password';
      $stmt->closeCursor();
      $pdo = null;
      echo('login.php');
      exit();
    }
  }

  /** --------------------
   * END OF LOGIN 
   */// ---------------

   /**
    * CREATING TASKSSSS
    */

    function create_task($task_name, $start, $end, $description, $importance){

     
      /* Debug logs
        echo $start_date;
        echo "Formatted Date: " . $formattedStartDate;
        echo "Formatted Date: " . $formattedEndDate;
      */

      $start_date = DateTime::createFromFormat('Y-m-d', $start);
      $end_date = DateTime::createFromFormat('Y-m-d', $end);

      if ($start_date !== false and $end_date !== false) {
        //dates are valid
        $formattedStartDate = $start_date->format('Y-m-d'); 
        $formattedEndDate = $end_date->format('Y-m-d');
        echo $importance;
        $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare('INSERT INTO tasks (name, start_date, end_date, description, user_id, importance) VALUES (?,?,?,?,?,?)');

        //echo $stmt;
        $values = [$task_name, $formattedStartDate, $formattedEndDate, $description, $_SESSION['info']['id'], $importance];


        $task = $stmt->execute($values);

        if($task){
          echo 'valid!';
        }else{
          $errorInfo = $stmt->errorInfo();
          $_SESSION['error'] = $errorInfo[2] . ' ' . $errorInfo[1];
          $stmt->closeCursor();
          $pdo = null;
          echo('create_task.php');
          exit();
        }

        //$date_query = $pdo->prepare('INSERT INTO dates');
        
      } else {
        $_SESSION['error'] = 'Invalid date';
        echo('create_task.php');
        exit();
      }

    }

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