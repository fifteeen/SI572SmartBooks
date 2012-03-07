<?php
require_once "db.php";
SESSION_START();
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
$result = mysql_query("SELECT name, price, authorln, authorfn, description FROM book");
echo "<tr><td>Title</td><td>Price</td><td>Author</td><td>Description</td></tr>";
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td> $");
    echo(htmlentities($row[1]));
    echo("</td><td>");
    echo(htmlentities($row[2])." ".htmlentities($row[3]));
    echo("</td><td>");
    echo(htmlentities($row[4]));
    echo("</td><td>\n");
    echo('<a href="bookInfo.php?id='.htmlentities($row[5]).'">Open</a>');
    echo("</td></tr>\n");
}
?>
