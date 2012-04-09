<?php
require_once "db.php";
session_start();
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
            <h1>Edit Items in My Shopping Cart</h1>
<?php
if ( isset($_POST['quantity'])) {
    $q = mysql_real_escape_string($_POST['quantity']);
    $id = mysql_real_escape_string($_POST['id']);
        if (is_numeric($q)){
    $sql = "UPDATE shoppingcart SET quantity='$q' WHERE id='$id'"; 
    mysql_query($sql);
    $_SESSION['success'] = 'Shopping item information updated';
    header('Location: shoppingcart.php');
    return;}
       else   
   {     $_SESSION['error']='Values for quantity should be numeric';
         header( 'Location: shoppingcart.php' ) ;
         return;
         }
}

if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header('Location: shoppingcart.php');
    return;
}
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT book.name, book.price, book.id, shoppingcart.quantity, shoppingcart.id FROM book join shoppingcart on book.id=shoppingcart.book_id");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header('Location: shoppingcart.php');
    return;
}
$q = htmlentities($row[3]);
$id = htmlentities($row[4]);
echo <<< _END
<p>Edit Shopping Item</p>
<form method="post">
<p>Quantity:
<input type="text" name="quantity" value="$q"></p>
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="shoppingcart.php">Cancel</a></p>
</form>
_END
?>
         <p><a href="index.php"><input type="submit" value="Continue Shopping"/></a><a href="checkout.php"><input type="submit" value="Check out"/></a></p>
        </div><!-- end content -->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>
