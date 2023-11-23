<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//important to note that this part is only for development environments

function pdo_connect_mysql(){

  $DATABASE_HOST = '64.226.72.83';
  $DATABASE_USER = 'admin';
  $DATABASE_PASS = '3626400eeb94cdea37cbe094656a925668fa0f94797fa148';
  $DATABASE_NAME = 'WhiskerWork';

  
  try{
    return new PDO('mysql:host='. $DATABASE_HOST.';dbname='. $DATABASE_NAME. ';charset=utf8mb4', $DATABASE_USER, $DATABASE_PASS);
    
  } catch (PDOException $e) {
    $error = ''. $e->getMessage();
    echo 'wtf';
    exit ($error);
  }
}
function fetchTasks(){
  $pdo = pdo_connect_mysql();
  $stmt = $pdo -> query('SELECT * FROM gant');
  $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

$tasks = fetchTasks();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gantt Chart</title>

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
        <th>Activity</th>
        <th>Starting Date</th>
        <th>Final Date</th>
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
        <th>01 Dec </th>
        <th>02 Dec </th>
        <th>03 Dec </th>
        <th>04 Dec </th>
        <th>05 Dec </th>
        <th>06 Dec </th>
        <th>Progress</th>
      </tr>
    </thead>
      <?php foreach ($tasks as $task):?>
        <tbody>
          <tr>
          <td>1</td>
          <td>Start Date</td>
          <td>End Date</td>
          <td></td>
          <td>Progress Bar or %</td>
          </tr>
        </tbody>
      <?php endforeach; ?>
      
  </table>

  <!-- Include JavaScript for dynamic updates if needed -->
  <script>
    // Add your JavaScript logic here for dynamic updates
  </script>
</body>
</html>
