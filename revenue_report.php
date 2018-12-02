<?php
  // Initialize the session
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }


  $adult_cost = 11.54;
  $senior_cost = 9.23;
  $child_cost = 8.08;

  $months_sql = "SELECT ORDER_DATE FROM ORDER_ITEM;"; 
  $result = mysqli_query($db, $months_sql);
  $months = [];
  $row = mysqli_fetch_assoc($result);
  $result["ORDER_DATE"] // returns date value for that row; 
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
      <tr><th style='font-size: 20px; padding: 10px;'>Release Date</th><td style='font-size: 20px; padding: 10px;'><?php echo $movie_date; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Rating</th><td style='font-size: 20px; padding: 10px;'><?php echo $movie_rating; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Length</th><td style='font-size: 20px; padding: 10px;'><?php echo $movie_length; ?> minutes</td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Genre</th><td style='font-size: 20px; padding: 10px;'><?php echo $movie_genre; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Average Rating</th><td style='font-size: 20px; padding: 10px;'><?php echo bcdiv($movie_avg, 1, 1); ?>/5 stars</td></tr>
    </table><br>
    <br>
    <p>
      <a class="btn btn-primary" href="overview.php" style="width: 150px; font-size: 20px;">Overview</a>
      <a class="btn btn-primary" href="review.php" style="width: 150px; font-size: 20px;">Movie Review</a>
      <a class="btn btn-primary" href="ticket.php" style="width: 150px; font-size: 20px;">Buy Ticket</a>
    </p>
</body>
</html>
