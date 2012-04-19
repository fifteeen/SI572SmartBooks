<?php
require_once "db.php";
session_start();

  $id_user = $_SESSION['user_id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Book Information</title> 
        <link type="text/css" rel="stylesheet" href="main.css">
    </head>
    <body>
      <div id="container">
        <div id="header">
            <ul>
              <li><a href="index.php">Home</a></li>
            </ul>
        </div><!-- end header -->
        <div id="content">
            <ul>
                <li><a href="shoppingcart.php">My Shopping Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
<?php
//select the name of the customer
  $sql = "SELECT username FROM users WHERE id ='$id_user' ";
  $user_name = mysql_result(mysql_query($sql),0,'username');

//display the confirmation message
  echo("<h1>Thank you.". $user_name."</h1>");
?>
            <h2>Your books have been already ordered. They will be shipped soon.</h2>
<p><a href="index.php">BACK</a></p>
        </div>
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>

