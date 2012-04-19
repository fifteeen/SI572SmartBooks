<?php
require_once "db.php";
session_start();
if (isset($_SESSION['error']))
{
	echo ($_SESSION['error']);
	unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
	echo ($_SESSION['success']);
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
        <title>View and edit books</title>
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
        <h1>Order information</h1>
<?php
echo '<table border="1">'."\n";
$result = mysql_query("SELECT * FROM orders, addressbook, orderitem,book WHERE orders.addressbook_id=addressbook.id AND orders.id=orderitem.orders_id AND book.id=orderitem.book_id ORDER BY orders.id");
echo "<tr><td>Order id</td><td>Customer name</td><td>Address</td><td>Books</td><td>Quantity</td><td>Commands</td></tr>";
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td>");
    echo(htmlentities($row[3]).' '.htmlentities($row[4]));
    echo("</td><td>");
    echo((htmlentities($row[5])).' '.htmlentities($row[6]).' '.htmlentities($row[7]).' '.htmlentities($row[8]));
    echo("</td><td>");
    echo(htmlentities($row[15]));
    echo("</td><td>");
    echo(htmlentities($row[11]));
    echo("</td><td>\n");
    echo('<a href="admin_book_edit.php?id='.htmlentities($row[0]).'">Edit</a> / ');
    echo('<a href="admin_book_delete.php?id='.htmlentities($row[0]).'">Delete</a>');
    echo("</td></tr>\n");
}

?>
		<a href="admin.php">Go back to administor's main page</a><br>
		</div><!-- end content -->
		</div><!-- end container -->
    </body>
</html>