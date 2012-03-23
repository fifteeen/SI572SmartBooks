<html>
    <head>
        <title>Shopping Cart</title>
        <link type="text/css" rel="stylesheet" href="main.css">
    </head>
    <body>
        <div id="header">
            <img src="banner.jpg" width="1200" height="200">
            <ul>
                <li><a href="index.htm">Home</a></li>
            </ul>
        </div>
        <div id="content">
            <ul>
                <li><a href="logout.htm">Logout</a></li>
                <li><a href="checkout.htm">Checkout</a></li>
            </ul>
            <h1>My shopping Cart</h1>
            <form method="get" action="">
                <input type="text" id="search-text" name="s" value="" />
                <input type="submit" id="search-submit" value="Search" />
            </form>
<?php
require_once "db.php";
session_start();
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
        <p><a href="add.php">Continue Shopping</a> <a href="checkout.php">Check Out</a></p>
        </div>
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>
