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
			<div id="toolbar">
				<ul>
				  <li><a href="shoppingcart.php">Shopping Cart</a></li>
				  <li><a href="logout.php">Log out</a></li>
				</ul>
				<form method="get" action="">
				  <input type="text" id="search-text" name="s" value="" />
				  <input type="submit" id="search-submit" value="Search" />
				</form>
			</div><!-- end toolbar -->
			<div id="booklist">
           			<?php
           				$id = mysql_real_escape_string($_GET['id']);
						$result = mysql_query("SELECT name, price, authorln, authorfn, ISBN, year, edition, course_id, description,id FROM book WHERE id = $id");						
						if ( $row = mysql_fetch_row($result) ) {
							echo('<div class="book">');
							echo('<div class="img_2">');
							echo('<img src=2.jpg  alt="Book1" width="100" height="160" />');
							echo('</div><div class="info_2">');
							echo('<p class="book_info"> Title:   ');
							echo(htmlentities($row[0]));
							echo('</p><p> Price:     ');
							echo(htmlentities($row[1]));
							echo('</p><p> Author:     ');
							echo(htmlentities($row[3])." ".htmlentities($row[2]));
							echo('</p><p> ISBN:     ');
							echo(htmlentities($row[4]));
							echo('</p><p> Year:     ');
							echo(htmlentities($row[5]));
							echo('</p><p> Edition:     ');
							echo(htmlentities($row[6]));
							echo('</p><p> Course ID:     ');
							echo(htmlentities($row[7]));
		       		 		echo('</p><p> Description:  ');
							echo(htmlentities($row[8]));
							echo('</p><p>');
							echo('<a href="shoppingcart.php?id='.htmlentities($row[9]).'">Add to shopping cart</a>');
							echo('</p>');
							echo('</div>');
							echo('</div>');
						}
						if ( $row == FALSE ) {
    						$_SESSION['error'] = 'Bad value for id';
    						header('Location: index.php');
   						 return;
						}
						$id = htmlentities($row[9]);
					?>
        	</div><!--end booklist-->
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!--end footer-->
    </body>
</html>