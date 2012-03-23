<html>
    <head>
        <title>Shopping Cart</title>
        <link type="text/css" rel="stylesheet" href="main.css">
    </head>
    <body>
        <div id="header">
            <img src="banner.jpg" width="1200" height="200">
            <ul>
                <li><a href="index.php">Home</a></li>
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
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
echo '<table border="1">'."\n";
$result = mysql_query("SELECT book.name, book.price, book.id, shoppingcart.quantity, shoppingcart.id FROM book join shoppingcart on book.id=shoppingcart.book_id");
echo "<tr><td>Name</td><td>Price</td><td>Quantity</td><td>Total</td><td>Commands</td></tr>";
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td>");
    echo(htmlentities($row[1]));
    echo("</td><td>");
    echo(htmlentities($row[3]));
    echo("</td><td>");
    echo(htmlentities($row[3])*htmlentities($row[1]));
    echo("</td><td>\n");
    echo('<a href="edit.php?id='.htmlentities($row[4]).'">Edit</a> / ');
    echo('<a href="delete.php?id='.htmlentities($row[4]).'">Delete</a>');
    echo("</td></tr>\n");
}
?>
        <p><a href="add.php">Continue Shopping</a> <a href="checkout.php">Check Out</a></p>
        </div>
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>