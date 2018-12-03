<?php
  // Initialize the session
  include("config.php");
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(empty($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  $uname = $_SESSION['username'];
  $tid = $_SESSION['tid'];
  $movie_name = $_SESSION['title'];
  $format_time = $_SESSION['time'];
  $time = date("H:i", strtotime($format_time));
  $format_date = $_SESSION['date'];
  $date = date("m-d-Y", strtotime($format_date));
  $display_date = date("l, F j", strtotime($date));

  $sql = "SELECT * FROM THEATER WHERE Theater_ID = '$tid'";
  $sql1 = "SELECT * FROM MOVIE WHERE Title = '$movie_name'";
  $result = mysqli_query($db, $sql);
  $result1 = mysqli_query($db, $sql1);
  $tinfo = mysqli_fetch_array($result);
  $row1 = mysqli_fetch_array($result1);
  $sql2 = "SELECT * FROM SYSTEM_INFO;";
  $result2 = mysqli_query($db, $sql2);
  $row2 = mysqli_fetch_array($result2);
  $senior_discount = 1 - $row2['Senior_discount'];
  $child_discount = 1 - $row2['Child_discount'];

  $sql3 = "SELECT * FROM PAYMENT_INFO WHERE username = '$uname' AND Saved = 1;";
  $result3 = mysqli_query($db, $sql3);

  $findmax = "SELECT MAX(Order_ID) AS m FROM ORDER_ITEM;";
  $maxresult = mysqli_query($db, $findmax);
  $row = mysqli_fetch_array($maxresult);
  $oid = $row['m'] + 1;

  $adult_tickets = $_SESSION['adult_tickets'];
  $senior_tickets = $_SESSION['senior_tickets'];
  $child_tickets = $_SESSION['child_tickets'];
  $total_tickets = $adult_tickets + $senior_tickets + $child_tickets;

  $cname_err = "";
  $cnum_err = "";
  $cvv_err = "";
  $exp_err = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['new'])){
      if (empty($_POST['card_name']) || empty($_POST['card_no']) || empty($_POST['cvv']) || empty($_POST['exp_date'])){
        if (empty($_POST['card_name'])){
          $cname_err = 'Enter the name on card.';
        }
        if (empty($_POST['card_no'])){
          $cnum_err = 'Enter the number on card.';
        }
        if (empty($_POST['cvv'])){
          $cvv_err = 'Enter the CVV on card.';
        }
        if (empty($_POST['exp_date'])){
          $exp_err = 'Enter the Expiration Date on card.';
        }
      }
      else{
        $cardno = $_POST['card_no'];
        $cardname = $_POST['card_name'];
        $cvv = $_POST['cvv'];
        $exp_date = $_POST['exp_date'];
        if (isset($_POST['save'])){
          $sql = "INSERT INTO PAYMENT_INFO VALUES('$cardno', '$cvv', '$cardname', '$exp_date', 1, '$uname');";
          mysqli_query($db, $sql);
        }
        else{
          $sql = "INSERT INTO PAYMENT_INFO VALUES('$cardno', '$cvv', '$cardname', '$exp_date', 0, '$uname');";
          mysqli_query($db, $sql);
        }
        $p = "INSERT INTO ORDER_ITEM VALUES('$oid', '$date', '$senior_tickets', '$child_tickets', '$adult_tickets', '$total_tickets', '$time', 'unused', '$cardno', '$uname', '$movie_name', '$tid');";
        mysqli_query($db, $p);
        $_SESSION['oid'] = $oid;
        header("location: confirmation.php");
      }
    }
    else if (isset($_POST['old'])){
      if (isset($_POST['card'])){
        $cardno = $_POST['card'];
        $sql = "SELECT * FROM PAYMENT_INFO WHERE Card_No = '$cardno';";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result);
        $cardname = $row['Name_On_Card'];
        $cvv = $row['CVV'];
        $exp_date = $row['Expiration_Date'];
        $sql1 = "INSERT INTO ORDER_ITEM VALUES('$oid', '$date', '$senior_tickets', '$child_tickets', '$adult_tickets', '$total_tickets', '$time', 'unused', '$cardno', '$uname', '$movie_name', '$tid');";
        mysqli_query($db, $sql1);
        $_SESSION['oid'] = $oid;
        header("location: confirmation.php");
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Ticket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{ width: 500px; padding: 20px; margin: auto;}
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b>Enter Card</b></h1>
    </div>
    <table style='margin: auto; width: 75%;' class='table-bordered'>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $row1['Title'].', '.$row1['Rating'].', '.$row1['Movie_Length'].' minutes'; ?></td></tr>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $display_date; ?></td></tr>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $format_time; ?></td></tr>
      <tr><td style='font-size: 20px; padding: 10px;'><?php echo $tinfo["Name"]."<br>".$tinfo["Theater_Street"]. ", ".$tinfo["Theater_City"].", ".$tinfo["Theater_State"]. ", " . $tinfo["Theater_ZIP"] ; ?></td></tr>
    <table>
    <div class="wrapper">
      <form action="" method="POST">
        <h1>Payment Information</h1>
        <label>Use a saved card: </label>
        <select name="card">
          <?php while ($row = mysqli_fetch_array($result3)) : ?>
            <option value="<?php echo $row['Card_No']; ?>"><?php echo $row['Card_No'];?></option>
          <?php endwhile ?>
        </select><br><br>
        <input type="submit" name='old' class="btn btn-primary" value="Buy Ticket">
      </form>
      <form action="" method="POST"> 
        <h2>Use a new card</h2>
        <label>Name on Card: </label>
        <input type="text" name="card_name" class="form-control">
        <span class="help-block" style="color: red;"><?php echo $cname_err; ?></span>
        <label>Card Number: </label>
        <input type="text" name="card_no" class="form-control">
        <span class="help-block" style="color: red;"><?php echo $cnum_err; ?></span>
        <label>CVV: </label>
        <input type="text" name="cvv" class="form-control">
        <span class="help-block" style="color: red;"><?php echo $cvv_err; ?></span>
        <label>Expiration Date: </label>
        <input type="text" name="exp_date" class="form-control"><br>
        <span class="help-block" style="color: red;"><?php echo $exp_err; ?></span>
        <input type="checkbox" name="save" value="yes"> Save this Card for Later Use<br><br>
        <input type="submit" name="new" class="btn btn-primary" value="Submit">
      </form>
    </div>
</body>
</html>
