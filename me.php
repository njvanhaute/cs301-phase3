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
    <a><h2>My Order History</h2></a>
    <a href="payment_info.php"><h2>My Payment Information</h2></a>
    <a><h2>My Preferred Theater</h2></a><br>
    <p>
      <a href="logout.php" class="btn btn-danger">Log Out</a>
      <a href="nowplaying.php" class="btn btn-danger">Back</a>
    </p>
</body>
</html>