<?php

function pdo_connect_mysql(){

  $DATABASE_HOST = '64.226.72.83';
  $DATABASE_USER = 'localhost';
  $DATABASE_PASS = '3626400eeb94cdea37cbe094656a925668fa0f94797fa148';
  $DATABASE_NAME = 'WhiskerWork';

  
  try{
    return new PDO('mysql:host='. $DATABASE_HOST.';dbname='. $DATABASE_NAME. ';charset=utf8mb4_unicode_ci', $DATABASE_USER, $DATABASE_PASS);
    
  } catch (PDOException $e) {
    $error = ''. $e->getMessage();
    exit ($error);
  }
}
?>