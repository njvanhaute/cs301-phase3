<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
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
        <a href="welcome.php"><img src="images/me_icon.png" width="75px" style="top:15px; left: 15px; position: absolute;"></a>
        <h1><b>Now Playing</b></h1>
    </div>
    <?php 
      $sql = "SELECT Title FROM MOVIE;";
      $result = mysqli_query($db, $sql);
      echo "<table style='margin: auto; width: 75%;' class='table-bordered'>";
      while ($row_movie = mysqli_fetch_array($result)){
        echo "<tr><td style='font-size: 20px; padding: 10px;'><a>".($row_movie['Title'])."</a></td></tr>";
      }
      echo "<table>";
    ?>
</body>
</html>