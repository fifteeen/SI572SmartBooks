<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
       "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Homepage</title> 
        <link type="text/css" rel="stylesheet" href="main.css">
    </head>
    <body>
        <div id="header">
            <img src="banner.jpg" width="1200" height="200">
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>
        <div id="content">
            <ul>
                <li><a href="login.php">Login/Signup</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <form method="get" action="">
                <input type="text" id="search-text" name="s" value="" />
                <input type="submit" id="search-submit" value="Search" />
            </form>
			<?php
			require ("index2.php");
			?>
        </div>
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>