<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
  
  if (isset($_POST['submit'])){
    $oid = $_SESSION['oid'];
    $sql = "SELECT Order_Status FROM ORDER_ITEM WHERE Order_ID = '$oid';";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    $status = $row['Order_Status'];
    if ($status == 'unused'){
      $sql1 = "UPDATE ORDER_ITEM SET Order_Status = 'cancelled' WHERE Order_ID = '$oid';";
      mysqli_query($db, $sql1);
      header("location: order_history.php");
    }
    else{
      $submit_err = "This order has already been ".$status."!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        th {background-color: #f1f1f1;}
    </style>
</head>
<body>
    <div class="page-header">
        <a href="me.php"><img src="images/me_icon.png" width="75px" style="top:15px; left: 15px; position: absolute;"></a>
        <h1><b>Order History</b></h1>
    </div>
    <form name="card" action="" method="POST">
      <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr>
        <th style='font-size: 20px; padding: 10px;'><strong>Movie</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Order Date</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Order Time</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Theater Name</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Adult Tickets</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Child Tickets</strong></th>
        <th style='font-size: 20px; padding: 10px;'><strong>Senior Tickets</strong></th>
      </tr>
      <?php 
        $order_id = $_SESSION['oid'];
        $sql = "SELECT Title, Order_Status, Order_Date, Order_Time, Num_Senior_Tickets, Num_Child_Tickets, Num_Adult_Tickets, Name, Theater_State, Theater_City, Theater_Street, Theater_ZIP FROM ORDER_ITEM NATURAL JOIN THEATER WHERE Order_ID = '$order_id';";
        $result = mysqli_query($db, $sql);
        $sql1 = "SELECT Rating, Movie_Length, Num_Adult_Tickets, Num_Senior_Tickets, Num_Child_Tickets FROM MOVIE NATURAL JOIN ORDER_ITEM WHERE Order_ID = '$order_id';";
        $result1 = mysqli_query($db, $sql1);
        $dsql = "SELECT Child_discount, Senior_discount FROM SYSTEM_INFO;";
        $dresult = mysqli_query($db, $dsql);
        $drow = mysqli_fetch_array($dresult);
        $senior_discount = 1 - $drow["Senior_discount"];
        $child_discount = 1 - $drow["Child_discount"];
        $ticket_cost = 11.54;
      ?>
      <?php while ($row = mysqli_fetch_array($result)) : ?>
      <?php while ($row1 = mysqli_fetch_array($result1)) : ?>
        <tr>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row['Title']."<br>".$row1['Rating'].', '.$row1['Movie_Length'].' minutes'; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row['Order_Date']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row['Order_Time']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row['Name'].'<br>'.$row['Theater_Street']."<br>".$row['Theater_City'].', '.$row['Theater_State'].' '.$row['Theater_ZIP']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php 
              $cost = bcdiv($row1['Num_Adult_Tickets'] * $ticket_cost, 1, 2);
              echo $row1['Num_Adult_Tickets'].' Adult Tickets: $'.$cost."<br>"; 
            ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php 
              $cost = bcdiv($row1['Num_Child_Tickets'] * $ticket_cost * $child_discount, 1, 2);
              echo $row1['Num_Child_Tickets'].' Child Tickets: $'.$cost."<br>"; 
            ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php 
              $cost = bcdiv($row1['Num_Senior_Tickets'] * $ticket_cost * $senior_discount, 1, 2);
              echo $row1['Num_Senior_Tickets'].' Senior Tickets: $'.$cost."<br>"; 
            ?>
          </td>
        </tr>
      <?php endwhile; ?>
      <?php endwhile; ?>
      </table><br>
      <div class="form-group">
          <a class="btn btn-danger" href="order_history.php">Back</a>
          <input type="submit" name="submit" class="btn btn-danger" value="Cancel This Order">
      </div>
      <span class="help-block" style="color: red;"><?php echo $submit_err; ?></span>
    </form>
</body>
</html>