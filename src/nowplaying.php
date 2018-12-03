<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

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
    <title>Now Playing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <a href="me.php"><img src="images/me_icon.png" width="75px" style="top:15px; left: 15px; position: absolute;"></a>
        <h1><b>Now Playing</b></h1>
    </div>
    <table style='margin: auto; width: 75%;' class=''>
    <?php 
        $sql = "SELECT Title FROM MOVIE;";
        $result = mysqli_query($db, $sql);
        $num = 1;
        while ($row_movie = mysqli_fetch_array($result)){
          $m = $row_movie['Title'];
          if (fmod($num, 2)){echo "</tr>\n";}
          echo 
            "<td style='font-size: 20px; padding: 10px;'>
              <form method='POST' action='movie.php'>
                <input style='font-size: 20px; width: 500px;' type='submit' class='btn btn-primary' name='title' value='$m'/>
              </form>
            </td>\n";
          if (!fmod($num, 2)){echo "</tr>";}
          $num++;
        }
      ?>
    </table>
</body>
</html>