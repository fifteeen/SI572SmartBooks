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
    header('Location: admin_book.php');
    return;
}
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT * FROM book WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header('Location: admin_book.php');
    return;
}
$id = htmlentities($row[0]);

if ( isset($_POST['name']) && isset($_POST['isbn']) && isset($_POST['year'])
     && isset($_POST['edition']) && isset($_POST['price']) && isset($_POST['quantity'])
	 && isset($_POST['description']) && isset($_POST['authorln']) && isset($_POST['authorfn'])
	 && isset($_POST['course_id']))
	{
	    $n = mysql_real_escape_string($_POST['name']);
	    $i = mysql_real_escape_string($_POST['isbn']);
	    $y = mysql_real_escape_string($_POST['year']);
	    $e = mysql_real_escape_string($_POST['edition']);
	    $p = mysql_real_escape_string($_POST['price']);
	    $q = mysql_real_escape_string($_POST['quantity']);
	    $d = mysql_real_escape_string($_POST['description']);
	    $al = mysql_real_escape_string($_POST['authorln']);
	    $af = mysql_real_escape_string($_POST['authorfn']);
	    $ci = mysql_real_escape_string($_POST['course_id']);
		if (is_numeric($q) && is_numeric($p) && is_numeric($y))
		{
			$sql = "UPDATE book SET name='$n', ISBN='$i', year= '$y' , edition='$e', price='$p', quantity= '$q', description='$d', authorln='$al', authorfn='$af', course_id='$ci' WHERE id='$id' "; 
			mysql_query($sql);
			$_SESSION['success'] = "Book added. ";
			header('Location: admin_book.php');
			return;
		}
		elseif (!is_numeric($q))
		{     
			$_SESSION['error']='Values for quantity should be numeric';
			header( 'Location: admin_book_edit.php' ) ;
			return;
		}
		elseif (!is_numeric($p))
		{     
			$_SESSION['error']='Values for price should be numeric';
			header( 'Location: admin_book_edit.php' ) ;
			return;
		}
		else
		{     
			$_SESSION['error']='Publication year should be numeric';
			header( 'Location: admin_book_edit.php' ) ;
			return;
		}
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Book Information</title> 
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
            <h1>Edit a book</h1>
            <form method="get" action="">
                <input type="text" id="search-text" name="s" value="" />
                <input type="submit" id="search-submit" value="Search" />
            </form>
		<form method="post">
			<p>Book Name:
			<input type="text" name="name"></p>
			<p>ISBN:
			<input type="text" name="isbn"></p>
			<p>Year:
			<input type="text" name="year"></p>
			<p>Edition:
			<input type="text" name="edition"></p>
			<p>Price:
			<input type="text" name="price"></p>
			<p>Quantity:
			<input type="text" name="quantity"></p>
			<p>Description:
			<input type="text" name="description"></p>
			<p>Author last name:
			<input type="text" name="authorln"></p>
			<p>Author first name:
			<input type="text" name="authorfn"></p>
			<p>Course ID:
			<input type="text" name="course_id"></p>
		<input type="hidden" name="id" value="$id">
		<p><input type="submit" value="Update"/>
		<a href="admin_book.php">Cancel</a></p>
		</form>
        </div><!-- end content -->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>