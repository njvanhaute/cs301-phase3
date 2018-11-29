<?php
  // Initialize the session
  include("config.php");
  session_start();
  
  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: welcome.php");
      exit;
  }
  
  // Include config file
  require_once "config.php";
  
  // Define variables and initialize with empty values
  $username = $password = "";
  $username_err = $password_err = "";
  
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
      // Check if username is empty
      if(empty(trim($_POST["username"]))){
          $username_err = "Please enter username.";
      } else{
          $username = trim($_POST["username"]);
      }
      
      // Check if password is empty
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter your password.";
      } else{
          $password = trim($_POST["password"]);
      }
      
      // Check if Manager
      if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT Username, Email, Password_Manager FROM MANAGER WHERE Username = ? AND Password_Manager = ?";
        
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              // Store result
              mysqli_stmt_store_result($stmt);
              
              // Check if username exists, if yes then verify password
              if(mysqli_stmt_num_rows($stmt) == 1){                    
                session_start();
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;  
                $_SESSION["type"] = 'manager';                          
                
                // Redirect user to welcome page
                header("location: welcome.php");
              } 
            }
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
      }

      // Check if Customer
      if(empty($username_err) && empty($password_err)){
          // Prepare a select statement
          $sql = "SELECT Username, Email, Password_Customer FROM CUSTOMER WHERE Username = ? AND Password_Customer = ?";
          
          if($stmt = mysqli_prepare($db, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
              
              // Set parameters
              $param_username = $username;
              $param_password = $password;
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Store result
                  mysqli_stmt_store_result($stmt);
                  
                  // Check if username exists, if yes then verify password
                  if(mysqli_stmt_num_rows($stmt) == 1){                    
                    session_start();
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;  
                    $_SESSION["type"] = 'customer';                          
                    
                    // Redirect user to welcome page
                    header("location: nowplaying.php");
                  } else{
                      // Display an error message if username doesn't exist
                      $username_err = "Incorrect Username/Password.";
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }
          }
          
          // Close statement
          mysqli_stmt_close($stmt);
      }
      
      // Close connection
      mysqli_close($db);
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
          <span class="help-block" style="color: red;"><?php echo $username_err; ?></span>  
          <label>Password</label>
          <input type="password" name="password" class="form-control">
          <span class="help-block" style="color: red;"><?php echo $password_err; ?></span>
          <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Login">
          </div>
          <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>