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

  $top_sellers_sql = "select Title, MONTH_NO, SUMTOT from ( select Title, MONTH_NO, SUMTOT, (@rn:=if(@prev = MONTH_NO, @rn +1, 1)) as rownumb, @prev:= MONTH_NO from ( select Title, MONTH_NO, SUM(Num_Total_Tickets) AS SUMTOT from ORDER_ITEM_W_MONTH where Order_Status <> \"cancelled\" GROUP BY Title, MONTH_NO order by MONTH_NO, SUMTOT desc, Title ) as sortedlist JOIN (select @prev:=NULL, @rn :=0) as vars ) as groupedlist where rownumb<=3 order by MONTH_NO, SUMTOT desc, Title;"; 
  $result = mysqli_query($db, $top_sellers_sql);
  $month_info = [];
  $row = mysqli_fetch_assoc($result);
  $row["ORDER_DATE"]; // Returns date value for that row;
  $row["TITLE"]; // Returns most popular movie titles
  $row["NUM_TOTAL_TICKETS"]; // Returns total number of tickets ordered

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
        <h1><b><?php echo "View Popular Movie Report" ?></b></h1>
    </div>
    <table style='margin: auto; width: 50%;' class='table-bordered'>
      <tr>
        <th style='font-size: 20px; padding: 10px;'><?php echo month_from_no($rev_info[0]["MONTH_NO"]); ?></th>
        <th style='font-size: 20px; padding: 10px;'><?php echo "Movie"; ?></th>
        <th style='font-size: 20px; padding: 10px;'><?php echo "#of Orders"; ?></th>
      </tr>
      <tr>
        
      </tr>
    </table><br>
    <br>
    <p>
      <a class="btn btn-primary" href="overview.php" style="width: 150px; font-size: 20px;">Overview</a>
      <a class="btn btn-primary" href="review.php" style="width: 150px; font-size: 20px;">Movie Review</a>
      <a class="btn btn-primary" href="ticket.php" style="width: 150px; font-size: 20px;">Buy Ticket</a>
    </p>
</body>
</html>
