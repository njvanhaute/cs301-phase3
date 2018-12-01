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
    <title>Order History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
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
        <td style='font-size: 20px; padding: 10px;'><strong>Select</strong></th>
        <td style='font-size: 20px; padding: 10px;'><strong>Order ID</strong></th>
        <td style='font-size: 20px; padding: 10px;'><strong>Movie</strong></th>
        <td style='font-size: 20px; padding: 10px;'><strong>Status</strong></th>
        <td style='font-size: 20px; padding: 10px;'><strong>Total Cost</strong></th>
      </tr>
      <?php 
        $dsql = "SELECT Child_discount, Senior_discount FROM SYSTEM_INFO;";
        $dresult = mysqli_query($db, $dsql);
        $drow = mysqli_fetch_array($dresult);
        $senior_discount = 1 - $drow["Senior_discount"];
        $child_discount = 1 - $drow["Child_discount"];
        $ticket_cost = 11.54;
        $uname = $_SESSION["username"];
        $sql = "SELECT Num_Senior_Tickets, Num_Child_Tickets, Num_Adult_Tickets, Order_ID, Title, Order_Status FROM ORDER_ITEM WHERE username = '$uname';";
        $result = mysqli_query($db, $sql);
      ?>
      <?php while ($row_movie = mysqli_fetch_array($result)) : ?>
        <tr>
          <td style='font-size: 20px; padding: 10px;'>
            <input type="radio" name="sel" value="<?php echo $row_movie['Order_ID']; ?>"></input>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Order_ID']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Title']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Order_Status']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php 
              $total_cost = ($ticket_cost * $row_movie['Num_Adult_Tickets']) + ($senior_discount * $ticket_cost * $row_movie['Num_Senior_Tickets']) + ($child_discount * $ticket_cost * $row_movie['Num_Child_Tickets']); 
              echo "$".bcdiv($total_cost, 1, 2);  
            ?>
          </td>
        </tr>
      <?php endwhile; ?>
      </table><br>
      <div class="form-group">
          <a class="btn btn-danger" href="me.php">Back</a>
          <input type="submit" class="btn btn-primary" value="View Detail">
      </div>
    </form>
</body>
</html>