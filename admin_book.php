<?php
require_once "db.php";
session_start();
if (isset($_SESSION['error']))
{
	$error=$_SESSION['error'];
	unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
	$success=$_SESSION['success'];
	unset($_SESSION['success']);
}

//prevent unauthorized access from unlogged users and non administrators
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
        <p style="color:green"><?php if (isset($success)) echo $success; ?></p>
        <p style="color:red"><?php if (isset($error)) echo $error; ?></p>
        <h1>Book information</h1>
<?php
//Select everything from the book table and print it out nicely
echo '<table border="1">'."\n";
$result = mysql_query("SELECT * FROM book");
echo "<tr><td>id</td><td>Name</td><td>ISBN</td><td>Year</td><td>Edition</td><td>Price</td><td>Quantity</td><td>Description</td><td>Author</td><td>Course ID</td><td>Picture</td><td>Commands</td></tr>";
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td>");
    echo(htmlentities($row[1]));
    echo("</td><td>");
    echo(htmlentities($row[2]));
    echo("</td><td>");
    echo(htmlentities($row[3]));
    echo("</td><td>");
    echo(htmlentities($row[4]));
    echo("</td><td>");
    echo(htmlentities($row[5]));
    echo("</td><td>");
    echo(htmlentities($row[6]));
    echo("</td><td>");
	echo(htmlentities($row[7]));
    echo("</td><td>");
    echo(htmlentities($row[8])." ". htmlentities($row[9]));
    echo("</td><td>");
    echo(htmlentities($row[10]));
    echo("</td><td>");
    echo(htmlentities($row[11]));
    echo("</td><td>\n");
	//print out a link to the edit and delete page
    echo('<a href="admin_book_edit.php?id='.htmlentities($row[0]).'">Edit</a> / ');
    echo('<a href="admin_book_delete.php?id='.htmlentities($row[0]).'">Delete</a>');
    echo("</td></tr>\n");
}

?>
		<a href="admin.php">Go back to administor's main page</a><br>
		<a href="admin_book_add.php">Add a new book</a>
		</div><!-- end content -->
		</div><!-- end container -->
    </body>
</html>