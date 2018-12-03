<?php
  // Initialize the session
  include("config.php");
  header('Content-Type: text/html; charset=iso-8859-1');
  session_start();
  error_reporting(0);
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  $tid = $_SESSION['tid'];
  $movie_name = $_SESSION['title'];
  $format_time = $_SESSION['time'];
  $time = date("H:i", strtotime($format_time));
  $format_date = $_SESSION['date'];
  $date = date("m-d-Y", strtotime($format_date));
  $display_date = date("l, F j", strtotime($format_date));

  $sql = "SELECT * FROM THEATER WHERE Theater_ID = '$tid'";
  $sql1 = "SELECT * FROM MOVIE WHERE Title = '$movie_name'";
  $result = mysqli_query($db, $sql);
  $result1 = mysqli_query($db, $sql1);
  $row = mysqli_fetch_array($result);
  $row1 = mysqli_fetch_array($result1);
  $sql2 = "SELECT * FROM SYSTEM_INFO;";
  $result2 = mysqli_query($db, $sql2);
  $row2 = mysqli_fetch_array($result2);
  $senior_discount = 1 - $row2['Senior_discount'];
  $child_discount = 1 - $row2['Child_discount'];
  $ticket_err = "";

  if (isset($_POST['adult_tickets'])){
    $total = $_POST['adult_tickets'] + $_POST['senior_tickets'] + $_POST['child_tickets'];
    if ($total > 0){
      $_SESSION['adult_tickets'] = $_POST['adult_tickets'];
      $_SESSION['senior_tickets'] = $_POST['senior_tickets'];
      $_SESSION['child_tickets'] = $_POST['child_tickets'];
      header("location: enter_card.php");
    }
    else {$ticket_err = "You must purchase at least one ticket.";}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Ticket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b>Buy Ticket</b></h1>
    </div>
    <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $row1['Title'].', '.$row1['Rating'].', '.$row1['Movie_Length'].' minutes'; ?></td></tr>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $display_date; ?></td></tr>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $format_time; ?></td></tr>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $row["Name"]."<br>".$row["Theater_Street"]. ", ".$row["Theater_City"].", ".$row["Theater_State"]. ", " . $row["Theater_ZIP"] ; ?></td></tr>
    <table>
    <form name="choose" action="" method="POST">
      <h1>How many tickets?</h1><br>
      <label>Adult Matinee:&nbsp;</label>
      <select name="adult_tickets">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select><br><br>
      <label>Senior:&nbsp;</label>
      <select name="senior_tickets">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select><br><br>
      <label>Child:&nbsp;</label>
      <select name="child_tickets">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select><br>
      <span class="help-block" style="color: red;"><?php echo $ticket_err; ?></span>
      <div class="form-group">
        <a class="btn btn-danger" href="select_time.php" style="">Back</a>
        <input type="submit" class="btn btn-primary" value="Next">
      </div>
    </form>
</body>
</html>
