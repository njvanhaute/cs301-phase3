<?php
  // Initialize the session
  include("config.php");
  header('Content-Type: text/html; charset=iso-8859-1');
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  error_reporting(0);
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
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
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b>Me</b></h1>
    </div>
    <a href="order_history.php" class="btn btn-primary" style="width: 400px; font-size: 30px;">My Order History</a><br><br>
    <a href="payment_info.php" class="btn btn-primary" style="width: 400px; font-size: 30px;">My Payment Information</a><br><br>
    <a href="pref_theater.php" class="btn btn-primary" style="width: 400px; font-size: 30px;">My Preferred Theater</a><br><br>
    <p>
      <a class="btn btn-danger" href="logout.php" style="width: 150px; font-size: 20px;">Log Out</a>
      <a class="btn btn-danger" href="nowplaying.php" style="width: 150px; font-size: 20px;">Back</a>
    </p>
</body>
</html>
