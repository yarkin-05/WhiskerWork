<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//important to note that this part is only for development environments

$msg = '';
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

function fetchTasks(){
  $pdo = pdo_connect_mysql();
  $stmt = $pdo -> query('SELECT * FROM gant');
  $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
  if ($result === false){
    return [];
  }
  return $result;
}

$tasks = fetchTasks();
$msg = $tasks;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gantt Chart</title>
  <link rel="icon" type="image/x-icon" href="images/logo_patita.png">


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
      </tr>
    </thead>
      <?php foreach ($tasks as $task):?>
        
        <tbody>
          <tr>
              <?php foreach ($task as $key => $t): ?>
                <?php if ($key != 'id'): ?>
                  <?php if ($t == '1') :?>
                    <td style = 'background-color: green'>
                    </td>
                  <?php elseif($t == '0'):?>
                    <td style = 'background-color: white;'>
                    </td>
                  <?php else :?>
                  <td> <?=$t?> </td>
                  <?php endif ; ?>
                    
                <?php endif; ?>
            <?php endforeach; ?>
          </tr>
        </tbody>
      <?php endforeach; ?>
      
  </table>
  <a href="form.php" class="button">New Entry</a>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous">

  </script>
  <script>
   
  </script>
</body>
</html>