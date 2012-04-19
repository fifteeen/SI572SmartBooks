<?php
require_once "db.php";
session_start();
if (isset($_SESSION['error']))
{
	unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
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
        <title>User Information</title> 
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
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <h1>Delete a user</h1>
<?php
// Fetch the id from HTML post method, then delete it, then relocate back to admin_users.php main page
if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $id = mysql_real_escape_string($_POST['id']);
    $sql = "DELETE FROM users WHERE id = $id";
    mysql_query($sql);
    $_SESSION['success'] = 'Users Deleted';
    header('Location: admin_users.php');
    return;
}
// If fail to get the id, store the error message, then relocate back to admin_users.php main page
if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header('Location: admin_users.php');
    return;
}

//Get id from post, or store error message if id does not exist
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM users WHERE id='$id' ");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header('Location: admin_users.php');
    return;
}

echo "<p>Confirm: Deleting user".htmlentities($row[1])."</p>\n";
echo('<form method="post"><input type="hidden" ');
echo('name="id" value="'.htmlentities($row[0]).'">'."\n");
echo('<input type="submit" value="Delete" name="delete">');
echo('<a href="admin_book.php">Cancel</a>');
echo("\n</form>\n");
?>
        </div><!-- end content -->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!-- end footer -->
    </body>
</html>