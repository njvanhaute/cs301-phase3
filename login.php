<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      $sql_customer = "SELECT Username FROM CUSTOMER WHERE Username = '$myusername' AND Password_Customer = '$mypassword'";
      $result_customer = mysqli_query($db, $sql_customer);
      $row_customer = mysqli_fetch_array($result_customer, MYSQLI_ASSOC);
      $active_customer = $row_customer['active'];

      $sql_manager = "SELECT Username FROM MANAGER WHERE Username = '$myusername' AND Password_Manager = '$mypassword'";
      $result_manager = mysqli_query($db, $sql_manager);
      $row_manager = mysqli_fetch_array($result_manager, MYSQLI_ASSOC);
      $active_manager = $row_manager['active'];

      $count_customer = mysqli_num_rows($result_customer);
      $count_manager = mysqli_num_rows($result_manager);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if ($count_customer == 1){
        $_SESSION['login_user'] = $myusername;
        $_SESSION['user_type'] = 'customer';
        header("location: welcome.php");
      }
      if ($count_manager == 1){
        $_SESSION['login_user'] = $myusername;
        $_SESSION['user_type'] = 'manager';
        header("location: welcome.php");
      }
      else {
        $message = "Incorrect Username/Password";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UAMovie Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="" method="POST">
          <label>Username</label>
          <input type="text" name="username" class="form-control">
          <span class="help-block"><?php echo $username_err; ?></span>  
          <label>Password</label>
          <input type="password" name="password" class="form-control">
          <span class="help-block"><?php echo $password_err; ?></span>
          <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Login">
          </div>
          <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>