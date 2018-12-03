<?php
  // Initialize the session
  include("config.php");
  header('Content-Type: text/html; charset=iso-8859-1');
  error_reporting(0);
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
        <h1><b>Choose Functionality</b></h1>
    </div>
    <p><a class="btn btn-primary" href="revenue_report.php" style="font-size: 20px;">View Revenue Report</a></p>
    <p><a class="btn btn-primary" href="pop_movie_report.php" style="font-size: 20px;">View Popular Movie Report</a></p>
</body>
</html>
