<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function pdo_connect_mysql(){

  $DATABASE_HOST = '64.226.72.83';
  $DATABASE_USER = 'jacqui';
  $DATABASE_PASS = 'morusa';
  $DATABASE_NAME = 'WhiskerWork';

  
  try{
    return new PDO('mysql:host='. $DATABASE_HOST.';dbname='. $DATABASE_NAME. ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    
  } catch (PDOException $e) {
    $error = ''. $e->getMessage();
    exit ($error);
  }
}




  

 

  function get_id_from_username($username){
    $pdo = pdo_connect_mysql();
    $stmt = $pdo -> prepare('SELECT id FROM users WHERE username = ?');
    $stmt -> execute([$username]);
    $row = $stmt -> fetchColumn();
    return $row;
  }

  function reset_password($id, $new_password){
    $pdo = pdo_connect_mysql();
    $stmt = $pdo -> prepare('UPDATE users SET password = ? WHERE id = ?');
    $stmt -> execute([$new_password, $id]);
    if ($stmt->rowCount() > 0) {
      return true; 
    } else {
      return false; 
    }
  }

  

  
?>



