<?php
  // Initialize the session
  include("config.php");
  session_start();
  error_reporting(0);
  header('Content-Type: text/html; charset=iso-8859-1');
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tid = $_POST['sel'];
    $uname = $_SESSION['username'];
    echo "<script type='text/javascript'>alert('$tid');</script>";
    $sql = "DELETE FROM PREFERS WHERE Theater_ID = '$tid' AND username = '$uname';";
    mysqli_query($db, $sql);
    header("location: pref_theater.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Preferred Theater</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        th {background-color: #f1f1f1;}
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b>My Preferred Theater</b></h1>
    </div>
    <form name="card" action="" method="POST">
      <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr>
        <th style='font-size: 20px; padding: 10px;'><strong>Select</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Name</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Address</strong></th>
      </tr>
      <?php 
        $uname = $_SESSION["username"];
        $sql = "SELECT Theater_ID, Name, Theater_State, Theater_City, Theater_Street, Theater_Zip FROM THEATER NATURAL JOIN PREFERS WHERE username = '$uname';";
        $result = mysqli_query($db, $sql);
      ?>
      <?php while ($row_movie = mysqli_fetch_array($result)) : ?>
        <tr>
          <td style='font-size: 20px; padding: 10px;'>
            <input type="radio" name="sel" value="<?php echo $row_movie['Theater_ID']; ?>"></input>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Name']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Theater_Street'].', '.$row_movie['Theater_City'].', '.$row_movie['Theater_State'].', '.$row_movie['Theater_Zip'] ?>
          </td>
        </tr>
      <?php endwhile; ?>
      </table><br>
      <div class="form-group">
        <a class="btn btn-danger" href="me.php" style="width: 150px; font-size: 20px;">Back</a>
        <input type="submit" class="btn btn-danger" value="Delete" style="width: 150px; font-size: 20px;">
      </div>
    </form>
</body>
</html>
