<?php
  // Initialize the session
  include("config.php");
  header('Content-Type: text/html; charset=iso-8859-1');
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  error_reporting(0);
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  if (isset($_POST['sel'])){
    $_SESSION['oid'] = $_POST['sel'];
    header("location: order_detail.php");
  }

  $uname = $_SESSION["username"];
  $sql = "SELECT * FROM THEATER NATURAL JOIN PREFERS WHERE username = '$uname';";
  $result = mysqli_query($db, $sql);

  if (isset($_POST['rating'])){
    $name = $_POST['rating'];
    $sql = "SELECT Theater_ID FROM THEATER WHERE Name = '$name';";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    $_SESSION['tid'] = $row['Theater_ID'];
    header("location: select_time.php");
  }

  if (isset($_POST['searchval'])){
    $_SESSION['search'] = $_POST['searchval'];
    header("location: search_result.php");
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
        <h1><b>Choose Theater</b></h1>
    </div>
    <form name="choose" action="" method="POST">
      <label>Saved Theater: </label>
      <select name="rating">
        <?php while ($row = mysqli_fetch_array($result)) : ?>
          <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name'];?></option>
        <?php endwhile ?>
      </select>
      <input type="submit" class="btn btn-primary" value="Choose" style="width: 150px; font-size: 20px;">
    </form>
    <h2>-- OR --</h2><br>
    <form name="card" action="" method="POST">
      <input name="searchval" style='margin: auto; width: 50%;' type="text" class="form-control" placeholder="Search by City/State/Theater"><br>
      <a class="btn btn-danger" href="movie.php" style="width: 150px; font-size: 20px;">Back</a>
      <input type="submit" class="btn btn-primary" value="Search" style="width: 150px; font-size: 20px;">
    </form>
</body>
</html>
