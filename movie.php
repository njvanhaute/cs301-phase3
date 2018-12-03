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
  
  if ($movie_title == 'Beautiful Boy'){
    $img = 'images/beautiful_boy.jpg';
  }
  if ($movie_title == 'Bohemian Rhapsody'){
    $img = 'images/bohemian_rhapsody.jpg';
  }
  if ($movie_title == 'Boy Erased'){
    $img = 'images/boy_erased.jpg';
  }
  if ($movie_title == 'Creed II'){
    $img = 'images/creed_ii.jpg';
  }
  if ($movie_title == 'Fantastic Beasts: The Crimes of Grindelwald'){
    $img = 'images/fantastic_beasts.jpg';
  }
  if ($movie_title == 'The Front Runner'){
    $img = 'images/front_runner.jpg';
  }
  if ($movie_title == "Dr. Seuss’ The Grinch"){
    $img = 'images/grinch.jpg';
  }
  if ($movie_title == 'Instant Family'){
    $img = 'images/instant_family.jpg';
  }
  if ($movie_title == 'The Nutcracker and the Four Realms'){
    $img = 'images/nutcracker.jpg';
  }
  if ($movie_title == 'Ralph Breaks the Internet'){
    $img = 'images/ralph.jpg';
  }
  if ($movie_title == 'Robin Hood'){
    $img = 'images/robin_hood.jpg';
  }
  if ($movie_title == 'Smallfoot'){
    $img = 'images/smallfoot.jpg';
  }
  if ($movie_title == 'A Star is Born'){
    $img = 'images/star_is_born.jpg';
  }
  if ($movie_title == 'Venom'){
    $img = 'images/venom.jpg';
  }
  if ($movie_title == 'Widows'){
    $img = 'images/widows.jpg';
  }

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
    </div>
    <?php echo "<img src='$img' style='padding-bottom: 20px;'/>"; ?>
    <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr><th style='font-size: 20px; padding: 10px;'>Release Date</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_date; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Rating</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_rating; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Length</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_length; ?> minutes</td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Genre</td><td style='font-size: 20px; padding: 10px;'><?php echo $movie_genre; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'>Movie Average Rating</td><td style='font-size: 20px; padding: 10px;'><?php echo bcdiv($movie_avg, 1, 1); ?>/5 stars</td></tr>
    </table><br>
    <p>
      <a class="btn btn-danger" href="nowplaying.php" style="width: 150px; font-size: 20px;">Back</a>
      <a class="btn btn-primary" href="overview.php" style="width: 150px; font-size: 20px;">Overview</a>
      <a class="btn btn-primary" href="review.php" style="width: 150px; font-size: 20px;">Movie Review</a>
      <a class="btn btn-primary" href="buy_ticket.php" style="width: 150px; font-size: 20px;">Buy Ticket</a>
    </p>
</body>
</html>