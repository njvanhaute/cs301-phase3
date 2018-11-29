<?php session_start(); ?>
<html>
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $_SESSION['login_user']; ?>, you are a <?php echo $_SESSION['user_type']?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>
