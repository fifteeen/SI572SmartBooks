<?php
require_once "db.php";
SESSION_START();
if (isset($_SESSION['error']))
{
		unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
		echo $_SESSION['success'];
			unset($_SESSION['success']);
}
if ( isset($_SESSION['name']) ) 
{
	
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Check Out</title> 
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
				  <li><a href="logout.php">Log out</a></li>
				</ul>
				<form method="get" action="">
				  <input type="text" id="search-text" name="s" value="" />
				  <input type="submit" id="search-submit" value="Search" />
				</form>
			</div><!-- end toolbar -->
			<div id="booklist">
				<h1>Fill out the following information to proceed check out</h1>
        		<form method="post">
           	 	<table border="0">
           	 	<h3>Shipping Address</h3>
                	<tr>
                    	<td align="right">First Name</td>
                    	<td>:</td>
                    	<td><input type="text" name="fname"></td>
                	</tr>
                	<tr>
                    	<td align="right">Last Name</td>
                    	<td>:</td>
                    	<td><input type="text" name="lname"></td>
                	</tr>
                	<tr>
                    	<td align="right">Street</td>
                    	<td>:</td>
                    	<td><input type="text" name="street"></td>
                	</tr>
                	<tr>
                    	<td align="right">City</td>
                    	<td>:</td>
                    	<td><input type="text" name="city"></td>
                	</tr>
                	<tr>
                    	<td align="right">State</td>
                    	<td>:</td>
                    	<td><input type="text" name="state"></td>
                	</tr>
                	<tr>
                    	<td align="right">Zip Code</td>
                    	<td>:</td>
                    	<td><input type="text" name="zip"></td>
                	</tr>
                </table>
        		</form>
                <form method="post">
           	 	<table border="0">
                	<h3>Billing Address</h3>
                	<tr>
                    	<td align="right">First Name</td>
                    	<td>:</td>
                    	<td><input type="text" name="fname"></td>
                	</tr>
                	<tr>
                    	<td align="right">Last Name</td>
                    	<td>:</td>
                    	<td><input type="text" name="lname"></td>
                	</tr>
                	<tr>
                    	<td align="right">Street</td>
                    	<td>:</td>
                    	<td><input type="text" name="street"></td>
                	</tr>
                	<tr>
                    	<td align="right">City</td>
                    	<td>:</td>
                    	<td><input type="text" name="city"></td>
                	</tr>
                	<tr>
                    	<td align="right">State</td>
                    	<td>:</td>
                    	<td><input type="text" name="state"></td>
                	</tr>
                	<tr>
                    	<td align="right">Zip Code</td>
                    	<td>:</td>
                    	<td><input type="text" name="zip"></td>
                	</tr>
            	</table>
       		 	</form>
       		 	<form method="get" action="">
					<input type="submit" id="checkout-submit" value="Check Out" />
				</form>
        	</div><!--end booklist-->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!--end footer-->
    </body>
</html>