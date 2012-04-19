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
//Prevent unauthorized access
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
          </div><!-- end toolbar -->
		  
        <h1>Order information</h1>
        <p style="color:green"><?php if (isset($success)) echo $success; ?></p>
        <p style="color:red"><?php if (isset($error)) echo $error; ?></p>
<?php
//select everything in the users table then print it out
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