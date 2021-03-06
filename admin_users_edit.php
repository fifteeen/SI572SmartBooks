<?php
require_once "db.php";
session_start();
if (isset($_SESSION['error']))
{
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
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

if ( !isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header('Location: admin_users.php');
    return;
}
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM users WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header('Location: admin_users.php');
    return;
}
$id = htmlentities($row[0]);

if ( isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])
     && isset($_POST['isAdmin']) ) {
	   $e = mysql_real_escape_string($_POST['email']);
	   $p = mysql_real_escape_string($_POST['password']);
	   $u = mysql_real_escape_string($_POST['username']);
	   $i = mysql_real_escape_string($_POST['isAdmin']);
		if (is_numeric($i))
		{
			$sql = "UPDATE users SET email='$e', password='$p', username= '$u' , isAdmin='$i' WHERE id='$id' "; 
			mysql_query($sql);
			$_SESSION['success'] = "Users updated. ";
			header('Location: admin_users.php');
			return;
		}
		else
		{     
			$_SESSION['error']='Values for Is Administrator should be numeric.';
			header( 'Location: admin_users_edit.php' ) ;
			return;
		}
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
            <h1>Edit a user</h1>
		<form method="post">
			<p>Email:
			<input type="text" name="email"></p>
			<p>Password:
			<input type="password" name="password"></p>
			<p>Username:
			<input type="text" name="username"></p>
			<p>Is administrator:
			<input type="text" name="isAdmin"></p>
		<p><input type="submit" value="Update User"/></p>
		<a href="admin_users.php">Cancel</a></p>
		</form>
        </div><!-- end content -->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>
