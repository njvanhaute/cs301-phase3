<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  error_reporting(0);
  header('Content-Type: text/html; charset=iso-8859-1'); 
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  if (isset($_POST['sel'])){
    $_SESSION['oid'] = $_POST['sel'];
    header("location: order_detail.php");
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
    <script>
      function myFunction() {
        // Declare variables 
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          } 
        }
      }
    </script>
</head>
<body>
    <div class="page-header">
        <a href="me.php"><img src="images/me_icon.png" width="75px" style="top:15px; left: 15px; position: absolute;"></a>
        <h1><b>Order History</b></h1>
    </div>
    <form name="card" action="" method="POST">
      <input style='margin: auto; width: 75%;' type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for Order ID..."><br>
      <table style='margin: auto; width: 75%;' class='table-bordered' id="myTable">
      <tr class="header">
        <th style='font-size: 20px; padding: 10px;'>Select</th>
        <th style='font-size: 20px; padding: 10px;'>Order ID</th>
        <th style='font-size: 20px; padding: 10px;'>Title</th>
        <th style='font-size: 20px; padding: 10px;'>Status</th>
        <th style='font-size: 20px; padding: 10px;'>Total Cost</th>
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
              if ($row_movie['Order_Status'] == 'cancelled'){
                $total_cost = $total_cost - 5;
              }
              echo "$".bcdiv($total_cost, 1, 2);  
            ?>
          </td>
        </tr>
      <?php endwhile; ?>
      </table><br>
      <div class="form-group">
        <a class="btn btn-danger" href="me.php" style="width: 150px; font-size: 20px;">Back</a>
        <input type="submit" class="btn btn-primary" value="View Detail" style="width: 150px; font-size: 20px;">
      </div>
    </form>
</body>
</html>
