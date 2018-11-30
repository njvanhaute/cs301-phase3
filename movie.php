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

  $sql = "SELECT Release_Date, Rating, Movie_Length, Movie_Genre FROM MOVIE WHERE Title = '$movie_title';";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $movie_date = $row['Release_Date'];
  $movie_rating = $row['Rating'];
  $movie_length = $row['Movie_Length'];
  $movie_genre = $row['Movie_Genre'];

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
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b><?php echo $movie_title ?></b></h1>
    </div>
    <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr><th style='font-size: 20px; padding: 10px;'>Release Date</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_date; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Rating</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_rating; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Length</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_length; ?> minutes</td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Genre</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_genre; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Average Rating</td><td style='font-size: 20px; padding: 10px;'><?php echo bcdiv($movie_avg, 1, 1); ?>/5 stars</td></tr>
    </table><br>
    <p>
      <a class="btn btn-primary" href="overview.php" style="width: 150px; font-size: 20px;">Overview</a>
      <a class="btn btn-primary" href="review.php" style="width: 150px; font-size: 20px;">Movie Review</a>
      <a class="btn btn-primary" href="ticket.php" style="width: 150px; font-size: 20px;">Buy Ticket</a>
    </p>
</body>
</html>