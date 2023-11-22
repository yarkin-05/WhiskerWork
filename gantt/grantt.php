<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//important to note that this part is only for development environments

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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gantt Chart</title>
  <link href="styles.css" rel="stylesheet">

  <style>
    /* Add your CSS styles for the Gantt chart here */
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      text-align: center;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Add more styles as needed */
  </style>
</head>
<body>
  <h1>Gantt Chart</h1>

  <table>
    <thead>
      <tr>
        <th>Nº Actividad</th>
        <th>Inicio</th>
        <th>Final</th>
        <th>21 Nov</th>
        <th>22 Nov</th>
        <th>23 Nov</th>
        <th>24 Nov </th>
        <th>25 Nov </th>
        <th>26 Nov </th>
        <th>27 Nov </th>
        <th>28 Nov </th>
        <th>29 Nov </th>
        <th>30 Nov </th>
        <th>01 Dic </th>
        <th>02 Dic </th>
        <th>03 Dic </th>
        <th>04 Dic </th>
        <th>05 Dic </th>
        <th>06 Dic </th>
        <th>Progress</th>
      </tr>
    </thead>
    <tbody>
      <!-- Rows for activities -->
      <tr>
        <td>1</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td></td>
        <!-- ... Add cells for each date -->
        <td>Progress Bar or %</td>
      </tr>
      <!-- Add more rows for each activity -->
    </tbody>
  </table>

  <!-- Include JavaScript for dynamic updates if needed -->
  <script>
    // Add your JavaScript logic here for dynamic updates
  </script>
</body>
</html>
