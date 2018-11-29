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
		
      if ($count_customer == 1 || $count_manager == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location: welcome.php");
      }
      else {
        $message = "Incorrect Username/Password";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
   }
?>

<html>
  <body>
    <h1>UAMovie Login</h1>
    <form action="" method="POST">
      Username: <input type = "text" name = "username"><br><br>
      Password: <input type = "password" name = "password"><br><br>
      <input type = "submit" value = " Submit "/>
    </form>
  </body>
</html>