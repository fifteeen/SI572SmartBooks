<?php
require_once "db.php";
SESSION_START();

$id_user = $_SESSION['user_id'];

if ( isset($_POST['submit'])){

if ( isset($_POST['fname'])&& isset($_POST['lname']) && isset($_POST['street']) && isset($_POST['city']) &&isset($_POST['state']) && isset($_POST['zip']) )  
     {
   $fn = mysql_real_escape_string($_POST['fname']);
   $ln = mysql_real_escape_string($_POST['lname']);
   $str = mysql_real_escape_string($_POST['street']);
   $c = mysql_real_escape_string($_POST['city']);
   $st = mysql_real_escape_string($_POST['state']);
   $z = mysql_real_escape_string($_POST['zip']);
  //intert into addressbook   
   $sql1 = "INSERT INTO addressbook (customerln, customerfn, street, city, state, zip, customer_id) 
              VALUES ('$fn', '$ln', '$str', '$c','$st','$z','$id_user')";
   mysql_query($sql1);
  }
  else   
   {$_SESSION['error']='Values for plays and rating should be numeric';
         header( 'Location: index.php' ) ;
         return;}
  
  if ( mysql_fetch_row(mysql_query("SELECT * from addressbook WHERE customer_id='$id_user' "))){
  //select addressbook_id 
   $user = mysql_result(mysql_query("SELECT id FROM addressbook where customer_id = '$id_user'"),0,'id');
  //intert into orders 
   mysql_query("INSERT INTO orders (addressbook_id) VALUES ('$user')");
   
  //select quantity, book_id from shoppingcart 
   $result = mysql_query("SELECT shoppingcart.quantity, shoppingcart.book_id, shoppingcart.customer_id, orders.id, addressbook.id FROM shoppingcart join orders join addressbook on shoppingcart.customer_id=addressbook.customer_id AND addressbook.id=orders.addressbook_id"); 
  // intert into orderitem
   while ( $row = mysql_fetch_row($result) ) {
   if (htmlentities($row[2]) == $id_user) {
   mysql_query("INSERT INTO orderitem (quantity, orders_id, book_id) VALUES ('$row[0]','$row[3]','$row[1]')");
   }
   else continue;} 
  // delete items in shoppingcart if checked out
     mysql_query("DELETE from shoppingcart WHERE customer_id= $id_user ");
   return;
    header('Location: confirm.php');
   }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Check Out</title> 
        <script type="text/javascript">
        </script>
        <link type="text/css" rel="stylesheet" href="main.css"/>
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
			</div><!-- end toolbar -->
			<div id="booklist">
				<h1>Fill out the following information to proceed check out</h1>
        		<form method="post">
           	 	<table border="0">
           	 	<h3>Shipping Address</h3>
                	<tr>
                    	<td align="right">First Name</td>
                    	<td>:</td>
                    	<td><input type="text" name="fname"/></td>
                	</tr>
                	<tr>
                    	<td align="right">Last Name</td>
                    	<td>:</td>
                    	<td><input type="text" name="lname"/></td>
                	</tr>
                	<tr>
                    	<td align="right">Street</td>
                    	<td>:</td>
                    	<td><input type="text" name="street"/></td>
                	</tr>
                	<tr>
                    	<td align="right">City</td>
                    	<td>:</td>
                    	<td><input type="text" name="city"/></td>
                	</tr>
                	<tr>
                    	<td align="right">State</td>
                    	<td>:</td>
                    	<td><input type="text" name="state"/></td>
                	</tr>
                	<tr>
                    	<td align="right">Zip Code</td>
                    	<td>:</td>
                    	<td><input type="text" name="zip"/></td>
                	</tr>
                </table>
       		 	    <a href="shoppingcart.php">Go Back</a>
					<input type="submit" id="checkout-submit" name ="submit" value="Check Out" />
				</form>
        	</div><!--end booklist-->
        </div><!--end content-->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!--end footer-->
      </div><!--end container-->
    </body>
</html>