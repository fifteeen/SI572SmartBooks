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
$result = mysql_query("SELECT book.name, book.price, book.id, shoppingcart.quantity FROM book join shoppingcart on book.id=shoppingcart.book_id");
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
    echo('<a href="edit.php?id='.htmlentities($row[3]).'">Edit</a> / ');
    echo('<a href="delete.php?id='.htmlentities($row[3]).'">Delete</a>');
    echo("</td></tr>\n");
}
?>
<html>

    <body>
        
        </table>
        
    </body>
</html>

