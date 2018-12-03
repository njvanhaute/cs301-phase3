<?php
  // Initialize the session
  include("config.php");
  session_start();
  error_reporting(0);
  header('Content-Type: text/html; charset=iso-8859-1');
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  $rating_err = $review_title_err = $comment_err = "";
  $movie_title = $_SESSION['title'];

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["review_title"]))){
      $review_title_err = "Please enter title.";
    } 
    else{
      $review_title = $_POST["username"];
    }
    
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];
    $max = "SELECT MAX(Review_ID) AS m FROM REVIEW;";
    $result = mysqli_query($db, $max);
    $row = mysqli_fetch_assoc($result);
    $rating_id = $row['m'] + 1;

    if (empty($review_title_err)){
      $max = "SELECT MAX(Order_ID) FROM ORDER_ITEM;";
      $result = mysqli_query($db, $max);
      $row = mysqli_fetch_assoc($result);
      
      $sql = "SELECT Order_ID FROM ORDER_ITEM WHERE username = '$username' AND Title = '$movie_title' AND Order_Status = 'completed'";

      if($stmt = mysqli_prepare($db, $sql)){

        if(mysqli_stmt_execute($stmt)){
          // Store result
          mysqli_stmt_store_result($stmt);
          // Check if username exists, if yes then verify password
          if(mysqli_stmt_num_rows($stmt) > 0){  
                  
            $isql = "INSERT INTO REVIEW (Review_ID, Title, Comments, Rating, username) VALUES ($rating_id, '$movie_title', '$comment', $rating, '$username')";
            
            if($istmt = mysqli_prepare($db, $isql)){
    
              // Bind variables to the prepared statement as parameters                
                if(mysqli_stmt_execute($istmt)){
                    // Redirect to login page
                    header("location: nowplaying.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            mysqli_stmt_close($istmt);
          } 
          else {
            $comment_err = "You must have completed an order for this movie to leave a review!";
          }
        }
        else{
            echo "Oops! Something went wrong. Please try again later.";
        }
      }
      
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        h1 {text-align: center;}
        .wrapper{ width: 500px; padding: 20px; margin: auto;}
    </style>
</head>
<body>
  <div class="page-header">
      <h1><b><?php echo $movie_title ?></b></h1>
  </div>
  <div class="wrapper">
    <h2>Give Review:</h2>
    <form action="" method="POST">
      <label>Rating</label>
      <select name="rating">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <span class="help-block" style="color: red;"><?php echo $rating_err; ?></span>  
      <label>Title</label>
      <input type="text" name="review_title" class="form-control">
      <span class="help-block" style="color: red;"><?php echo $review_title_err; ?></span>  
      <label>Comment</label><br>
      <textarea class="form-control" name="comment" rows="10"></textarea>
      <span class="help-block" style="color: red;"><?php echo $comment_err; ?></span>
      <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <a class="btn btn-danger" href="review.php">Back</a>
      </div>
    </form>
  </div>
</body>
</html>
