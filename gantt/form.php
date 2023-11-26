<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function pdo_connect_mysql(){

  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = 'root';
  $DATABASE_NAME = 'whiskerwork';

  
  try{
    return new PDO('mysql:host='. $DATABASE_HOST.';dbname='. $DATABASE_NAME. ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    
  } catch (PDOException $e) {
    $error = ''. $e->getMessage();
    exit ($error);
  }
}

if(isset($_POST['name']) and isset($_POST['difference']) and isset($_POST['start']) and isset($_POST['final'])){

  $pdo = pdo_connect_mysql();

  //info
  $name = $_POST['name'];
  $start = $_POST['start'];
  $final = $_POST['final'];
  $difference = $_POST['difference'];

  //start constructing the sql query
  $sql = "INSERT INTO gant (descriptions, starts, final";

  $startDateTime = new DateTime($start);
  $endDateTime = new DateTime($final);
  $placeholders = "";
  
  for ($i = 0; $i < $difference ; $i++){
    $columnName = $startDateTime->format('Md');
    //var_dump($columnName);
    $sql .= ", `$columnName`";
    $placeholders .= ", ?";
    $startDateTime->modify('+1 day');
  }
  
  $sql .= ") VALUES (?,?,?" . $placeholders . ")";

  $stmt = $pdo->prepare($sql);

  //format dates in a way the table wants
  $formatted_start_time = date('Y-m-d', strtotime($_POST['start'])); 
  $formatted_final_time = date('Y-m-d', strtotime($_POST['final']));

  $values = [$name, $formatted_start_time, $formatted_final_time];
    
  for($i = 0 ; $i < $difference ; $i++){

    $values[] = 1;
  }
    

  foreach ($values as $value){
   // var_dump("value: " . $value); // Output $values to ensure the number of variables matches placeholders
  }
    
   // Execute the statement
  if ($stmt->execute($values)) {
    // If execution is successful, perform actions here
    //echo "Data inserted successfully!";
    header('Location: grantt.php');
    exit;
  } else {
    // If there's an error during execution, handle it here
    $errorInfo = $stmt->errorInfo(); // Fetch error information

    // Log or display the error message
    echo "Error: " . $errorInfo[2]; 
  }
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method='post'>
    <input type='text' placeholder="Input Task's name please" id='name' name='name'>
    <input type="date" id="start" name="start" placeholder="dd/mm/yy" min="2023-11-21" max="2023-12-06" />
    <input type="date" id="final" name="final" placeholder="dd/mm/yy"" min="2023-11-21" max="2023-12-06" />
    <button type="submit" id="submit"> Submit Entry </button>
    </form>
  
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <script>
    $('#submit').click(function(e) {
      e.preventDefault();
      let name = $('#name').val();
      let start = new Date($('#start').val());
      let final = new Date($('#final').val());

      //testing dates
      //console.log(start);
      //console.log(final);
      
      let startDate = new Date(2023, 10, 20); // November is represented as 10 (0-indexed) in JavaScript
      let finalDate = new Date(2023, 11, 6); // December is represented as 11
      

      if (start >= startDate && final <= finalDate) {
        //difference in milliseconds, then divide it by the amount of milliseconds in a day, floor is to round
        let differenceInDays = Math.floor((final - start) / (1000 * 60 * 60 * 24));
        differenceInDays++;
        console.log("difference: " + differenceInDays);


        start = start.toUTCString();
        final = final.toUTCString();
        let start_clean = start.replace(/GMT.*$/, '');
        let final_clean = final.replace(/GMT.*$/, '');


        $.ajax({
          type: 'POST',
          url : 'form.php',
          data: {
            'name' : name,
            'difference' : differenceInDays,
            'start' :start,
            'final' : final,
          },
          success: function(msg){
            console.log(msg);
            window.location.href = 'grantt.php';
          },error:function(error){
            console.log(error);
          }
        });


      } else {
        console.log('Dates are not within the valid range.');

      }

    });
  </script>
</body>
</html>