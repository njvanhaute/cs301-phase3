<?php
  // Include config file
  include("config.php");
  session_start();
  header('Content-Type: text/html; charset=iso-8859-1'); 
  // Define variables and initialize with empty values
  error_reporting(0);
  $username = $email = $password = $confirm_password = $manager_password = "";
  $username_err = $email_err = $password_err = $confirm_password_err =  $manager_password_err = "";
  
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
      // Validate username
      if(empty(trim($_POST["username"]))){
          $username_err = "Please enter a username.";
      } else{
          // Prepare a select statement
          $sql = "SELECT Username FROM CUSTOMER WHERE Username = ?";
          
          if($stmt = mysqli_prepare($db, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_username);
              
              // Set parameters
              $param_username = trim($_POST["username"]);

              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  /* store result */
                  mysqli_stmt_store_result($stmt);
                  
                  if(mysqli_stmt_num_rows($stmt) == 1){
                      $username_err = "This username is already taken.";
                  } else{
                      $username = trim($_POST["username"]);
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }
          }
          
          // Close statement
          mysqli_stmt_close($stmt);
      }

      // Validate email
      if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
      } else{
        // Prepare a select statement
        $sql = "SELECT Email FROM CUSTOMER WHERE Email = ?";
        
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
      
      // Validate password
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter a password.";     
      } 
      else{
          $password = trim($_POST["password"]);
      }
      
      // Validate confirm password
      if(empty(trim($_POST["confirm_password"]))){
          $confirm_password_err = "Please confirm password.";     
      } else{
          $confirm_password = trim($_POST["confirm_password"]);
          if(empty($password_err) && ($password != $confirm_password)){
              $confirm_password_err = "Password did not match.";
          }
      }

      // Validate Manager Password
      if (!empty(trim($_POST["manager_password"]))){
        $sql = "SELECT Manager_password FROM SYSTEM_INFO WHERE Manager_password = ?;";
        
        if($stmt = mysqli_prepare($db, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_manager_password);
          
          // Set parameters
          $param_manager_password = trim($_POST["manager_password"]);

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              /* store result */
              mysqli_stmt_store_result($stmt);
              
              if(mysqli_stmt_num_rows($stmt) == 1){
                  $manager_password = trim($_POST["manager_password"]);
              } else{
                  $manager_password_err = "Incorrect manager password.";
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
        }
      }
      
      // Check input errors before inserting in database
      if(!$manager_password && empty($manager_password_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
          // Prepare an insert statement
          $sql = "INSERT INTO CUSTOMER (Username, Email, Password_Customer) VALUES (?, ?, ?)";
          
          if($stmt = mysqli_prepare($db, $sql)){
  
            // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
              
              // Set parameters
              $param_username = $username;
              $param_email = $email;
              $param_password = $password; // Creates a password hash
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Redirect to login page
                  header("location: login.php");
              } else{
                  echo "Something went wrong. Please try again later.";
              }
          }
          
          // Close statement
          mysqli_stmt_close($stmt);
      }

      else if (empty($manager_password_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO MANAGER (Username, Email, Password_Manager) VALUES (?, ?, ?)";
          
        if($stmt = mysqli_prepare($db, $sql)){

          // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = $password; // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
      <title>Sign Up</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <style type="text/css">
          body{ font: 14px sans-serif; }
          .wrapper{ width: 350px; padding: 20px; }
      </style>
  </head>
  <body>
      <div class="wrapper">
          <h2>Sign Up</h2>
          <p>Please fill this form to create an account.</p>
          <form action="" method="POST">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
            <span class="help-block" style="color: red;"><?php echo $username_err; ?></span>
            <label>Email Address</label>
            <input type="text" name="email" class="form-control">
            <span class="help-block" style="color: red;"><?php echo $email_err; ?></span>
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block" style="color: red;"><?php echo $password_err; ?></span>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control"">
            <span class="help-block" style="color: red;"><?php echo $confirm_password_err; ?></span>
            <label>Manager Password</label>
            <input type="password" name="manager_password" class="form-control"">
            <span class="help-block" style="color: red;"><?php echo $manager_password_err; ?></span>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
          </form>
      </div>    
  </body>
</html>
