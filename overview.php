<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  if ($_POST['title']){
    $_SESSION['title'] = $_POST['title'];
    $movie_title = $_POST['title'];
  }

  else {
    $movie_title = $_SESSION['title'];
  }

  $sql = "SELECT Synopsis, Movie_Cast FROM MOVIE WHERE Title = '$movie_title';";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $movie_synopsis = $row['Synopsis'];
  $movie_cast = $row['Movie_Cast']
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        th{background-color: #f1f1f1;}
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b><?php echo $movie_title ?></b></h1>
    </div>
    <table style='margin: auto; width: 75%;' class=''>
      <tr>
        <th style='font-size: 20px; padding: 10px;'>Synopsis</th>
      </tr>
      <tr>
        <td style='font-size: 20px; padding: 10px;'><?php echo $movie_synopsis; ?></td>
      </tr>
    </table><br>
    <table style='margin: auto; width: 25%;' class=''>
      <tr>
        <th style='font-size: 20px; padding: 10px;'>Cast</th>
      </tr>
      <tr>
        <td style='font-size: 20px; padding: 10px;'>
          <?php 
            $array = explode(", ", $movie_cast); 
            foreach($array as $key => $value){
              echo $value."<br>";
            }
          ?>
        </td>
      </tr>
    </table><br>
    <a class="btn btn-danger" href="movie.php" style="width: 150px; font-size: 20px;">Back</a>
</body>
</html>