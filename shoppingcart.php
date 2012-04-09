<?php
require_once "db.php";
session_start();
if ( isset($_SESSION['error']) ) {
//    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
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
          </div><!-- end toolbar -->
        <h1>My shopping Cart</h1>
<?php
$id_user = $_SESSION['user_id'];
$sum = 0;
echo '<table border="1">'."\n";
$user_id=$_SESSION['user_id'];
$result = mysql_query("SELECT book.name, book.price, book.id, shoppingcart.quantity, shoppingcart.id,  shoppingcart.customer_id FROM book join shoppingcart on book.id=shoppingcart.book_id AND customer_id=$user_id");
echo "<tr><td>Name</td><td>Price</td><td>Quantity</td><td>Subtotal</td><td>Commands</td></tr>";
while ( $row = mysql_fetch_row($result) ) {
if (htmlentities($row[5]) == $id_user) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td>");
    echo(htmlentities($row[1]));
    echo("</td><td>");
    echo(htmlentities($row[3]));
    echo("</td><td>");
    echo(htmlentities($row[3])*htmlentities($row[1]));
    echo("</td><td>");
    echo('<a href="edit.php?id='.htmlentities($row[4]).'">Edit</a> / ');
    echo('<a href="delete.php?id='.htmlentities($row[4]).'">Delete</a>');
    echo("</td></tr>\n");
    $sum = $sum + htmlentities($row[3])*htmlentities($row[1]);
}

else continue;}

echo "<tr><td>Total</td><td>";
echo $sum;
echo "</td></tr>";

?>
        <p><a href="index.php"><input type="submit" value="Continue Shopping"/></a><a href="checkout.php"><input type="submit" value="Check out"/></a></p>
		</div><!-- end content -->	
        
<!--        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!-- end footer -->  
      </div><!-- end container -->
    </body>
</html>