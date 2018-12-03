<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  $tid = $_SESSION['tid'];
  $movie_name = $_SESSION['title'];

  $sql = "SELECT Showtime FROM SHOWTIME NATURAL JOIN THEATER WHERE Theater_ID = '$tid' AND Title = '$movie_name';";
  $result = mysqli_query($db, $sql);

  if (isset($_POST['time'])){
    if (isset($_POST['date'])){
      $_SESSION['time'] = $_POST['time'];
      $_SESSION['date'] = $_POST['date'];
      header("location: num_tickets.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Now Playing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b>Select Time</b></h1>
    </div>
    <form name="choose" action="" method="POST">
      <label>Choose a date: </label>
      <input type="date" name="date"><br>
      <table style='margin: auto; width: 75%;' class='table-bordered'>
        <tr>
          <th style='font-size: 20px; padding: 10px; text-align: center;'>Showtime</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)) : ?>
          <tr>
            <td style="font-size: 20px; padding: 10px;"><input style='font-size: 20px; width: 500px;' type='submit' class='btn btn-primary' name='time' value="<?php $time = date('g:ia', strtotime($row['Showtime']));  echo $time; ?>"/></td>
          </tr>
        <?php endwhile; ?>
      </table>
    </form>
</body>
</html>