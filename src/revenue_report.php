<?php
  // Initialize the session
  error_reporting(0);
  include("config.php");
  header('Content-Type: text/html; charset=iso-8859-1');
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }


  $revenue_sql = "SELECT LEFT(ORDER_DATE, 2) AS MONTH_NO, 9.23 * SUM(Num_Senior_Tickets) AS SENIOR_REV, 8.08 * SUM(Num_Child_Tickets) AS CHILD_REV, 11.54 * SUM(Num_Adult_Tickets) AS ADULT_REV FROM ORDER_ITEM WHERE ORDER_STATUS = \"completed\" GROUP BY MONTH_NO;"; 
  $result = mysqli_query($db, $revenue_sql);
  $row = mysqli_fetch_assoc($result);
  $rev_info = [];
  while (!is_null($row)) {
    array_push($rev_info, $row); // returns date value for that row; 
    $row = mysqli_fetch_assoc($result);
  }

  $totals = [];
  for ($i = 0; $i < 3; $i++) {
    $totals[$i] = $rev_info[$i]["SENIOR_REV"] + $rev_info[$i]["CHILD_REV"] + $rev_info[$i]["ADULT_REV"];
  }

  function month_from_no($no) {
    switch ($no) {
      case "01":
        return "January";
        break;
      case "02":
        return "February";
        break;
      case "03":
        return "March";
        break;
      case "04":
        return "April";
        break;
      case "05":
        return "May";
        break;
      case "06":
        return "June";
        break;
      case "07":
        return "July";
        break;
      case "08":
        return "August";
        break;
      case "09":
        return "September";
        break;
      case "10":
        return "October";
        break;
      case "11":
        return "November";
        break;
      case "12":
        return "December";
        break;
      default:
        return "Error";
    }
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
        <h1><b><?php echo "View Revenue Report" ?></b></h1>
    </div>
    <table style='margin: auto; width: 50%;' class='table-bordered'>
      <tr><th style='font-size: 20px; padding: 10px;'><?php echo month_from_no($rev_info[0]["MONTH_NO"]); ?></th><td style='font-size: 20px; padding: 10px;'><?php echo $totals[0]; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'><?php echo month_from_no($rev_info[1]["MONTH_NO"]); ?></th><td style='font-size: 20px; padding: 10px;'><?php echo $totals[1]; ?></td></tr>
      <tr><th style='font-size: 20px; padding: 10px;'><?php echo month_from_no($rev_info[2]["MONTH_NO"]); ?></th><td style='font-size: 20px; padding: 10px;'><?php echo $totals[2]; ?></td></tr>
    </table><br>
    <br>
    <p>
      <a class="btn btn-danger" href="manager.php" style="width: 150px; font-size: 20px;">Back</a>
    </p>
</body>
</html>
