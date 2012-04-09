<?php
require_once "db.php";
session_start();
if (isset($_SESSION['error']))
{
	unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
		unset($_SESSION['success']);
}
if (!isset($_SESSION['name']))
{
	header ("Location:index.php");
}
if ($_SESSION['isAdmin']==0)
{
	header ("Location:index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Shopping Cart</title>
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
          <div id="toolbar">
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <form method="get" action="">
                <input type="text" id="search-text" name="s" value="" />
                <input type="submit" id="search-submit" value="Search" />
            </form>
          </div><!-- end toolbar -->
        <h1>View/Edit</h1>
             <li><a href="admin_book.php">Manage books</a></li>
			 <li><a href="admin_order.php">Manage orders</a></li>
             <li><a href="admin_users.php">Manage users</a></li>
        </div><!-- end content -->
        
		
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!-- end footer -->
      </div><!-- end container -->
    </body>
</html>