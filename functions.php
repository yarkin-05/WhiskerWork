<?php

function pdo_connect_mysql(){

  $DATABASE_HOST = '64.226.72.83';
  $DATABASE_USER = 'whisker';
  $DATABASE_PASS = 'whisker';
  $DATABASE_NAME = 'WhiskerWork';

  
  try{
    return new PDO('mysql:host='. $DATABASE_HOST.';dbname='. $DATABASE_NAME. ';charset=utf8mb4_unicode_ci', $DATABASE_USER, $DATABASE_PASS);
    
  } catch (PDOException $e) {
    $error = ''. $e->getMessage();
    exit ($error);
  }
}

  function check_sql_statement($stmt, $values){
    if ($stmt->execute($values)) {
      // If execution is successful, perform actions here
      echo "Data inserted successfully!";
    } else {
      // If there's an error during execution, handle it here
      $errorInfo = $stmt->errorInfo(); // Fetch error information
      
      // Log or display the error message
      echo "Error: " . $errorInfo[2]; 
    }
  }

?>