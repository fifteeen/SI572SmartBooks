<?php
require_once "db.php";
SESSION_START();

if (isset($_SESSION['error']))
{
	unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
	echo $_SESSION['success'];
	unset($_SESSION['success']);
}

if ( isset($_SESSION['name']) ) 
{
	echo '<p style="color:green">'."Hi ". $_SESSION['name'].", you're logged in. If you want to log in as another customer, please log out first. \n"."</p>";
}

echo '<table border="1">'."\n";
$result = mysql_query("SELECT name, price, authorln, authorfn, description,id FROM book");
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
