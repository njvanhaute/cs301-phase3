SELECT Theater_ID FROM THEATER WHERE Name = '$name';

SELECT * FROM THEATER NATURAL JOIN PREFERS WHERE username = '$uname';

 SELECT * FROM THEATER WHERE Theater_ID = '$tid';
 
 SELECT * FROM MOVIE WHERE Title = '$movie_name';
 
 SELECT * FROM PAYMENT_INFO WHERE username = '$uname';
 
 SELECT MAX(Order_ID) AS m FROM ORDER_ITEM;
 
 SELECT * FROM PAYMENT_INFO WHERE Card_No = '$cardno';
 
 INSERT INTO PAYMENT_INFO VALUES('$cardno', '$cvv', '$cardname', '$exp_date', 1, '$uname');

 INSERT INTO ORDER_ITEM VALUES('$oid', '$date', '$senior_tickets', '$child_tickets', '$adult_tickets', '$total_tickets', '$time', 'unused', '$cardno', '$uname', '$movie_name', '$tid');
 
 INSERT INTO ORDER_ITEM VALUES('$oid', '$date', '$senior_tickets', '$child_tickets', '$adult_tickets', '$total_tickets', '$time', 'unused', '$cardno', '$uname', '$movie_name', '$tid');

 SELECT * FROM THEATER WHERE Theater_ID = '$tid'
  
SELECT * FROM MOVIE WHERE Title = '$movie_name'
  
 SELECT * FROM PAYMENT_INFO WHERE username = '$uname' AND Saved = 1;
  
  SELECT MAX(Order_ID) AS m FROM ORDER_ITEM;
  
  INSERT INTO PAYMENT_INFO VALUES('$cardno', '$cvv', '$cardname', '$exp_date', 1, '$uname');
  
 INSERT INTO PAYMENT_INFO VALUES('$cardno', '$cvv', '$cardname', '$exp_date', 0, '$uname');
  
 INSERT INTO ORDER_ITEM VALUES('$oid', '$date', '$senior_tickets', '$child_tickets', '$adult_tickets', '$total_tickets', '$time', 'unused', '$cardno', '$uname', '$movie_name', '$tid');
  
 SELECT * FROM PAYMENT_INFO WHERE Card_No = '$cardno';
  
 INSERT INTO ORDER_ITEM VALUES('$oid', '$date', '$senior_tickets', '$child_tickets', '$adult_tickets', '$total_tickets', '$time', 'unused', '$cardno', '$uname', '$movie_name', '$tid');
  
 SELECT Order_ID FROM ORDER_ITEM WHERE username = '$username' AND Title = '$movie_title' AND Order_Status = 'completed';
  
 INSERT INTO REVIEW (Review_ID, Title, Comments, Rating, username) VALUES ($rating_id, '$movie_title', '$comment', $rating, '$username');
  
 SELECT Username, Email, Password_Manager FROM MANAGER WHERE Username = ? AND Password_Manager = ?;
  
  SELECT Username, Email, Password_Customer FROM CUSTOMER WHERE Username = ? AND Password_Customer = ?;
  
  SELECT Release_Date, Rating, Movie_Length, Movie_Genre FROM MOVIE WHERE Title = '$movie_title';
  
  SELECT AVG(Rating) AS average FROM REVIEW WHERE Title = '$movie_title';
  
  SELECT * FROM THEATER WHERE Theater_ID = '$tid';
  
   SELECT * FROM MOVIE WHERE Title = '$movie_name';
   
   SELECT * FROM SYSTEM_INFO;
   
   SELECT Order_Status FROM ORDER_ITEM WHERE Order_ID = '$oid';
   
   UPDATE ORDER_ITEM SET Order_Status = 'cancelled' WHERE Order_ID = '$oid';
   
   SELECT Child_discount, Senior_discount FROM SYSTEM_INFO;
   
   SELECT Num_Senior_Tickets, Num_Child_Tickets, Num_Adult_Tickets, Order_ID, Title, Order_Status FROM ORDER_ITEM WHERE username = '$uname';";
   
   SELECT Synopsis, Movie_Cast FROM MOVIE WHERE Title = '$movie_title';";
   
   DELETE FROM PAYMENT_INFO WHERE Card_No = '$card_num';";
   
   SELECT Card_No, Name_On_Card, Expiration_Date FROM PAYMENT_INFO WHERE username = '$uname' AND Saved = 1;";
   
   select Title, MONTH_NO, SUMTOT from ( select Title, MONTH_NO, SUMTOT, (@rn:=if(@prev = MONTH_NO, @rn +1, 1)) as rownumb, @prev:= MONTH_NO from ( select Title, MONTH_NO, COUNT(*) AS SUMTOT from ORDER_ITEM_W_MONTH where Order_Status <> \"cancelled\" GROUP BY Title, MONTH_NO order by MONTH_NO, SUMTOT desc, Title ) as sortedlist JOIN (select @prev:=NULL, @rn :=0) as vars ) as groupedlist where rownumb<=3 order by MONTH_NO, SUMTOT desc, Title;";
   
   DELETE FROM PREFERS WHERE Theater_ID = '$tid' AND username = '$uname';
   
   SELECT Theater_ID, Name, Theater_State, Theater_City, Theater_Street, Theater_Zip FROM THEATER NATURAL JOIN PREFERS WHERE username = '$uname';
   
   SELECT Username FROM CUSTOMER WHERE Username =  $param_username;
   
   SELECT Email FROM CUSTOMER WHERE Email =  $param_email;
   
   SELECT Manager_password FROM SYSTEM_INFO WHERE Manager_password = $param_manager_password;
   
   INSERT INTO CUSTOMER (Username, Email, Password_Customer) VALUES ($param_username, $param_email, $param_password);
   
   INSERT INTO MANAGER (Username, Email, Password_Manager) VALUES ( $param_username,  $param_email, $param_password);
   
   SELECT LEFT(ORDER_DATE, 2) AS MONTH_NO, 9.23 * SUM(Num_Senior_Tickets) AS SENIOR_REV, 8.08 * SUM(Num_Child_Tickets) AS CHILD_REV, 11.54 * SUM(Num_Adult_Tickets) AS ADULT_REV FROM ORDER_ITEM WHERE ORDER_STATUS ="completed" GROUP BY MONTH_NO;
   
   SELECT AVG(Rating) AS average FROM REVIEW WHERE Title = '$movie_title';
   
   SELECT Rating, Comments FROM REVIEW WHERE Title = '$movie_title';
   
   select * from theater where Name like '%$search_value%' OR Theater_City like '%$search_value%' OR Theater_State like '%$search_value%';
   
   INSERT INTO PREFERS VALUES('$tid', '$uname');
   
   SELECT Showtime FROM SHOWTIME NATURAL JOIN THEATER WHERE Theater_ID = '$tid' AND Title = '$movie_name';
   
  