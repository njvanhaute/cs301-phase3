<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT Username FROM CUSTOMER WHERE Username = '$myusername' and Password_Customer = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("Location: welcome.php");
      }else {
        $error = "Your Login Name or Password is invalid";
      }
   }
?>

<html>
  <body>
    <h1>UAMovie Login</h1>
    <form action="" method="POST">
      Username: <input type = "text" name = "username"><br>
      Password: <input type = "password" name = "password"><br>
      <input type = "submit" value = " Submit "/>
    </form>
  </body>
</html>