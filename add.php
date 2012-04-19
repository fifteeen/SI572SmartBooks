<?php
require_once "db.php";
session_start();

if ( !isset($_SESSION['name'])){
	$_SESSION['error']= "To see your shopping cart or add books to your shopping cart, please log in first. ";
	header( 'Location: index.php' );
	}

    $id_book = mysql_real_escape_string($_GET['id']);
    $result = mysql_query("SELECT name, price FROM book WHERE id = $id_book");
    $show = mysql_fetch_row($result);
    $id_user = $_SESSION['user_id'];

//whether quantity has been set
    if ( isset($_POST['quantity'])) {
        $q = mysql_real_escape_string($_POST['quantity']);
//whether quantity is numeric
        if (is_numeric($q)){
//whether this book has been added in the shoppingcart, if it has, select it
	        if ( mysql_fetch_row(mysql_query("SELECT * from shoppingcart WHERE book_id='$id_book' AND customer_id='$id_user' "))){
//if the book is in the shoppingcart, select the old quantity of it
			    $oldq=mysql_result(mysql_query("SELECT quantity from shoppingcart where book_id='$id_book' AND customer_id='$id_user'"),0,'quantity');
//update the quantity
			    $newq=$oldq+$q;
			    mysql_query("UPDATE shoppingcart SET quantity= $newq where book_id='$id_book' AND customer_id='$id_user'");
			    header('Location: shoppingcart.php' );
	        }
//if the book has not been added in the shoppingcart, insert the new item in shoppingcart
	        else{
		        $sql = "INSERT INTO shoppingcart (quantity, book_id, checkout, customer_id) 
					  VALUES ('$q','$id_book',0,'$id_user')";
			    echo $sql;
		        mysql_query($sql);
		        $_SESSION['success'] = 'Record Added';
		        header( 'Location: shoppingcart.php' );
	            return;}
   
        }
        else   
            {$_SESSION['error']='Values should be numeric';
            header( 'Location: index.php' ) ;
            return;}
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
                <h2>Add A New Book to My Shopping Cart</h2>
				<p>Book: <?php echo $show[0];?> </p>
				<p>Price: <?php echo $show[1]; ?></p>
			<form method="post">
			<p>Quantity:
			<input type="text" name="quantity"></p>
			<p><input type="submit" value="Add New"/> <a href="index.php">Cancel</a></p>
			</form>
        </div>
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>

