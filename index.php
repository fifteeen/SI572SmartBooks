<?php
require_once "db.php";
session_start();
if ( isset($_SESSION['error']) ) 
{
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['succ']) ) 
{
    echo '<p style="color:green">'.$_SESSION['succ']."</p>\n";
    unset($_SESSION['succ']);
}

echo '<table border="1">'."\n";
$result = mysql_query("SELECT name, price, author, description FROM Book");
echo "<tr><td>Title</td><td>Price</td><td>Author</td><td>Description</td></tr>";
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td> $");
    echo(htmlentities($row[1]));
    echo("</td><td>");
    echo(htmlentities($row[2]));
    echo("</td><td>");
    echo(htmlentities($row[3]));
    echo("</td><td>\n");
    echo('<a href="bookInfo.php?id='.htmlentities($row[4]).'">Open</a>');
    echo("</td></tr>\n");
}
?>
<HTML><HEAD><TITLE>Smart Bookstore</TITLE></HEAD>
<H1><CENTER>Online Textbook Store</CENTER>
</table>
<br>

<a href="login.php">Login</a>
<pre>                        
<a href="login.php">Sign up</a>
</pre>
