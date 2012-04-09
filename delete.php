<?php
require_once "db.php";
session_start();

if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $id = mysql_real_escape_string($_POST['id']);
    $sql = "DELETE FROM shoppingcart WHERE id = $id";
    mysql_query($sql);
    $_SESSION['success'] = 'Record Deleted';
    header('Location: shoppingcart.php');
    return;
}
if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header('Location: shoppingcart.php');
    return;
}
$id = mysql_real_escape_string($_GET['id']);
$result = mysql_query("SELECT book.name,shoppingcart.id FROM book join shoppingcart on shoppingcart.id='$id' and shoppingcart.book_id=book.id");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header('Location: shoppingcart.php');
    return;
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
                <li><a href="shoppingcart.php">My Shopping Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
			<h1>Delete the Item in My Shopping Cart</h1>
			<p>Confirm: Deleting <?php echo ($row[0]); ?> </p>
			<form method="post">
			<input type="hidden" name="id" value="<?php echo($row[1]);?>"/> 
			<input type="submit" value="Delete" name="delete"/>
			<a href="shoppingcart.php">Cancel</a>
			</form>
           <p><a href="index.php"><input type="submit" value="Continue Shopping"/></a></p>
        </div><!-- end content -->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>