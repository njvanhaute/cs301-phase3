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

  $movie_title = $_SESSION['title'];

  $sql_avg = "SELECT AVG(Rating) AS average FROM REVIEW WHERE Title = '$movie_title';";
  $result_avg = mysqli_query($db, $sql_avg);
  $row_avg = mysqli_fetch_assoc($result_avg);
  $movie_avg = $row_avg['average'];
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        th {background-color: #f1f1f1;}
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b><?php echo $movie_title ?></b></h1>
        <h3>Average Rating: <?php echo bcdiv($movie_avg, 1, 1); ?></h3>
    </div>
    <a class="btn btn-primary" href="give_review.php" style="width: 200px; font-size: 20px;">Leave a Review</a><br><br>
    <?php 
      $sql = "SELECT Rating, Comments FROM REVIEW WHERE Title = '$movie_title';";
      $result = mysqli_query($db, $sql);
    ?>
    <?php while ($row_movie = mysqli_fetch_array($result)) : ?>
    <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr>
        <th style='font-size: 20px; padding: 10px;'>
          Title
        </th>
        <td style='font-size: 20px; padding: 10px;'>
          <?php echo $movie_title ?>
        </td>
      </tr>
        <th style='font-size: 20px; padding: 10px;'>
          Rating
        </th>
        <td style='font-size: 20px; padding: 10px;'>
          <?php echo $row_movie['Rating']; ?>
        </td>
      </tr>
        <th style='font-size: 20px; padding: 10px;'>
          Comments
        </th>
        <td style='font-size: 20px; padding: 10px;'>
          <?php echo $row_movie['Comments']; ?>
        </td>
      </tr>
    </table><br>
    <?php endwhile; ?>
    <a class="btn btn-danger" href="movie.php" style="width: 150px; font-size: 20px;">Back</a>
</body>
</html>
