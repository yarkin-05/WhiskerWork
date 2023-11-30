<?php
  session_start();
  include 'db.php'; //db conexion

  if(isset($_GET) and isset($_GET['token']) and $_GET['token'] != ""){
    //literally what makes the valid URL
    var_dump( 'Token received: ' . $_GET['token']);

    $token = $_GET['token']; // No need for explicit sanitization

    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token");
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($result['username'])){
      //User exists
      $stmt = $pdo->prepare("UPDATE users SET token = NULL WHERE token = :token");
      $stmt->bindParam(':token', $token, PDO::PARAM_STR);
      $stmt->execute();

      $_SESSION['logged'] = true;
      $_SESSION['username'] = $result['username'];
      $_SESSION['id'] = $result['id'];
      header("Location: ../dashboard.php");
      exit();
    }else{
      if(isset($_SESSION['logged'])) unset($_SESSION['logged']);
      $_SESSION['error'] = "Invalid token";
      echo $_SESSION['error'];
      //header("Location: ../register.php");
      exit();
    }
  }else{
    $_SESSION['error'] = 'I don\'t know how you got here, but get out';
    echo $_SESSION['error'];

    //header('Location: ../register.php');
    exit();
  }
  

?>