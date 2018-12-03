<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  $search_value = $_SESSION['search'];
  $sql = "select * from theater where Name like '%$search_value%' OR Theater_City like '%$search_value%' OR Theater_State like '%$search_value%'";
  $result = mysqli_query($db, $sql);
  
  if (isset($_POST['sel'])){
    $uname = $_SESSION['username'];
    $tid = $_POST['sel'];
    if (isset($_POST['saved'])){
      $sql = "INSERT INTO PREFERS VALUES('$tid', '$uname');";
      $result = mysqli_query($db, $sql);
    }
    $_SESSION['tid'] = $tid;
    header("location: select_time.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Now Playing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b>Results</b></h1>
    </div>
    <form name="choose" action="" method="POST">
      <table style='margin: auto; width: 75%;' class='table-bordered'>
        <tr>
          <th style='font-size: 20px; padding: 10px; text-align: center;'>Select</th>
          <th style='font-size: 20px; padding: 10px; text-align: center;'>Theater</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)) : ?>
          <tr>
            <td style="font-size: 20px; padding: 10px;">
              <input type="radio" name="sel" value="<?php echo $row['Theater_ID']; ?>"></input>
            </td>
            <td><?php echo $row["Name"]."<br>".$row["Theater_Street"]. ", ".$row["Theater_City"].", ".$row["Theater_State"]. ", " . $row["Theater_ZIP"] ; ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
      <div class="form-group">
        <input type="checkbox" name="saved" value="yes"> Save this Theater<br>
        <a class="btn btn-danger" href="buy_ticket.php">Back</a>
        <input type="submit" class="btn btn-primary" value="Next">
      </div>
    </form>
</body>
</html>