<?php
require_once "db.php";
SESSION_START();
if (isset($_SESSION['error']))
{
		unset($_SESSION['error']);
}
if (isset($_SESSION['success']))
{
		//echo $_SESSION['success'];
			unset($_SESSION['success']);
}
	$result = mysql_query("SELECT name, price, authorln, authorfn, description, picture, id FROM book");
//	$sql = "SELECT * FROM book WHERE lower($s) LIKE lower(name)";
//  	mysql_query($sql);
   //	$_SESSION['success'] = 'Record Found';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
    <head>
        <title>Home Page</title> 
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
</p>
<?php if ( isset($_SESSION['name']) ) { ?>
<div id="toolbar">
	<ul>
		<li><a href="shoppingcart.php">My Shopping Cart</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
		<form name="form" method="post" action="search.php">
    		<tr>
      			<th width="774" height="34" scope="col">Search:
        			<label>
						<select name="term" id="Term">
							<option value="All" selected="selected">All</option>
							<option value = "Fall 2011">Fall 2011</option>
 							<option value = "Winter 2011">Winter 2011</option>
 							<option value = "Spring 2011">Spring 2011</option>
 							<option value = "Summer 2011">Summer 2011</option>
 							<option value = "Fall 2012">Fall 2012</option>
 							<option value = "Winter 2012">Winter 2012</option>
 							<option value = "Spring 2012">Spring 2012</option>
 							<option value = "Summer 2012">Summer 2012</option>
  							<option value = "Fall 2013">Fall 2013</option>
						</select> 
					</label>
		   			<label>
						<input name="search" type="text" id="search-text" value="<?php echo('Search by name, author, ISBN or course number HERE'); ?>" size="90" />
					</label>
		  			<label>
						<input type="submit" name="Search" id="search-submit" value="Go" />
					</label>
				</th>
	      	</tr>
		</form>
	</div><!-- end toolbar -->
	<p style="color:green">Hi <?php echo($_SESSION['name']); ?>, you're logged in. If you want to log in as another customer, please log out first.</p>
	<?php if ($_SESSION['isAdmin']==1) { ?>
		<li><a href='admin.php'>Go to administrator's page</a></li>
	<?php } ?>
<?php } else { ?>
	<div id="toolbar">
		<ul>
			<li><a href="login.php">Log in/Signup</a></li>
		</ul>
			<form name="form" method="post" action="search.php">
    			<tr>
      				<th width="774" height="34" scope="col">Search:
        				<label>
							<select name="term" id="Term">
							<option value="All" selected="selected">All</option>
							<option value = "Fall 2011">Fall 2011</option>
 							<option value = "Winter 2011">Winter 2011</option>
 							<option value = "Spring 2011">Spring 2011</option>
 							<option value = "Summer 2011">Summer 2011</option>
 							<option value = "Fall 2012">Fall 2012</option>
 							<option value = "Winter 2012">Winter 2012</option>
 							<option value = "Spring 2012">Spring 2012</option>
 							<option value = "Summer 2012">Summer 2012</option>
  							<option value = "Fall 2013">Fall 2013</option>
							</select> 
						</label>
						<label>
							<input name="search" 
							       type="text" 
							       id="search-text" 
							       value="<?php echo('Search by name, author, ISBN or course number HERE'); ?>" 
							       size="90" />
						</label>
						<label>
							<input type="submit" name="Search" id="search-submit" value="Go" />
						</label></th>
	      			</tr>			
				</form>
 </div><!-- end toolbar -->
<?php } ?>

<div id="booklist">
<p>
						
<?php while ( $row = mysql_fetch_row($result) ) { ?>
	<div class="book">
	<div class="img">
	<img src= <?php echo (htmlentities($row[5])); ?> alt="Book1" width="160" height="200" />
	</div><div class="info">
	<p class="book_info"> Title: <?php echo (htmlentities($row[0])); ?>
	</p><p> Price: <?php echo (htmlentities($row[1])); ?>
	</p><p> Author: <?php echo (htmlentities($row[3])); ?> <?php echo (htmlentities($row[2])); ?>
	</p><p> Description: <?php echo (htmlentities($row[4])); ?>
	</p><p><a href="bookInfo.php?id=<?php echo(htmlentities($row[6])); ?>">Open</a></p></div>
	</div>
<?php } ?>
	</div><!-- end booklist -->
    </div><!-- end content -->
	<div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div><!-- end footer -->
      </div><!-- end container -->
    </body>
</html>