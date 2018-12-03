<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $card_num = $_POST['sel'];
    echo "<script type='text/javascript'>alert('$val');</script>";
    $sql = "DELETE FROM PAYMENT_INFO WHERE Card_No = '$card_num';";
    mysqli_query($db, $sql);
    header("location: payment_info.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Payment Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        th {background-color: #f1f1f1;}
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b>My Payment Information</b></h1>
    </div>
    <form name="card" action="" method="POST">
      <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr>
        <th style='font-size: 20px; padding: 10px;'>Select</th>
        <th style='font-size: 20px; padding: 10px;'>Card Number</th>
        <th style='font-size: 20px; padding: 10px;'>Name on Card</th>
        <th style='font-size: 20px; padding: 10px;'>Exp Date</th>
      </tr>
      <?php 
        $uname = $_SESSION["username"];
        $sql = "SELECT Card_No, Name_On_Card, Expiration_Date FROM PAYMENT_INFO WHERE username = '$uname' AND Saved = 1;";
        $result = mysqli_query($db, $sql);
      ?>
      <?php while ($row_movie = mysqli_fetch_array($result)) : ?>
        <tr>
          <td style='font-size: 20px; padding: 10px;'>
            <input type="radio" name="sel" value="<?php echo $row_movie['Card_No']; ?>"></input>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Card_No']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Name_On_Card']; ?>
          </td>
          <td style='font-size: 20px; padding: 10px;'>
            <?php echo $row_movie['Expiration_Date']; ?>
          </td>
        </tr>
      <?php endwhile; ?>
      </table><br>
      <div class="form-group">
          <input type="submit" class="btn btn-danger" value="Delete">
          <a class="btn btn-danger" href="me.php">Back</a>
      </div>
    </form>
</body>
</html>