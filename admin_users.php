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
        <title>View and edit orders</title>
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
            <form method="get" action="">
                <input type="text" id="search-text" name="s" value="" />
                <input type="submit" id="search-submit" value="Search" />
            </form>
          </div><!-- end toolbar -->
        <h1>Order information</h1>
<?php
echo '<table border="1">'."\n";
$result = mysql_query("SELECT * FROM users");
echo "<tr><td>id</td><td>Email</td><td>Password</td><td>Username</td><td>Administrator</td><td>";
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
    echo("</td><td>\n");
    echo('<a href="admin_users_edit.php?id='.htmlentities($row[0]).'">Edit</a> / ');
    echo('<a href="admin_users_delete.php?id='.htmlentities($row[0]).'">Delete</a>');
    echo("</td></tr>\n");
}

?>
		<a href="admin.php">Go back to administor's main page</a><br>
		<a href="admin_users_add.php">Add a new user</a>
		</div><!-- end content -->
		</div><!-- end container -->
    </body>
</html>