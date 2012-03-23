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
if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $id = mysql_real_escape_string($_POST['id']);
    $sql = "DELETE FROM shoppingcart WHERE id = $id";
    mysql_query($sql);
    $_SESSION['success'] = 'Record Deleted';
    header('Location: shoppingcart.php');
    return;
}
if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header('Location: shoppingcart.php');
    return;
}
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT book.name,shoppingcart.id FROM book join shoppingcart on shoppingcart.id='$id' and shoppingcart.book_id=book.id");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header('Location: shoppingcart.php');
    return;
}

echo "<p>Confirm: Deleting ".htmlentities($row[0])."</p>\n";
echo('<form method="post"><input type="hidden" ');
echo('name="id" value="'.htmlentities($row[1]).'">'."\n");
echo('<input type="submit" value="Delete" name="delete">');
echo('<a href="shoppingcart.php">Cancel</a>');
echo("\n</form>\n");
?>
            <p><a href="add.php">Continue Shopping</a> <a href="checkout.php">Check Out</a></p>
        </div>
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>