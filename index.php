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
					<?php
					if ( isset($_SESSION['name']) ) 
					{
						echo '
							<div id="toolbar">
								<ul>
									<li><a href="shoppingcart.php">My Shopping Cart</a></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
								<form method="get" action="">
									<input type="text" id="search-text" name="s" value="" />
									<input type="submit" id="search-submit" value="Search" />
								</form>
							</div><!-- end toolbar -->';
						echo '<p style="color:green">'."Hi ". $_SESSION['name'].", you're logged in. If you want to log in as another customer, please log out first. \n"."</p>";
					}
					else
					{
						echo '
							<div id="toolbar">
								<ul>
									<li><a href="login.php">Log in/Signup</a></li>
								</ul>
								<form method="get" action="">
									<input type="text" id="search-text" name="s" value="" />
									<input type="submit" id="search-submit" value="Search" />
								</form>
							</div><!-- end toolbar -->';

					}
					?>
			<div id="booklist">
			<p>
			<?php
			$result = mysql_query("SELECT name, price, authorln, authorfn, description,id FROM book");
		
		//	$i=1;
			while ( $row = mysql_fetch_row($result) ) {
				echo('<div class="book">');
				echo('<div class="img">');
				echo('<img src=2.jpg  alt="Book1" width="100" height="160" />');
				echo('</div><div class="info">');
				echo('<p class="book_info"> Title:   ');
				echo(htmlentities($row[0]));
				echo('</p><p> Price:     ');
				echo(htmlentities($row[1]));
				echo('</p><p> Author:     ');
				echo(htmlentities($row[3])." ".htmlentities($row[2]));
		        echo('</p><p> Description:  ');
				echo(htmlentities($row[4]));
				echo('</p><p>');
			    echo('<a href="bookInfo.php?id='.htmlentities($row[5]).'">Open</a>');
				echo('</p>');
				echo('</div>');
				echo('</div>');
		//		$i=$i+1;
			}
			?>
			</p>
			</div><!-- end booklist -->
        </div><!-- end content -->
        
		
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!-- end footer -->
      </div><!-- end container -->
    </body>
</html>
<!--
            <iframe height="200" width="1000" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto" src="index.ehp">
            </iframe>
--!>
